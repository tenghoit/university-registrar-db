<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/course_prerequisites.php");
    exit();
}

$primary_course = json_decode($_POST['primary_course'], true);
$prerequisite_course = json_decode($_POST['prerequisite_course'], true);

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/course_prerequisites_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":course_id", $primary_course['course_id']);
    $stmt->bindParam(":prerequisite_id", $prerequisite_course['course_id']);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/course_prerequisites.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}