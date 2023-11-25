<?php
    session_start();
    if (!isset($_SESSION['name'])) {
        die('Not logged in');
    }
    require_once "pdo.php";
    if (isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
        if (strlen($_POST['make']) < 1) {
            $_SESSION['form_error'] = "Make is required";
            header("Location: add.php");
            return;
        }
        elseif (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
            $_SESSION['form_error'] = "Mileage and year must be numeric";
            header("Location: add.php");
            return;
        }
        else {
            $stmt = $pdo->prepare('INSERT INTO autos (make, year, mileage) VALUES ( :make, :year, :mileage)');
            $stmt->execute(array(
                    ':make' => $_POST['make'],
                    ':year' => $_POST['year'],
                    ':mileage' => $_POST['mileage'])
            );
            $_SESSION['record_success'] = "Record inserted";
            header("Location: view.php");
            return;
        }
    }
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
            <h1>Tracking Autos for <?php echo $_SESSION['name']; ?></h1>
            <?php
                if ( isset($_SESSION['form_error']) ) {
                    echo('<p style="color:red">'.$_SESSION['form_error']."</p>\n");
                    unset($_SESSION['form_error']);
                }
            ?>
            <form method="post">
                <p>Make:
                    <input type="text" name="make" size="60"/>
                </p>
                <p>Year:
                    <input type="text" name="year"/>
                </p>
                <p>Mileage:
                    <input type="text" name="mileage"/>
                </p>
                <input type="submit" value="Add">
                <input type="submit" name="cancel" value="Cancel">
            </form>
        </div>
    </body>
</html>