<!DOCTYPE html>
<html>
    <head>
        <title>Weather History</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav>
                <div class="navbar">
                    <a href="index.html">Generate Report</a>
                    <a href="history.php">View Report History</a>
                </div>
            </nav>
        </header>
        <h1>View Report History</h3>
        <?php
            $host = "localhost";
            $dbname = "weatherdb";
            $username = "root";
            $password = "root";
            try{
                $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

            }
            catch(PDOException $exception){
                echo "Error connecting and pulling from DB: " . $exception->getMessage();
            }



        ?>
    </body>
































</html>