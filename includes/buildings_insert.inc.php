<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/locations.php");
    exit();
}

$building_name = $_POST['building_name'];

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/buildings_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":building_name", $building_name);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/locations.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}