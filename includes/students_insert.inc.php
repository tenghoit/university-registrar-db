<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/students.php");
    exit();
}

$user = json_decode($_POST['user'], true);

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/students_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":student_id", $user['user_id']);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/students.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}