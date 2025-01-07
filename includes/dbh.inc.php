<?php

try {
    $config = parse_ini_file('../configs/mysql.ini');
    $host = $config['mysqli.default_host'];
    $dbname = 'university_registrar';
    $dsn = "mysql:host={$host};dbname={$dbname}";

    $pdo = new PDO(
        $dsn,
        $config['mysqli.default_user'],
        $config['mysqli.default_pw']
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}