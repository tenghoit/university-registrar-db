<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/classes_waitlist.php");
    exit();
}

$class = json_decode($_POST['class'], true);
$student = json_decode($_POST['student'], true);

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/classes_waitlist_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":student_id", $student['student_id']);
    $stmt->bindParam(":class_id", $class['class_id']);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/classes_waitlist.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}