<?php
// 1) как только мы приступаем к приемке товара, необходимо зарезервировать 
// свободные места на складе, в таблице stock, в поле state значение wait для
// каждой позиции, которую мы хотим разместить во время приемки
// 2) Далее следует обработка приема товара с транспотного средства на склад:
// выводим перечень поставки и отмечаем каждую, заходящую на склад, позицию
// ------------------------------------------------------------------------------------------

// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';

// 1) =======================================================================================
// отметим в get_products (наша заявка на получение товара) статус processed (обрабатывается)
// для всех позиций товара, отметим на складе пустые ячейки как wait. Потом, когда будем
// размещать товар, будем искать среди ячеек со статусом wait.
// Это надо делать 1 раз, в самом начале и больше не повторять, поэтому будем смотреть
// на статус заказа (если он уже не wait, то пропускаем этот шаг).

if (isset($_GET['orderId'])) {

	// выбираем первый попавшийся товар из нашего заказa
	$sql = "SELECT * FROM get_products WHERE order_id='" . $_GET['orderId'] . "' LIMIT 1";

	// реализуем запрос
	if (!($result = $connect->query($sql))) {
		var_dump("Ошибка исполнения запроса в БД (gettingProductsProcedure 1)");
		die();
	}

	// результаты запроса в массив
	$products = mysqli_fetch_assoc($result);


	// если status выбранного товара - wait, то отметим в заказе, что мы его обрабатываем 
	if ($products['status'] == 'wait') {

		// изменить строку в таблице get_products
		$sql = "UPDATE `get_products` SET `status`='processed' WHERE `order_id`=" . $_GET['orderId'];

		// реализуем запрос
		if (!($result = $connect->query($sql))) {
			var_dump("Ошибка исполнения запроса в БД (gettingProductsProcedure 2)");
			die();
		}


		// ========= Заполняем склад ячейками со статусом ожидания =======================

		$orderId = $_GET['orderId'];

		// подключаем обработчик размещения товара на складе
		include "modules/stockTreatment.php";
	}
}
?>

<!-- 2) обрабатываем поставку =============================================================== -->
<div class="card mx-auto mt-2" style="width: 90%;">
	<div class="card-body">
		<h5 class="card-title">Products in delivery</h5>
		<p class="card-text">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Order</th>
						<th scope="col">Id</th>
						<th scope="col">Name</th>
						<th scope="col">
							<RP></RP>Stock position
						</th>
						<th scope="col">
							<RP></RP>Received
						</th>
					</tr>
				</thead>

				<!-- наполняем таблицу значениями -->
				<?php
				include "modules/gettingOrderList.php";
				?>

			</table>
			<a href='/modules/gettingProductsOnStock.php?orderId=<?php echo $_GET['orderId']; ?>' type="button" class="btn btn-primary float-left mr-1 mb-2">Оприходовать товар</a>
		</p>
	</div>
</div>
<?php

// подключаем футер
include 'blockSite/footer.php';

?>