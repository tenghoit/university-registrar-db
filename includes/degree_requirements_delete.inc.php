<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/degree_requirements.php");
    exit();
}

try {
    require_once "dbh.inc.php";
    
    if(isset($_POST['delete']) && !empty($_POST['selects'])){
        $query = file_get_contents("../queries/degree_requirements_delete.sql");
        $stmt = $pdo->prepare($query);
        
        // var_dump($_POST['selects']);
        foreach($_POST['selects'] AS $record){
            $row = json_decode($record, true);

            $stmt->bindParam(":degree_id", $row['degree_id']);
            $stmt->bindParam(":course_id", $row['course_id']);
            $stmt->execute();
        }
    }

    $pdo = null;
    $stmt = null;

    header("Location: ../php/degree_requirements.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}