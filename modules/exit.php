<?php
// очищаем cookies
setcookie("user_id", "", 0, "/");

// переходим на главную
header("Location: /");
?>