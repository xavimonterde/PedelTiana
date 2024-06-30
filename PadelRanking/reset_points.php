<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    resetAllPoints();

    header('Location: index.php');
    exit;
}
?>
