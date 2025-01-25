<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/student_class_history.php");
    exit();
}

try {
    require_once "dbh.inc.php";
    
    if(isset($_POST['delete']) && !empty($_POST['selects'])){
        $query = file_get_contents("../queries/student_class_history_delete.sql");
        $stmt = $pdo->prepare($query);
        
        // var_dump($_POST['selects']);
        foreach($_POST['selects'] AS $record){
            $row = json_decode($record, true);

            $stmt->bindParam(":student_id", $row['student_id']);
            $stmt->bindParam(":class_id", $row['class_id']);
            $stmt->execute();
        }
    }

    if(isset($_POST['edit']) && !empty($_POST['edit'])){
        $row = json_decode($_POST['edit'], true);

        if ($row) {
            echo '<form id="redirectForm" action="../php/student_class_history_edit.php" method="POST">';
            foreach ($row as $key => $value) {
                echo '<input type="hidden" name="' . htmlspecialchars($key) . '" value="' . htmlspecialchars($value) . '">';
            }
            echo '<input type="hidden" name="edit" value="1">';
            echo '<button type="submit">submit</button>';
            echo '</form>';
            echo '<script>
                    const form = document.getElementById("redirectForm");
                    form.submit();
                </script>';

            die();
        }
         else {
            die("Invalid row data for editing.");
        }
    
    }

    $pdo = null;
    $stmt = null;

    header("Location: ../php/student_class_history.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}