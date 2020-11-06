<?php
// работа с БД во время первичной разметки склада
// принимаем в POST-запросе параметры склада
// вычисляем суммарную вместимость каждого отсека
// склада соответствующей габаритности
// создаем в таблице необходимое количество строк
// со статусом free (складская ячейка свободна)
// если успешно разметили БД, переходим на главную

// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

if (isset($_POST['stockInit_A1'])) {

	$sql = "TRUNCATE TABLE stock";

	if (!($result = $connect->query($sql))) {
		var_dump("Ошибка при удалении Вашего склада");
		var_dump($result);
		die();
	}

	// наполняем переменные значениями, проводим проверки
	// === Зона А ======================
	// проверим все ли заполнены поля
	if ($_POST['stockInit_A1'] && $_POST['stockInit_A2'] && $_POST['stockInit_A3']) {
		$totalQuantity_a = $_POST['stockInit_A1'] * $_POST['stockInit_A2'] * $_POST['stockInit_A3'];
	}

	// === Зона B ======================
	// проверим все ли заполнены поля
	if ($_POST['stockInit_B1'] && $_POST['stockInit_B2'] && $_POST['stockInit_B3']) {
		$totalQuantity_b = $_POST['stockInit_B1'] * $_POST['stockInit_B2'] * $_POST['stockInit_B3'];
	}

	// === Зона C ======================
	if ($_POST['stockInit_C1']) {
		$totalQuantity_c = $_POST['stockInit_C1'];
	}

	//========= Заполняем зону А ============================================= 
	// создаем запрос в БД на внесение новых строк в таблицу stock
	// (свободные ячейки хранения на складе)

	// в цикле добавляем строки в таблицу
	for ($x = 1; $x <= $_POST['stockInit_A1']; $x++) {

		for ($y = 1; $y <= $_POST['stockInit_A2']; $y++) {

			for ($z = 1; $z <= $_POST['stockInit_A3']; $z++) {

				$sql = "INSERT INTO `stock` (`newid`, `state`, `order_id`, `prod_id`, `name`, `size`, `rack`, `shelf`, `tray`, `date`) VALUES (NULL, 'free', '', '', '', 'A', '" . $x . "', '" . $y . "', '" . $z . "', '')";
				if (!($result = $connect->query($sql))) {
					var_dump("Ошибка при добавлении ячеек хранения класса А");
					var_dump($result);
					die();
				}
			}
		}
	}

	//========= Заполняем зону B ============================================= 
	// создаем запрос в БД на внесение новых строк в таблицу stock
	// (свободные ячейки хранения на складе)

	// в цикле добавляем строки в таблицу
	for ($x = 1; $x <= $_POST['stockInit_B1']; $x++) {

		for ($y = 1; $y <= $_POST['stockInit_B2']; $y++) {

			for ($z = 1; $z <= $_POST['stockInit_B3']; $z++) {

				$sql = "INSERT INTO `stock` (`newid`, `state`, `order_id`, `prod_id`, `name`, `size`, `rack`, `shelf`, `tray`, `date`) VALUES (NULL, 'free', '', '', '', 'B', '" . $x . "', '" . $y . "', '" . $z . "', '')";
				if (!($result = $connect->query($sql))) {
					var_dump("Ошибка при добавлении ячеек хранения класса B");
					var_dump($result);
					die();
				}
			}
		}
	}

	//========= Заполняем зону C ============================================= 
	// создаем запрос в БД на внесение новых строк в таблицу stock
	// (свободные ячейки хранения на складе)

	// в цикле добавляем строки в таблицу
	for ($x = 1; $x <= $_POST['stockInit_C1']; $x++) {

		$sql = "INSERT INTO `stock` (`newid`, `state`, `order_id`, `prod_id`, `name`, `size`, `rack`, `shelf`, `tray`, `date`) VALUES (NULL, 'free', '', '', '', 'C', '0', '0', '" . $x . "', '')";
		if (!($result = $connect->query($sql))) {
			var_dump("Ошибка при добавлении ячеек хранения класса C");
			var_dump($result);
			die();
		}
	}


	// переход на главную страницу, если все прошло гладко
	header("Location: /");
}
// если не все поля заполнены - выводим сообщение
else {
	var_dump("Не заполнены поля");
}
