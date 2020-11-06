<?php
// генератор позиций размещения товаров во время приемки с транспорта
// получаем в переменной $orderId id заказа, который необходимо разместить на складе
// выбираем из БД (get_products) все товары с заданным order_id
// размещаем товары в таблице stock с пометкой wait (ожидание офинального оприходования)

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


// выполняем генерирование адреса размещения

// подготовим запрос в БД, выбрать товар с заданным id
// для определения габаритности, таблица поставок (get_products)
$sql = "SELECT * FROM get_products WHERE order_id=" . $orderId;

	// реализуем запрос
	if( !( $result = $connect->query($sql) ) ){
	   	var_dump("Ошибка исполнения запроса в БД (stockTreatment 1)");
		die();
	}

// результаты запроса в массив и перебрать циклом
while ($products = mysqli_fetch_assoc($result)) {				

	// если товара в позиции больше 1, обрабатываем циклично
	while($products['prod_count']){
	
	// запрос в БД, найти в стоку свободное место
	$new_sql = "SELECT * FROM stock WHERE size='" . $products['size'] . "' AND state='free' LIMIT 1";

	// реализуем запрос
	$new_result = $connect->query($new_sql);

	// переведем результат запроса в массив
	if( !( $freeRowOnStock = mysqli_fetch_assoc($new_result) ) ){
		var_dump("Невозможно разместить весь требуемый товар, на складе недостаточно места! (stockTreatment 2)");
		header('Location: http://smart-stock.local/errorMessage2.php');
		die();
	}

	// переменная, содержащая индекс строки для изменения 
	$freeRowToChange = $freeRowOnStock['newid'];

	// стеллаж 
	$rack = $freeRowOnStock['rack'];

	// полка
	$shelf = $freeRowOnStock['shelf'];

 	// лоток
	$tray = $freeRowOnStock['tray'];

	// изменить строку в таблице stock
	$sql_update = "UPDATE `stock` SET `state`='wait',`order_id`='" . $orderId . "',`prod_id`='" . $products['product_id'] . "',`name`='" . $products['name'] . "',`size`='" . $products['size'] . "',`date`='" . date("Y-m-d H:i:s") . "' WHERE `newid`=" . $freeRowToChange;

		// реализуем запрос
		if( !( $resultUpdate = $connect->query($sql_update) ) ){
			var_dump("Ошибка исполнения запроса в БД (stockTreatment 3)");
			die();
		}

	// дектемент количества обработанного товара
	$products['prod_count']--;
	}

}
