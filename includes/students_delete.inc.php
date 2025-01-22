<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/students.php");
    exit();
}

try {
    require_once "dbh.inc.php";
    
    if(isset($_POST['delete']) && !empty($_POST['selects'])){
        $query = file_get_contents("../queries/students_delete.sql");
        $stmt = $pdo->prepare($query);
        
        // var_dump($_POST['selects']);
        foreach($_POST['selects'] AS $record){
            $row = json_decode($record, true);

            $stmt->bindParam(":student_id", $row['student_id']);
            $stmt->execute();
        }
    }

    if(isset($_POST['edit']) && !empty($_POST['edit'])){
        $row = json_decode($_POST['edit'], true);

        if ($row) {
            echo '<form id="redirectForm" action="../php/users_edit.php" method="POST">';

            echo '<input type="hidden" name="user_id" value="' . htmlspecialchars($row['student_id']) . '">';
            echo '<input type="hidden" name="user_first_name" value="' . htmlspecialchars($row['student_first_name']) . '">';
            echo '<input type="hidden" name="user_last_name" value="' . htmlspecialchars($row['student_last_name']) . '">';
            echo '<input type="hidden" name="user_email" value="' . htmlspecialchars($row['student_email']) . '">';
            echo '<input type="hidden" name="user_phone_number" value="' . htmlspecialchars($row['student_phone_number']) . '">';
            echo '<input type="hidden" name="user_address" value="' . htmlspecialchars($row['student_address']) . '">';
            echo '<input type="hidden" name="user_city" value="' . htmlspecialchars($row['student_city']) . '">';
            echo '<input type="hidden" name="user_state" value="' . htmlspecialchars($row['student_state']) . '">';
            echo '<input type="hidden" name="user_zip_code" value="' . htmlspecialchars($row['student_zip_code']) . '">';

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

    header("Location: ../php/students.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}