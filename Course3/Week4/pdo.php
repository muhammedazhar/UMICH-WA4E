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
    echo "Oops! Something went wrong. ";
}
?>