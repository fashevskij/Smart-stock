<?php
// генератор позиций размещения товаров во время приемки с транспорта
// получаем в POST-запросе id товара, который необходимо разместить на складе
// выбираем из БД товар с заданным id
// доходим до размерности товара (классы A B C)
// находим на складе свободное место (с пометкой wait) в заданном классе габаритности
// берем одно такое место и с помощью echo произносим адрес
// (ajax услышит и отразит в ajax.response)

	// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// введем переменные:
// класс габаритности
$produсtSize = "";

// стеллаж
$rack = "";

// полка
$shelf = "";

// лоток
$tray = "";

// если появляется POST-запрос с id товара - выполняем генерирование адреса размещения
// подготовим массив с данными о принимаемом продукте
if(isset($_POST['id'])){
	// подготовим запрос в БД, выбрать товар с заданным id
	// для определения габаритности, таблица поставок (get_products)
	$sql = "SELECT * FROM stock WHERE prod_id=" . $_POST['id'];

	// реализуем запрос
	$result = $connect->query($sql);

	// переведем результат запроса в массив
	$product = mysqli_fetch_assoc($result);

	// наполним переменную значением
	$produсtSize = $product['size'];

		// подготовим массив с данными о свободной ячейке склада
		// подготовим запрос в БД, выбрать строку в зоне соответствующего 
		// класса габаритности, где статус wait
		$sql = "SELECT * FROM stock WHERE size='" . $product['size'] . "' AND state='wait' LIMIT 1";

		// реализуем запрос
		$result = $connect->query($sql);

		// переведем результат запроса в массив
		$freeRowOnStock = mysqli_fetch_assoc($result);

		// переменная, содержащая индекс строки для изменения 
		$freeRowToChange = $freeRowOnStock['newid'];

		// стеллаж 
		$rack = $freeRowOnStock['rack'];

		// полка
		$shelf = $freeRowOnStock['shelf'];

		// лоток
		$tray = $freeRowOnStock['tray'];

	// изменить строку в таблице stock
	$sql = "UPDATE `stock` SET `state`='done',`date`='" . date("Y-m-d H:i:s") . "' WHERE `newid`=" . $freeRowToChange;

	// реализуем запрос
	$result = $connect->query($sql);


	// выведем адрес размещения товара на складе
	echo $produсtSize . "-" . $rack . "-" . $shelf . "-" . $tray;
}

?>