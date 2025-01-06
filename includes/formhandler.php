<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/");
    exit();
}

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/");
    $stmt = $pdo->prepare($query);


    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}