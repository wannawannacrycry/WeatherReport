<!DOCTYPE html>
<html>
    <head>
        <title>Weather History</title>
        <link rel="icon" type="image/x-icon" href="images\favicon.ico">
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
                $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password); // connect to DB

                $countStatement = $connection->query("SELECT COUNT(*) as total FROM weather_history"); // Get count of entries
                $totalCount = $countStatement->fetch(PDO::FETCH_ASSOC)["total"];
                
                $stateStatement = $connection->query("SELECT COUNT(DISTINCT state_name) as states FROM weather_history"); // Get count of unique states
                $stateCount = $stateStatement->fetch(PDO::FETCH_ASSOC)["states"];
                
                echo "<div class='search-stats'>";
                    echo "Total Searches: $totalCount | Unique States: $stateCount";
                echo "</div>";
        ?>
        <table>
        <tr>
            <th>ID</th>
            <th>City</th>
            <th>State</th>
            <th>Temperature (°F)</th>
            <th>Description</th>
            <th>Wind Speed (mph)</th>
            <th>Date Recorded</th>
        </tr>
        <?php

            $statement = $connection->query("SELECT * FROM weather_history ORDER BY date_recorded DESC"); // Retrieve all data and sort by latest
            
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>" . $row["city_name"] . "</td>";
                    echo "<td>" . $row["state_name"] . "</td>";
                    echo "<td>" . round($row["temperature"]) . "°F</td>";
                    echo "<td>" . $row["description"] . "</td>";
                    echo "<td>" . $row["wind_speed"] . " mph</td>";
                    echo "<td>" . $row["date_recorded"] . "</td>";
                echo "</tr>";
            }
            }
            catch(PDOException $exception){
                echo "Error connecting and pulling from DB: " . $exception->getMessage();
            }
        ?>
        </table>
    </body>
































</html>