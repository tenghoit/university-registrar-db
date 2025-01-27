<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/student_class_history.php");
    exit();
}

$student_id = $_POST['student_id'];
$class_id = $_POST['class_id'];
$grade = $_POST['grade'];

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/student_class_history_update.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":student_id", $student_id);
    $stmt->bindParam(":class_id", $class_id);
    $stmt->bindParam(":grade", $grade);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/student_class_history.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage()); 
}