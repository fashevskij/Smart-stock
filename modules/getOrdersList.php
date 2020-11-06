<?php
// отрабатываем список заказов
// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подготовим запрос в БД, выбрать все ожидающие
// $sql = "SELECT * FROM get_products WHERE status='wait' OR status='processed'";
$sql = "SELECT * FROM get_products WHERE status='wait'";

// реализуем запрос
if( !($result = $connect->query($sql) ) ){
	var_dump("Ошибка исполнения запроса в БД (getOrderList 1)");
	die();
}

// переменная для предотвращения повторов вывода id заказа
$dontRepeat = 0;

// выводим список товара из запроса                       
	while ($products = mysqli_fetch_assoc($result)) {
		if($dontRepeat != $products['order_id']){
			echo "<tbody>";
			    echo "<tr>";
					echo "<td><a class='btn btn-light' href='http://smart-stock.local/getProducts.php?orderId=" . $products['order_id']	 . "'>" . $products['order_id'] . "</a></td>";
					echo "<td>" . $products['status'] . "</td>";
				    echo "<td>" . $products['date'] . "</td>";
				    echo "<td>" . $products['manag_name'] . "</td>";
				echo "</tr>";
			    echo "</tr>";
			echo "</tbody>";
		}

		$dontRepeat = $products['order_id'];
	}
?>
