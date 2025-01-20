<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/course_prerequisites.php");
    exit();
}

try {
    require_once "dbh.inc.php";
    
    if(isset($_POST['delete']) && !empty($_POST['selects'])){
        $query = file_get_contents("../queries/course_prerequisites_delete.sql");
        $stmt = $pdo->prepare($query);
        
        // var_dump($_POST['selects']);
        foreach($_POST['selects'] AS $record){
            $row = json_decode($record, true);

            $stmt->bindParam(":course_id", $row['primary_course_id']);
            $stmt->bindParam(":prerequisite_id", $row['prerequisite_course_id']);
            $stmt->execute();
        }
    }

    $pdo = null;
    $stmt = null;

    header("Location: ../php/course_prerequisites.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}