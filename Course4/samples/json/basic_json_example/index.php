<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require_once "bootstrap-jquery.php" ?>

    <title>Demonstration of basic json in php</title>
</head>

<body>
    <div class="container">

        <div id="entry">

        </div>
    </div>


    <script>
    $(document).ready(function() {
        $.getJSON("return-json.php", function(data) {
            $("#entry").html(data.first);
        });
    });
    </script>
</body>

</html>