<?php
    require_once "pdo.php";
    require_once "util.php";
    session_start();

    if (!isset($_SESSION['name'])) {
        die("ACCESS DENIED");
    }

    if (isset($_POST['cancel'])) {
        header("Location: index.php");
        return;
    }

    if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && isset($_POST['headline']) && isset($_POST['summary'])  ) {
        
        $msg = validate();
        if (is_string($msg)) {
            $_SESSION['error'] = $msg;
            header("Location: add.php");
            return;  
        }

        $msg = validatePos();
        if (is_string($msg)) {
            $_SESSION['error'] = $msg;
            header("Location: add.php");
            return;
        }

        $sql = "INSERT INTO profile (user_id, first_name, last_name, email, headline, summary) VALUES (:uid, :fn, :ln, :em, :he, :su)";

        $statement = $pdo->prepare($sql);

        $statement->execute(array(
            ":uid" => $_SESSION['user_id'],
            ":fn" => $_POST['first_name'],
            ":ln" => $_POST['last_name'],
            ":em" => $_POST['email'],
            ":he" => $_POST['headline'],
            ":su" => $_POST['summary']
        ));

        $profile_id = $pdo->lastInsertId();

        $rank = 1;

        for($i = 1; $i <= 9; $i++) {
            if (! isset($_POST['year'.$i])) continue;
            if (! isset($_POST['desc'.$i])) continue;
            $year = $_POST['year'.$i];
            $desc = $_POST['desc'.$i];
            
            $statement = $pdo->prepare("INSERT INTO position (profile_id, rank, year, description) VALUES(:pid, :rank, :year, :desc)");
            
            $statement->execute(array(
                ":pid" => $profile_id,
                ":rank" => $rank,
                ":year" => $year,
                ":desc" => $desc
            ));

            $rank++;
        }

        $_SESSION['success'] = "Profile added";
        header("Location: index.php");
        return;

    }
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Something</title>
    <?php require_once "bootstrap.php"?>
</head>

<body style="padding: 20px;">

    <h1>Adding Profile for <?php if (isset($_SESSION['name'])) {
        echo $_SESSION['name']; 
    } ?> </h1>

    <?php 
        flash();
    ?>

    <form method="POST">
        <p>
            First Name: <input type="text" name="first_name" />
        </p>
        <p>
            Last Name: <input type="text" name="last_name" />
        </p>
        <p>
            Email: <input type="text" name="email" />
        </p>
        <p>
            Headline: <input type="text" name="headline" />
        </p>
        <p>
            Summary: <textarea name="summary" rows="8" cols="80"></textarea>
        </p>
        <p>Position: <input type="submit" id="addPos" value="+" /></p>
        <div id="position_fields">
        </div>
        <input type="submit" name="submit" value="Add" />
        <input type="submit" name="cancel" value="Cancel" />
    </form>

    <script>
    $(document).ready(function() {
        countPos = 0;
        $(document).ready(function() {
            window.console && console.log('Document ready called');
            $('#addPos').click(function(event) {
                event.preventDefault();
                if (countPos >= 9) {
                    alert("Maximum of nine position entries exceeded");
                    return;
                }
                countPos++;
                window.console && console.log("Adding position " + countPos);
                $('#position_fields').append(
                    '<div id="position' + countPos + '"> \
            <p>Year: <input type="text" name="year' + countPos + '" value="" /> \
            <input type="button" value="-" \
                onclick="$(\'#position' + countPos + '\').remove();return false;"></p> \
            <textarea name="desc' + countPos + '" rows="8" cols="80"></textarea>\
            </div>');
            });
        });
    });
    </script>
</body>

</html>