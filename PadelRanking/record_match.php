<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $player1_id = $_POST['player1_id'];
    $player2_id = $_POST['player2_id'];
    $player3_id = $_POST['player3_id'];
    $player4_id = $_POST['player4_id'];
    $winner_team = $_POST['winner_team'];

    recordMatch($player1_id, $player2_id, $player3_id, $player4_id, $winner_team);

    header('Location: index.php');
    exit;
}
?>
