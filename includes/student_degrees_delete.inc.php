<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/student_degrees.php");
    exit();
}

try {
    require_once "dbh.inc.php";
    
    if(isset($_POST['delete']) && !empty($_POST['selects'])){
        $query = file_get_contents("../queries/student_degrees_delete.sql");
        $stmt = $pdo->prepare($query);
        
        // var_dump($_POST['selects']);
        foreach($_POST['selects'] AS $record){
            $row = json_decode($record, true);

            $stmt->bindParam(":student_id", $row['student_id']);
            $stmt->bindParam(":degree_id", $row['degree_id']);
            $stmt->execute();
        }
    }

    $pdo = null;
    $stmt = null;

    header("Location: ../php/student_degrees.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}