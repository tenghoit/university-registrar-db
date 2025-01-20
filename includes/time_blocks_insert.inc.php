<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/time_blocks.php");
    exit();
}

$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/time_blocks_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":start_time", $start_time);
    $stmt->bindParam(":end_time", $end_time);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/time_blocks.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}