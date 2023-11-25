<html>
<head>
    <title>Muhammed Azhar - Database Reset</title>
    <meta charset="UTF-8">
    <!-- Custom CSS file -->
    <link rel="stylesheet" href="starter-template.css">
</head>
<body>
    <div class = 'container'>
        <?php
        require_once "pdo.php";
        try {
            // Drop the autos table if it exists
            $sql_drop = "DROP TABLE IF EXISTS misc.autos";
            $pdo->exec($sql_drop);
        
            // Create the autos table
            $sql_create = "CREATE TABLE IF NOT EXISTS misc.autos (
                auto_id INTEGER UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                make VARCHAR(255),
                model VARCHAR(255),
                year INTEGER,
                mileage INTEGER
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        
            $pdo->exec($sql_create);
        
            echo "<h2>Table reset successfully</h2>";
        }
        catch (PDOException $e) {
            echo "<h2>Error has occurred. Check if the database and users have been set up properly.</h2>";
            echo "<br />" . $e->getMessage() . "<br />";
        }
        ?>
    </div>
</body>
</html>