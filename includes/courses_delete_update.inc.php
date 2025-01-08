<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/courses.php");
    exit();
}

try {
    require_once "dbh.inc.php";
    
    if(isset($_POST['delete']) && !empty($_POST['selects'])){
        $query = file_get_contents("../queries/courses_delete.sql");
        $stmt = $pdo->prepare($query);
        
        // var_dump($_POST['selects']);
        foreach($_POST['selects'] AS $record){
            $row = json_decode($record, true);

            $stmt->bindParam(":course_id", $row['course_id']);
            $stmt->execute();
        }
    }


    // $query = file_get_contents("../queries/");
    // $stmt = $pdo->prepare($query);
    // $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/courses.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}