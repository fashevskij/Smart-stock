<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// если страница = "wait_collect_doc" то значению $_GET['send_id'] присваиваем статус На сборке

if($_GET["page"] == "wait_collect_doc"){
 // Получаем данные из БД  

   $sql = "UPDATE `send_products` SET `status_send` = 'На сборке' WHERE `send_products`.`send_id` =" . $_GET['send_id'];
//если есть данные подключаем файл
   if(mysqli_query($connect, $sql)){
        include "collectDoc.php";
    }else{
        echo "<h2>Ошибка</h2>";
    }
}
   
// если страница = "collect_doc" то значению $_GET['send_id'] присваиваем статус "Собрано"
if($_GET["page"] == "collect_doc"){
 // Получаем данные из БД  

   $sql = "UPDATE `send_products` SET `status_send` = 'Собрано' WHERE `send_products`.`send_id` =" . $_GET['send_id'];
   
//если есть данные подключаем файл
   if(mysqli_query($connect, $sql)){

        include "collectedDoc.php";
    }else{
        echo "<h2>Ошибка</h2>";
    }
}

// если страница = "collect_doc" то значению $_GET['send_id'] присваиваем статус "Отгружено"
if($_GET["page"] == "collected_doc"){
 // Получаем данные из БД  

   $sql = "UPDATE `send_products` SET `status_send` = 'Отгружено' WHERE `send_products`.`send_id` =" . $_GET['send_id'];
//если есть данные подключаем файл
   if(mysqli_query($connect, $sql)){
        include "shippedDoc.php";
    }else{
        echo "<h2>Ошибка</h2>";
    }
}    
