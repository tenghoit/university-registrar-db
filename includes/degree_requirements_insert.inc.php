<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/degree_requirements.php");
    exit();
}

$degree = json_decode($_POST['degree'], true);
$course = json_decode($_POST['course'], true);

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/degree_requirements_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":degree_id", $degree['degree_id']);
    $stmt->bindParam(":course_id", $course['course_id']);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/degree_requirements.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}