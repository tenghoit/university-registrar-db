<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/degrees.php");
    exit();
}

$degree_name = $_POST['degree_name'];
$degree_type = json_decode($_POST['degree_type'], true);
$degree_type = $degree_type['degree_type'];

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/degrees_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":degree_name", $degree_name);
    $stmt->bindParam(":degree_type", $degree_type);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/degrees.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}