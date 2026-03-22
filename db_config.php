<?php

$host = "localhost";
$dbname = "SnowRunner Türkçe Yama Launcher";
$username = "db_user";
$password = "db_pass";

try {

$pdo = new PDO(
"mysql:host=$host;dbname=$dbname;charset=utf8",
$username,
$password
);

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}

catch(PDOException $e){

die("DB bağlantı hatası");

}

?>
