<?php
// отчет по окончании приемки товара
// разделить фактически поступивший и
// не поступивший товар из состава заявки

// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include $_SERVER['DOCUMENT_ROOT'] . '/blockSite/header.php';

// =========== Принятый товар =============================================
// подготовим запрос в БД, выбрать все ожидающие
$sql = "SELECT * FROM stock WHERE order_id='" . $_GET['orderId'] . "' AND state='done'";

// реализуем запрос
if (!($result = $connect->query($sql))) {
	var_dump("Ошибка исполнения запроса в БД (gettingProductsOnStock 1)");
	die();
}
?>

<!-- шапка таблицы -->
<div class="card mx-auto mt-2" style="width: 90%	;">
	<div class="card-body">
		<h5 class="card-title">Перечень оприходованного товара</h5>
		<p class="card-text">
			<table class="table table-responsive">
				<thead class="thead-light">
					<tr>
						<th scope="col">№пп</th>
						<th scope="col">№заказа</th>
						<th scope="col">Уникальный номер продукта</th>
						<th scope="col">Название продукта</th>
					</tr>
				</thead>

				<?php
				// внутренняя нумерация по списку от 1 до количества товаров
				$i = 1;
				// выводим список товара из запроса (принимаемый товар)                       
				while ($products = mysqli_fetch_assoc($result)) {

					echo "<tbody>";
					echo "<tr id='row'>";
					echo "<td>" . $i . "</td>";
					echo "<td>" . $_GET['orderId'] . "</td>";
					echo "<td>" . $products['prod_id'] . "</td>";
					echo "<td>" . $products['name'] . "</td>";
					echo "</tr>";
					echo "</tr>";
					echo "</tbody>";
					$i++;
				}
				?>

			</table>
		</p>
	</div>
</div>
<!-- =========== Недостающий товар ============================================= -->
<?php
// подготовим запрос в БД, выбрать все ожидающие
$sql = "SELECT * FROM stock WHERE order_id='" . $_GET['orderId'] . "' AND state='wait'";

// реализуем запрос
if (!($result = $connect->query($sql))) {
	var_dump("Ошибка исполнения запроса в БД (gettingProductsOnStock 2)");
	die();
}
?>

<div class="card mx-auto mt-2" style="width: 90%	;">
	<div class="card-body">
		<h5 class="card-title">Перечень товара, не поступившего на склад</h5>
		<p class="card-text">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">#</th>
						<th scope="col">Order</th>
						<th scope="col">Id</th>
						<th scope="col">Name</th>
					</tr>
				</thead>

				<?php
				// внутренняя нумерация по списку от 1 до количества товаров
				$i = 1;
				// выводим список товара из запроса (принимаемый товар)                       
				while ($products = mysqli_fetch_assoc($result)) {

					echo "<tbody>";
					echo "<tr id='row'>";
					echo "<td>" . $i . "</td>";
					echo "<td>" . $_GET['orderId'] . "</td>";
					echo "<td>" . $products['prod_id'] . "</td>";
					echo "<td>" . $products['name'] . "</td>";
					echo "</tr>";
					echo "</tr>";
					echo "</tbody>";
					$i++;
				}

				// удаляем непринятый товар из таблицы stock после приемки

				// подготовим запрос в БД, очистить все ожидающие
				$sql = "UPDATE `stock` SET `state`='free',`order_id`='',`prod_id`='',`name`='',`date`='' WHERE `state`='wait' AND `order_id`='" . $_GET['orderId'] . "'";

				// реализуем запрос
				if (!($result = $connect->query($sql))) {
					var_dump("Ошибка исполнения запроса в БД (gettingProductsOnStock 3)");
					die();
				}

				?>

			</table>
		</p>
	</div>
</div>

<?php

// подключаем футер
include $_SERVER['DOCUMENT_ROOT'] . '/blockSite/footer.php';

?>