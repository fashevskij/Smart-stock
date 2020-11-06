<?php
//заголовок сайта
$nameSite = "Name";

//заголовок страницы регистрации

$nameBlockRegistration = "Регистрация";

//авторизованный пользователь
$user_id = null;

// если существует cookie 
if(isset($_COOKIE["user_id"])) {
	
	// присвоим текущему id пользователя значение в cookie
	$user_id = $_COOKIE["user_id"];
}

?>