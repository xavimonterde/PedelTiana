<?php
require 'db.php';

function getUserPoints($user_id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT points FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    return (float)$stmt->fetchColumn(); // Ensure the points are treated as float
}

function getUserMatches($user_id) {
    global $pdo;
    $stmt = $pdo->prepare('SELECT matches FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    return (int)$stmt->fetchColumn(); // Ensure the matches are treated as int
}

function calculatePoints($winning_team_points, $losing_team_points) {
    return 1; // Winners always get 1 point
}

function updateUserPoints($user_id, $points) {
    global $pdo;
    $current_points = getUserPoints($user_id);
    $new_points = $current_points + $points;

    $stmt = $pdo->prepare('UPDATE users SET points = ? WHERE id = ?');
    $stmt->execute([$new_points, $user_id]);
}

function updateUserMatches($user_id) {
    global $pdo;
    $current_matches = getUserMatches($user_id);
    $new_matches = $current_matches + 1;

    $stmt = $pdo->prepare('UPDATE users SET matches = ? WHERE id = ?');
    $stmt->execute([$new_matches, $user_id]);
}

function recordMatch($player1_id, $player2_id, $player3_id, $player4_id, $winner_team) {
    global $pdo;

    $team1_points = getUserPoints($player1_id) + getUserPoints($player2_id);
    $team2_points = getUserPoints($player3_id) + getUserPoints($player4_id);

    if ($winner_team == 1) {
        $points_awarded = calculatePoints($team1_points, $team2_points);
        updateUserPoints($player1_id, $points_awarded);
        updateUserPoints($player2_id, $points_awarded);
    } else {
        $points_awarded = calculatePoints($team2_points, $team1_points);
        updateUserPoints($player3_id, $points_awarded);
        updateUserPoints($player4_id, $points_awarded);
    }

    // Increment matches for all players
    updateUserMatches($player1_id);
    updateUserMatches($player2_id);
    updateUserMatches($player3_id);
    updateUserMatches($player4_id);

    $stmt = $pdo->prepare('INSERT INTO matches (player1_id, player2_id, player3_id, player4_id, winner_team, match_date) VALUES (?, ?, ?, ?, ?, NOW())');
    $stmt->execute([$player1_id, $player2_id, $player3_id, $player4_id, $winner_team]);
}

function getPlayers() {
    global $pdo;
    $stmt = $pdo->query('SELECT * FROM users ORDER BY points DESC, matches ASC');
    return $stmt->fetchAll();
}

function createUser($name) {
    global $pdo;
    $stmt = $pdo->prepare('INSERT INTO users (name) VALUES (?)');
    $stmt->execute([$name]);
}

function deleteUser($user_id) {
    global $pdo;
    // Delete related matches first
    $stmt = $pdo->prepare('DELETE FROM matches WHERE player1_id = ? OR player2_id = ? OR player3_id = ? OR player4_id = ?');
    $stmt->execute([$user_id, $user_id, $user_id, $user_id]);
    
    // Delete the user
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
}

function resetAllPoints() {
    global $pdo;
    $stmt = $pdo->prepare('UPDATE users SET points = 0, matches = 0');
    $stmt->execute();
}
?>
