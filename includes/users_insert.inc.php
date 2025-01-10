<?php

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    header("Location: ../php/users.php");
    exit();
}

$user_first_name = $_POST['user_first_name'];
$user_last_name = $_POST['user_last_name'];
$user_email = $_POST['user_email'];
$user_phone_number = $_POST['user_phone_number'];
$user_street = $_POST['user_street'];
$user_city = $_POST['user_city'];
$user_state = $_POST['user_state'];
$user_zip_code = $_POST['user_zip_code'];

try {
    require_once "dbh.inc.php";
    $query = file_get_contents("../queries/users_insert.sql");
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(":user_first_name", $user_first_name);
    $stmt->bindParam(":user_last_name", $user_last_name);
    $stmt->bindParam(":user_email", $user_email);
    $stmt->bindParam(":user_phone_number", $user_phone_number);
    $stmt->bindParam(":user_street", $user_street);
    $stmt->bindParam(":user_city", $user_city);
    $stmt->bindParam(":user_state", $user_state);
    $stmt->bindParam(":user_zip_code", $user_zip_code);

    $stmt->execute();

    $pdo = null;
    $stmt = null;

    header("Location: ../php/users.php");
    die();
} catch (PDOException $e) {
    die("Query Failed: " . $e->getMessage());
}
