<?php
$host = "localhost";
$dbname = "weatherdb";
$username = "root";
$password = "root";

$data = json_decode(file_get_contents("php://input"), true);
    try{
        $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $sql = "INSERT INTO weather_history 
                (city_name, state_name, temperature, description, wind_speed) 
                VALUES (:city, :state, :temperature, :description, :wind_speed)";

        $statement = $connection->prepare($sql);

        $statement->bindParam(":city", $data["city"]);
        $statement->bindParam(":state", $data["state"]);
        $statement->bindParam(":temperature", $data["temperature"]);
        $statement->bindParam(":description", $data["description"]);
        $statement->bindParam(":wind_speed", $data["wind_speed"]);

        $statement->execute();

        echo json_encode(["success" => true, "message" => "Data successfully sent to DB"]);
    }
    catch(PDOException $exception)
    {
        echo json_encode(["success" => false, "message" => "Error sending data to DB: ". $exception->getMessage()]);
    }
    
?>