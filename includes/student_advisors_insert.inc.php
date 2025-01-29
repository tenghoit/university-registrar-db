<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/student_advisors.php");
    exit();
}

$professor = json_decode($_POST['professor'], true);
$student = json_decode($_POST['student'], true);

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/student_advisors_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":student_id", $student['student_id']);
    $stmt->bindParam(":professor_id", $professor['professor_id']);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/student_advisors.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}