<!DOCTYPE html>
<html>

<head>
    <title>Azhar 758f0bc5</title>
    <!-- Include Bootstrap CSS -->
    <?php require_once "bootstrap.php";?>
</head>
<?php 
    // Include the database connection file
    require "pdo.php";

    // Start a session
    session_start();
?>
<body>
    <h1>Muhammed Azhar's Resume Registry</h1>

    <?php
        // Display a success message if set in the session
        if (isset($_SESSION['success'])) {
            echo "<p style='color: green'>".$_SESSION['success']."</p>";
            unset($_SESSION['success']);
        }

        // Check if a user is logged in
        if (isset($_SESSION['name'])) {
            echo "<a href='logout.php'>Logout</a><br />";
        } else {
            echo "<a href='login.php'>Please log in</a>";
        }

        // Query the database for profiles
        $statement = $pdo->query("SELECT * FROM profile");
        $row = $statement->fetch(PDO::FETCH_ASSOC);

        if ($row != false) {
            $statement = $pdo->query("SELECT * FROM profile");

            // Display a table of profiles
            echo "<table border='1'>
                <tbody>
                <tr> 
                    <th>Name</th>
                    <th>Headline</th>";

            if (isset($_SESSION['name'])) {
                echo "<th>Action</th>";
            }
            
            echo "</tr>";

            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>".$row['first_name']." ".$row['last_name']."</td>";
                echo "<td>".$row['email']."</td>";

                if (isset($_SESSION['name'])) {
                    echo "<td>
                        <a href='edit.php?profile_id=".$row['profile_id']."'>Edit</a>
                        <a href='delete.php?profile_id=".$row['profile_id']."'>Delete</a>
                    </td>";
                }
                
                echo "</tr>";
            }

            echo "</tbody></table>";
        }

        if (isset($_SESSION['name'])) {
            echo "<a href='add.php'>Add New Entry</a>";
        } 
    ?>
</body>
</html>