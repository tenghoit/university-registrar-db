<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/student_degrees.php");
    exit();
}

$degree = json_decode($_POST['degree'], true);
$student = json_decode($_POST['student'], true);

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/student_degrees_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":student_id", $student['student_id']);
    $stmt->bindParam(":degree_id", $degree['degree_id']);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/student_degrees.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}