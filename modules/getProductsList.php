<?php
// подготовка к приемке товара поштучно (разгрузка транспорта)
// требуется вывести каждую единицу товара в списке
// по запросу в БД получить список товара в заказе
// вывести заполненные поля таблицы

// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

if (isset($_GET['orderId'])){
	// подготовим запрос в БД, выбрать все ожидающие
	$sql = "SELECT * FROM get_products WHERE order_id=" . $_GET['orderId'];

	// реализуем запрос
	if( !($result = $connect->query($sql) ) ){
		var_dump("Ошибка исполнения запроса в БД (getProductsList 1)");
		die();
	}

	// выводим список товара из запроса                       
		while ($products = mysqli_fetch_assoc($result)) {
				echo "<tbody>";
				    echo "<tr>";
						echo "<td>" . $_GET['orderId'] . "</td>";
						echo "<td>" . $products['product_id'] . "</td>";
					    echo "<td>" . $products['name'] . "</td>";
					    echo "<td>" . $products['prod_count'] . "</td>";
					    echo "<td>" . $products['info'] . "</td>";
					echo "</tr>";
				    echo "</tr>";
				echo "</tbody>";
		}
}

?>