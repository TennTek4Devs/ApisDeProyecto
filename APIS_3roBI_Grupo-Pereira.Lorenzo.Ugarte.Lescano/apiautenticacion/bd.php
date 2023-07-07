<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'apiautenticacion_bd';

$conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>