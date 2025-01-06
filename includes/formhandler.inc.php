<?php

if ($_SERVER != 'POST') {
    header("Location: ../index.php");
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
    
    $stmt->execute([
        $course_discipline, 
        $course_number, 
        $course_name, 
        $course_credits, 
        $course_description
    ]);

    $pdo = null;
    $stmt = null;

    header("Location: ../php/courses.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}