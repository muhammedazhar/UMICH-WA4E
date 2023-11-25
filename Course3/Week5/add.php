<?php
    require_once "../pdo.php";
    unset($notice);
    session_start();
    if (!isset($_SESSION['name'])) {
        die("ACCESS DENIED");
    }
    if (
        isset($_POST['make']) &&
        isset($_POST['model']) &&
        isset($_POST['year']) &&
        isset($_POST['mileage'])
    ) {
        if (
            strlen($_POST['make']) < 1 ||
            strlen($_POST['model']) < 1 ||
            strlen($_POST['year']) < 1 ||
            strlen($_POST['mileage']) < 1
        ) {
            $_SESSION['form_error'] = "All values are required";
            header("Location: add.php");
            return;
        }
        if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
            $_SESSION['form_error'] = "Mileage and year must be numeric";
            header("Location: add.php");
            return;
        }
        else {
            $stmt = $pdo->prepare('INSERT INTO autos (make, model, year, mileage) VALUES ( :make, :model, :year, :mileage)');
            $stmt->execute(array(
                ':make' => $_POST['make'],
                ':model' => $_POST['model'],
                ':year' => $_POST['year'],
                ':mileage' => $_POST['mileage'])
            );
            $_SESSION['form_success'] = "Record added.";
            header("Location: index.php");
            return;
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Muhammed Azhar's Login Page</title>
        <meta charset="UTF-8">
        <!-- Custom CSS file -->
        <link rel="stylesheet" href="../starter-template.css">
    </head>
    <div class="container">
        <body style="font-family: sans-serif;">
            <h1>Tracking Autos for <?php echo $_SESSION['name']; ?></h1>
            <?php
                if (isset($_SESSION['form_error'])) {
                    $notice = $_SESSION['form_error'];
                    print('<p style="color:red">'.$notice."</p>\n");
                    unset($_SESSION['form_error']);
                }
            ?>
            <form method="post">
                <p>Make:
                <input type="text" name="make" size="40"/></p>
                <p>Model:
                <input type="text" name="model" size="40"/></p>
                <p>Year:
                <input type="text" name="year" size="10"/></p>
                <p>Mileage:
                <input type="text" name="mileage" size="10"/></p>
                <input type="submit" name='add' value="Add">
                <button type="button" onclick="window.location.href='index.php'">Cancel</button>
            </form>
        </body>
    </div>
</html>