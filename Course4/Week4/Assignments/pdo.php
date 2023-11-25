<?php
    // Setting login credentials as variables.
    // Note: Yours might be different so feel free to change it.
    $hostName = "localhost";
    $userName = "UMICH-WA4E";
    $password = "s&nDwh1ch";
    $port = "8889";
    $dbName = "js";

    try {
        $pdo = new PDO("mysql:host=$hostName; port=$port; dbname=$dbName", $userName, $password);
        //ERRMODE_SILENT is default.
        //ERRMODE_WARNING will still keep executing code.
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
?>