<?php
    require_once "../pdo.php";
    session_start();
?>
<html>
    <head>
        <title>Mr. Azhar's - Database</title>
        <meta charset="UTF-8">
        <!-- Custom CSS file -->
        <link rel="stylesheet" href="../starter-template.css">
    </head>
    <body>
        <div class = 'container'>
            <h1></h1>
            <p>
                <table>
                    <?php
                        if ( isset($_SESSION['error']) ) {
                            echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
                            unset($_SESSION['error']);
                        }
                        if ( isset($_SESSION['success']) ) {
                            echo '<p style="color:green">'.$_SESSION['success']."</p>\n";
                            unset($_SESSION['success']);
                        }
                        echo('<table border="1">'."\n");
                        $stmt = $pdo->query("SELECT name, email, password, user_id FROM users");
                        while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
                            echo "<tr><td>";
                            echo(htmlentities($row['name']));
                            echo("</td><td>");
                            echo(htmlentities($row['email']));
                            echo("</td><td>");
                            echo(htmlentities($row['password']));
                            echo("</td><td>");
                            echo('<a href="edit.php?user_id='.$row['user_id'].'">Edit</a> / ');
                            echo('<a href="delete.php?user_id='.$row['user_id'].'">Delete</a>');
                            echo("</td></tr>\n");
                        }
                    ?>
                </table>
            </p>
        <div>
        <a href="add.php">Add New</a>
    </body>
</html>