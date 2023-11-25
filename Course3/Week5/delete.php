<?php
    require_once "../pdo.php";
    session_start();
    if (!isset($_SESSION['name'])) {
        die('ACCESS DENIED');
    }
    if ( isset($_POST['delete']) && isset($_POST['autos_id']) ) {
        $sql = "DELETE FROM autos WHERE autos_id = :zip";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(':zip' => $_POST['autos_id']));
        $_SESSION['success'] = 'Record deleted';
        header( 'Location: index.php' );
        return;
    }
    if ( ! isset($_GET['autos_id']) ) {
        $_SESSION['error'] = "Missing user_id";
        header('Location: index.php');
        return;
    }
    $stmt = $pdo->prepare("SELECT make FROM autos where autos_id = :xyz");
    $stmt->execute(array(":xyz" => $_GET['autos_id']));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if ( $row === false ) {
        $_SESSION['error'] = 'Bad value for user_id';
        header('Location: index.php');
        return;
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Muhammed Azhar's Autos Database</title>
        <meta charset="UTF-8">
        <!-- Custom CSS file -->
        <link rel="stylesheet" href="../starter-template.css">
    </head>
    <body>
        <div class="container">
            <p>Confirm: Deleting <?php echo $row['make'] ?></p>
            <form method="post">
                <input type="hidden" name="autos_id" value="<?php echo $_GET['autos_id'] ?>">
                <input type="submit" value="Delete" name="delete"><a href="index.php">Cancel</a>
            </form>
        </div>
    </body>
</html>