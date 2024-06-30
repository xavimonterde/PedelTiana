<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Padel Rankings</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>ULTIMATE PADEL TIANA TEAM</h1>
    
    <!-- Ranking Table -->
    <table>
        <tr>
            <th>Rank</th>
            <th>Player</th>
            <th>Points</th>
            <th>Matches</th>
            <th>Action</th>
        </tr>
        <?php
            require 'functions.php';
            $players = getPlayers();
            foreach ($players as $index => $player) {
                echo "<tr>";
                echo "<td>" . ($index + 1) . "</td>";
                echo "<td>" . htmlspecialchars($player['name']) . "</td>";
                echo "<td>" . htmlspecialchars(number_format($player['points'], 2)) . "</td>"; // Display points with 2 decimal places
                echo "<td>" . htmlspecialchars($player['matches']) . "</td>"; // Display number of matches
                echo "<td><form action='delete_user.php' method='POST' style='display:inline;'><input type='hidden' name='user_id' value='{$player['id']}'><button type='submit'>Delete</button></form></td>";
                echo "</tr>";
            }
        ?>
    </table>

    <!-- Form to Enter Match Results -->
    <h2>Enter Match Results</h2>
    <form action="record_match.php" method="POST">
        <label for="player1">Player 1:</label>
        <select id="player1" name="player1_id">
            <?php foreach ($players as $player): ?>
                <option value="<?= $player['id'] ?>"><?= htmlspecialchars($player['name']) ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="player2">Player 2:</label>
        <select id="player2" name="player2_id">
            <?php foreach ($players as $player): ?>
                <option value="<?= $player['id'] ?>"><?= htmlspecialchars($player['name']) ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="player3">Player 3:</label>
        <select id="player3" name="player3_id">
            <?php foreach ($players as $player): ?>
                <option value="<?= $player['id'] ?>"><?= htmlspecialchars($player['name']) ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="player4">Player 4:</label>
        <select id="player4" name="player4_id">
            <?php foreach ($players as $player): ?>
                <option value="<?= $player['id'] ?>"><?= htmlspecialchars($player['name']) ?></option>
            <?php endforeach; ?>
        </select>
        
        <label for="winner">Winning Team (1 or 2):</label>
        <input type="number" id="winner" name="winner_team">
        
        <button type="submit">Submit</button>
    </form>

    <!-- Form to Create New User -->
    <h2>Create New User</h2>
    <form action="create_user.php" method="POST">
        <label for="name">Player Name:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Create</button>
    </form>

    <!-- Button to Restart All Points -->
    <h2>Admin Actions</h2>
    <form action="reset_points.php" method="POST">
        <button type="submit">Restart All Points</button>
    </form>
</body>
</html>
