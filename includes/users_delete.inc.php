<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/users.php");
    exit();
}

try {
    require_once "dbh.inc.php";
    
    if(isset($_POST['delete']) && !empty($_POST['selects'])){
        $query = file_get_contents("../queries/users_delete.sql");
        $stmt = $pdo->prepare($query);
        
        // var_dump($_POST['selects']);
        foreach($_POST['selects'] AS $record){
            $row = json_decode($record, true);

            $stmt->bindParam(":user_id", $row['user_id']);
            $stmt->execute();
        }
    }

    if(isset($_POST['edit']) && !empty($_POST['edit'])){
        $row = json_decode($_POST['edit'], true);

        if ($row) {
            echo '<form id="redirectForm" action="../php/users_edit.php" method="POST">';
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

    header("Location: ../php/users.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}