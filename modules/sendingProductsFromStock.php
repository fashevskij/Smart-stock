<?php
	// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

if(isset($_POST['sendProduct'])){

	// изменить строку в таблице stock
	$sql = "UPDATE `stock` SET `state`='free',`order_id`='',`prod_id`='',`name`='',`date`='' WHERE `size`='" . $_POST['size'] . "' AND `rack`='" . $_POST['rack'] . "' AND `shelf`='" . $_POST['shelf'] . "' AND `tray`='" . $_POST['tray'] . "'";

	// реализуем запрос
	$result = $connect->query($sql);
}

?>