<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['user_id'];
    
    deleteUser($user_id);

    header('Location: index.php');
    exit;
}
?>
