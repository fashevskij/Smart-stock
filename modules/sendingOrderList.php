<?php
// Подготовка списка товаров для отправки
// 1) поиск адреса
// 2) наполнение таблицы позициями товара с адресом размещения на складе

// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

	// подготовим запрос в БД, выбрать все ожидающие
	$sql = "SELECT * FROM send_nom WHERE id_send_doc=" . $_GET['send_id'];

	// реализуем запрос
	$result = $connect->query($sql);





	// внутренняя нумерация по списку от 1 до количества товаров
	$i = 1;
	// выводим список товара из запроса (принимаемый товар)                       
		while ($products = mysqli_fetch_assoc($result)) {
			while($products['count']){

				// находим данную позицию на складе, берем адрес размещения и указываем его при наполнении таблицы
				// подготовим запрос в БД, выбрать строку из товаров на складе , где статус done
				$sql_1 = "SELECT * FROM stock WHERE size='" . $products['size'] . "'  AND prod_id = '" . $products['product_id'] . "' AND state='done' LIMIT 1";
				


				// реализуем запрос
				//$findResult = $connect->query($sql_1);


				$findResult = $connect->query($sql_1);
				$colFindResult = mysqli_num_rows($findResult);
				
				if($colFindResult!=0){
				// переведем результат запроса в массив	
				$rowOnStock = mysqli_fetch_assoc($findResult);
				
				
				// переменная, содержащая индекс строки для изменения 
				$rowToChange = $rowOnStock['newid'];
				
				// стеллаж 
				$rack = $rowOnStock['rack'];

				// полка
				$shelf = $rowOnStock['shelf'];

				// лоток
				$tray = $rowOnStock['tray'];

				// адрес размещения товара на складе
				$productAddress = $products['size'] . "-" . $rack . "-" . $shelf . "-" . $tray;

				$sqlUpdateRow = "UPDATE `stock` SET `state`='sending' WHERE `newid`=" . $rowToChange;
				
				// реализуем запрос
				$resultUpdateRow = $connect->query($sqlUpdateRow);

				// выводим строки таблицы
				echo "<tbody>";
				    echo "<tr id='row' data-row-number=" . $i . ">";
				    	echo "<td data-row-number='" . $i . "'>" . $i . "</td>";
						echo "<td data-orderId='" . $_GET['send_id'] . "'>" . $_GET['send_id'] . "</td>";
						echo "<td data-productId>" . $products['product_id'] . "</td>";
					    echo "<td>" . $products['products'] . "</td>";
					    echo "<td>" . $productAddress . "</td>";	
					    echo "<td data-stock-position'" . $i . "'><input type='checkbox' onclick='delProductFromStock(this)'></td>";
					echo "</tr>";	
				    echo "</tr>";
				echo "</tbody>";
				$i++;
				$products['count']--;
				}else{
					echo "<h2>Товара на полках не найдено</h2>";
					die();
				}
			}
		}
?>