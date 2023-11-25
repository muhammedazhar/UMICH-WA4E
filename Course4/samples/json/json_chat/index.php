<?php
    session_start();
    if (isset($POST['reset'])) {
        $_SESSION['chats'] = Array();
        header("Location: index.php");
        return;
    }

    if (isset($_POST['message'])) {
        if (!isset($_SESSION['chats'])) $_SESSION['chats'] = Array();
        $_SESSION['chats'] [] = array($_POST['message'], date(DATE_RFC2822));
        header("Location: index.php");
        return;
    }

    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once "bootstrap-jquery.php" ?>
    <title>Chat App using sessions</title>
</head>

<body>
    <div class="container py-5">
        <form method="post">
            <p>
                <input type="text" name="message" size="60" />
                <input type="submit" name="submit" value="chat" />
                <input type="submit" name="reset" value="Reset" />
            </p>
        </form>
        <div id="chatcontent">
            <div id="loading">
                Loading chats...
            </div>
        </div>
    </div>

    <script type="text/javascript">
    function updateMsg() {
        console.log("Trying to fetch message");
        $.ajax({
            url: "chatlist.php",
            cache: false,
            success: function(data) {
                console.log("HERE");
                $("#chatcontent").empty();
                if (data.length != 0) {
                    for (let i = 0; i < data.length; i++) {
                        let entry = data[i];
                        $("#chatcontent").append(
                            `<p>${entry[0]}<br /><small>${entry[1]}</small></p>`);
                    }
                } else {
                    $("#chatcontent").html("No chats to display");
                }
                setTimeout("updateMsg()", 4000);
            }
        });
    }
    $(document).ready(function() {
        updateMsg();
    });
    </script>
</body>

</html>