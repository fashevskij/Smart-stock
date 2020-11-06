
<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// Получаем данные из БД        
$sql1 = " SELECT * FROM send_products ";

$result1 = mysqli_query($connect, $sql1);

$col_doc_all = mysqli_num_rows($result1);

// Получаем данные из БД  
$sql3 = " SELECT * FROM send_products WHERE status_send='Ожидают сборки' ";

$result3 = mysqli_query($connect, $sql3);
$col_doc_wait = mysqli_num_rows($result3);


// Получаем данные из БД        
$sql4 = " SELECT * FROM send_products WHERE status_send='Отгружено' ";

$result4 = mysqli_query($connect, $sql4);
$col_doc_ship = mysqli_num_rows($result4);





?>