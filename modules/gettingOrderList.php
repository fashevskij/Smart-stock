<?php
// наполнение таблицы с товарами заказа
// по запросу в БД получить список товара в заказе
// вывести заполненные поля таблицы
// (товары в количестве не раскрываются)

// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	// подготовим запрос в БД, выбрать все ожидающие
	$sql = "SELECT * FROM get_products WHERE order_id=" . $_GET['orderId'];

	// реализуем запрос
	if( !($result = $connect->query($sql) ) ){
		var_dump("Ошибка исполнения запроса в БД (gettingOrderList 1)");
		die();
	}

	// внутренняя нумерация по списку от 1 до количества товаров
	$i = 1;
	// выводим список товара из запроса (принимаемый товар)                       
		while ($products = mysqli_fetch_assoc($result)) {
			while($products['prod_count']){
				if($products['status'] == 'marked'){
					$checkedBox = 'checked';
				}else{
					$checkedBox = '';
				}

				// выводим поля таблицы
				echo "<tbody>";
				    echo "<tr id='row' data-row-number=" . $i . ">";
				    	echo "<td data-row-number='" . $i . "'>" . $i . "</td>";
						echo "<td data-orderId='" . $_GET['orderId'] . "'>" . $_GET['orderId'] . "</td>";
						echo "<td data-productId>" . $products['product_id'] . "</td>";
					    echo "<td>" . $products['name'] . "</td>";
					    echo "<td></td>";	
					    echo "<td data-stock-position'" . $i . "'><input type='checkbox' onclick='addProductToStock(this)'"  . $checkedBox .  "'></td>";
					echo "</tr>";	
				    echo "</tr>";
				echo "</tbody>";
				$i++;
				$products['prod_count']--;
			}
		}
?>