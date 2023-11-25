<?php
    require_once "../pdo.php";
    session_start();
    $stmt = $pdo->query("SELECT autos_id, make, model, year, mileage FROM autos");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Muhammed Azhar's Index Page</title>
        <meta charset="UTF-8">
        <!-- Custom CSS file -->
        <link rel="stylesheet" href="../starter-template.css">
    </head>
    <body>
        <div class="container">
            <h2>Welcome to the Automobiles Database</h2>
            <?php
                if (isset($_SESSION['form_success'])) {
                    echo('<p style="color: green;">' . htmlentities($_SESSION['form_success']) . "</p>\n");
                    unset($_SESSION['form_success']);
                }
            ?>
            <ul>
                <?php
                    if (isset($_SESSION['name'])) {
                        if (sizeof($rows) > 0) {
                            echo "<table border='1'>";
                            echo "<thead><tr>";
                            echo "<th>Make</th>";
                            echo "<th>Model</th>";
                            echo "<th>Year</th>";
                            echo "<th>Mileage</th>";
                            echo "<th>Action</th>";
                            echo "</tr></thead>";
                            foreach ($rows as $row) {
                                echo "<tr><td>";
                                echo($row['make']);
                                echo("</td><td>");
                                echo($row['model']);
                                echo("</td><td>");
                                echo($row['year']);
                                echo("</td><td>");
                                echo($row['mileage']);
                                echo("</td><td>");
                                echo('<a href="edit.php?autos_id='.$row['autos_id'].'">Edit</a> / <a href="delete.php?autos_id='.$row['autos_id'].'">Delete</a>');
                                echo("</td></tr>\n");
                            } echo "</table>";
                        }
                        else {
                            echo 'No rows found';
                        }
                        echo '</li><br/></ul>';
                        echo '<p><a href="add.php">Add New Entry</a></p>
                        <p>
                            <a href="logout.php">Logout</a>
                        </p>
                        <p>
                            <b>
                                Note:
                            </b>
                            Your implementation should retain data across multiple logout/login sessions. This sample implementation clears all its data on logout - which you should not do in your implementation.
                        </p>';
                    }
                    else {
                        echo "<p><a href='login.php'>Please log in</a></p><p>Attempt to <a href='add.php'>add data</a> without logging in</p>";
                    }
                ?>
            </ul>
        </div>
    </body>
</html>
