<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/locations.php");
    exit();
}

try {
    require_once "dbh.inc.php";
    
    if(isset($_POST['delete']) && !empty($_POST['selects'])){
        $query = file_get_contents("../queries/buildings_delete.sql");
        $stmt = $pdo->prepare($query);
        
        // var_dump($_POST['selects']);
        foreach($_POST['selects'] AS $record){
            $row = json_decode($record, true);

            $stmt->bindParam(":building_name", $row['building_name']);
            $stmt->execute();
        }
    }

    $pdo = null;
    $stmt = null;

    header("Location: ../php/locations.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}