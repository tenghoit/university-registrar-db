<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/terms.php");
    exit();
}

$term_id = $_POST['term_id'];
$term_start_date = $_POST['term_start_date'];
$term_end_date = $_POST['term_end_date'];

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/terms_update.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":term_id", $term_id);
    $stmt->bindParam(":term_start_date", $term_start_date);
    $stmt->bindParam(":term_end_date", $term_end_date);
    
    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/terms.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}