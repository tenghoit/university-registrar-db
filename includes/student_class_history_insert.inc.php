<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/student_class_history.php");
    exit();
}

$class = json_decode($_POST['class'], true);
$student = json_decode($_POST['student'], true);

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/student_class_history_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":student_id", $student['student_id']);
    $stmt->bindParam(":class_id", $class['class_id']);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/student_class_history.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}