<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    
    createUser($name);

    header('Location: index.php');
    exit;
}
?>
