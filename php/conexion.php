<?php

$host = "localhost";
$user = "root";
$password = "";
$dbname = "db_dontono";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexion". $conn->connect_error);
}

$conn->set_charset("utf8mb4");

?>