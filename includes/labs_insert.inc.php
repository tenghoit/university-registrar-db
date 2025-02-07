<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/labs.php");
    exit();
}

$primary_course = json_decode($_POST['primary_course'], true);
$parent_course = json_decode($_POST['parent_course'], true);

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/labs_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":course_id", $primary_course['course_id']);
    $stmt->bindParam(":parent_course_id", $parent_course['course_id']);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/labs.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}