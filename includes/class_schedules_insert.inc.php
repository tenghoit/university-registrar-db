<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/class_schedules.php");
    exit();
}

$class = json_decode($_POST['class'], true);
$day = json_decode($_POST['day'], true);
$time_block = json_decode($_POST['time_block'], true);

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/class_schedules_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":class_id", $class['class_id']);
    $stmt->bindParam(":day_letter", $day['day_letter']);
    $stmt->bindParam(":start_time", $time_block['start_time']);
    $stmt->bindParam(":end_time", $time_block['end_time']);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/class_schedules.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}