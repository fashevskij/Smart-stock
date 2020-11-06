<?php
// Данные для подключения к БД
$server = "localhost";
$username = "root";
$password = "";
$dbname = "smartstock";

// подключение к базе данных smartstock
$connect = mysqli_connect($server, $username, $password, $dbname);

//кодировка БД
mysqli_set_charset($connect, "utf8");
//var_dump("test");
?>