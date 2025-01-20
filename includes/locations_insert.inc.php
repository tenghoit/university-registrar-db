<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/locations.php");
    exit();
}

$building_name = $_POST['building_name'];
$room_number = $_POST['room_number'];
$room_capacity = $_POST['room_capacity'];

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/locations_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":building_name", $building_name);
    $stmt->bindParam(":room_number", $room_number);
    $stmt->bindParam(":room_capacity", $room_capacity);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/locations.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}