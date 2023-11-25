<?php 
    require_once "pdo.php";
    require_once "util.php";

    if (!isset($_GET['profile_id'])) {
        $_SESSION['error'] = "Could not load profile";
        header("Location: index.php");
        return;
    }

    $statement = $pdo->prepare("SELECT * FROM profile WHERE profile_id = :pid");

    $statement->execute(array(
        ":pid" => $_GET['profile_id']
    ));

    $row = $statement->fetch(PDO::FETCH_ASSOC);

    if ($row == false) {
        $_SESSION['error'] = "Could not load profile";
        header("Location: index.php");
        return;
    }
    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Muhammed Azhar's Page</title>
    <!-- Include Bootstrap CSS -->
    <?php require_once "bootstrap.php";?>
</head>
<body>

    <div class="container">
        <p>First Name: <?= $row['first_name'] ?></p>
        <p>Last Name: <?= $row['last_name'] ?></p>
        <p>Email: <?= $row['email'] ?></p>
        <p>Headline: <?= $row['headline'] ?></p>
        <p>Summary: <?= $row['summary'] ?></p>
        <ul>
            <?php 

            $statement = $pdo->prepare("SELECT * FROM position WHERE profile_id = :pid");

            $statement->execute(array(
                ":pid" => $row['profile_id']
            ));

            while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<li>".$row['year']." ".$row['description']."</li>";      
            }

        ?>
        </ul>
        <a href="index.php">Done</a>
    </div>
</body>
</html>