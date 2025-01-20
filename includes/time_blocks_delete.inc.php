<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/time_blocks.php");
    exit();
}

try {
    require_once "dbh.inc.php";
    
    if(isset($_POST['delete']) && !empty($_POST['selects'])){
        $query = file_get_contents("../queries/time_blocks_delete.sql");
        $stmt = $pdo->prepare($query);
        
        // var_dump($_POST['selects']);
        foreach($_POST['selects'] AS $record){
            $row = json_decode($record, true);

            $stmt->bindParam(":start_time", $row['start_time']);
            $stmt->bindParam(":end_time", $row['end_time']);
            $stmt->execute();
        }
    }

    $pdo = null;
    $stmt = null;

    header("Location: ../php/time_blocks.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}