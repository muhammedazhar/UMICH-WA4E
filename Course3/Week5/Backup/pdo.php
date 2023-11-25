<?php
    // Define your sensitive database credentials (consider storing them in a secure location).
    $hostName = "localhost";
    $dbName = "misc";
    //Type your database username and password in the below variables.
    $userName = "azhar"; 
    $password = "azhar.mypassword$123#";

    try {
        // Establish a connection to the database
        $pdo = new PDO("mysql:host=$hostName;dbname=$dbName", $userName, $password);

        // Set the error mode to throw exceptions for database errors
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        // Log the error or display a generic error message to the uesr like
        // error_log() to log the error to a file or use a more user-friendly
        // error message like "Oops! Something went wrong."
        echo "Oops! Something went wrong. ";
        // In a production environment, do not display the actual error message to users.
    }
?>