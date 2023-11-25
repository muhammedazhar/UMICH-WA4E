<?php
    echo "<pre>\n";
    $hostName = "localhost";
    $userName = "UMICH-WA4E";
    $password = "s&nDwh1ch";
    $port = "8889";
    $dbName = "misc";

    $pdo = new PDO("mysql:host=$hostName; port=$port; dbname=$dbName", $userName, $password);

    $stmt = $pdo->query("SELECT * FROM users");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    print_r($rows);

    echo "</pre>\n";
?>