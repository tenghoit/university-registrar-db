<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/classes.php");
    exit();
}

$course = json_decode($_POST['course'], true);
$section = $_POST['section'];
$term = json_decode($_POST['term'], true);
$professor = json_decode($_POST['professor'], true);
$location = json_decode($_POST['location'], true);
$class_max_capacity = $_POST['class_max_capacity'];

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/classes_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":course_id", $course['course_id']);
    $stmt->bindParam(":section", $section);
    $stmt->bindParam(":term_id", $term['term_id']);
    $stmt->bindParam(":professor_id", $professor['professor_id']);
    $stmt->bindParam(":building_name", $location['building_name']);
    $stmt->bindParam(":room_number", $location['room_number']);
    $stmt->bindParam(":class_max_capacity", $class_max_capacity);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/classes.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}