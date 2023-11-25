<?php
// Start the session
session_start();

// Include the PDO database connection
require_once "pdo.php";

// Check if 'profile_id' is in the URL
if (!isset($_GET['profile_id'])) {
    // Set an error message in the session
    $_SESSION['error'] = "Missing profile_id";
    
    // Redirect to the index.php page
    header('Location: index.php');
    return;
}

// Prepare and execute a database query to retrieve the profile
$stmt = $pdo->prepare("SELECT * FROM Profile WHERE profile_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['profile_id']));

// Fetch the profile data as an associative array
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Muhammed Azhar's Page</title>
    <!-- Include Bootstrap CSS -->
    <?php require_once "bootstrap.php"; ?>
</head>
<body>
<div class="container">
    <h1 class="display-4">Profile Information</h1>

    <div class="row">
        <div class="col-md-6">
            <p><strong>First Name:</strong> <?php echo $row['first_name']; ?></p>
            <p><strong>Last Name:</strong> <?php echo $row['last_name']; ?></p>
            <p><strong>Email:</strong> <?php echo $row['email']; ?></p>
        </div>
        <div class="col-md-6">
            <p><strong>Headline:</strong><br /> <?php echo $row['headline']; ?></p>
            <p><strong>Summary:</strong><br /> <?php echo $row['summary']; ?></p>
        </div>
    </div>

    <a href="index.php" class="btn btn-primary">Done</a>
</div>
</body>
</html>