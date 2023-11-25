<?php
    require_once "../pdo.php";

    if (isset($_POST['cancel']))
    {
        // Redirect the browser to autos.php
        header("Location: index.php");
        return;
    }

    $salt = 'XyZzy12*_';
    $stored_hash = hash('md5', 'XyZzy12*_php123');;  // Password is php123
    $failure = false;  // If we have no POST data

    // Check to see if we have some POST data, if we do process it
    if (isset($_POST['who']) && isset($_POST['pass']))
    {
        if (strlen($_POST['who']) < 1 || strlen($_POST['pass']) < 1)
        {
            $failure = "User name and password are required";
        }
        else if (strpos($_POST['who'], "@") === false)
        {
            $failure = "Email must have an at-sign (@)";
        }
        else
        {
            $check = hash('md5', $salt . $_POST['pass']);
            if ($check == $stored_hash)
            {
                error_log("Login success ".$_POST['who']);
                // Redirect the browser to Autos.php
                header("Location: autos.php?name=".urlencode($_POST['who']));
                return;
            }
            else
            {
                $failure = "Incorrect password";
                error_log("Login fail ".$_POST['who']." $check");
                echo "<p style='color: red'>Incorrect password</p>";
            }
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Muhammed Azhar</title>
    <meta charset="UTF-8">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
        integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
        integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Please Login</h1>
        <form method="post">
            <b>
                <p>User Name:
                    <input type="text" size="40" name="who">
                </p>
                <p>Password:
                    <input type="text" size="40" name="pass">
                </p>
            </b>
            <p>
                <input type="submit" value="Log In">
                <input type="submit" name="cancel" value="Cancel">
            </p>
            <p>
                For a password hint, view source and find a password hint
                in the HTML comments.
                <!-- Hint: The password is the three character name of the 
                programming language used in this class (all lower case) 
                followed by 123. -->
            </p>
        </form>
    </div>
</body>
</html>