<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sislogin"; // nome do seu banco

$mysqli = new mysqli($host, $user, $pass, $db);

if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}

?>