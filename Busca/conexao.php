<?php

$host = "localhost";
$db = "rest";
$user = "root";
$pass = "root";

$mysqli = new mysqli($host, $user, $pass, $db);
if($mysqli->connect_errno) {
    die("Falha na conexão com o banco de dados");
}