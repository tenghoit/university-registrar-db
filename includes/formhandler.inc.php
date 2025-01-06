<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/courses.php");
    exit();
}

$course_discipline = $_POST['course_discipline'];
$course_number = $_POST['course_number'];
$course_name = $_POST['course_name'];
$course_credits = $_POST['course_credits'];
$course_description = $_POST['course_description'];

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/courses_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":course_discipline", $course_discipline);
    $stmt->bindParam(":course_number", $course_number);
    $stmt->bindParam(":course_name", $course_name);
    $stmt->bindParam(":course_credits", $course_credits);
    $stmt->bindParam(":course_description", $course_description);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/courses.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}