<?php
$host = 'localhost';
$dbname = 'weatherdb';
$username = 'root';
$password = 'root';

$data = json_decode(file_get_contents('php://input'), true);

    $connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);


?>