<?php
    session_start();
    require_once "pdo.php";
    if ( ! isset($_SESSION['name']) ) {
        die('Not logged in');
    }
    else {
        $name = $_SESSION['name'];
    }
    $stmt = $pdo->query("SELECT make, year, mileage FROM autos");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mr. Azhar's Automobile Tracker</title>
        <meta charset="UTF-8">
        <!-- Custom CSS file -->
        <link rel="stylesheet" href="../starter-template.css">
    </head>
    <body>
        <div class="container">
            <h1>Tracking Autos for <?php echo $_SESSION['name'];?></h1>
            <?php
            if (isset($_SESSION['record_success'])) {
                echo '<p style="color: green;">' . htmlentities($_SESSION['record_success']) . "</p>";
                unset($_SESSION['record_success']); // Clear the success message from the session
            }
            ?>
            <h2>Automobiles</h2>
            <ul>
                <?php
                    foreach ($rows as $row) {
                        echo '<li>';
                        echo htmlentities($row['make']) . ' ' . $row['year'] . ' / ' . $row['mileage'];
                    };
                    echo '</li><br/>';
                ?>
            </ul>
            <p>
                <a href="add.php">Add New</a> |
                <a href="logout.php">Logout</a>
            </p>
        </div>
    </body>
</html>