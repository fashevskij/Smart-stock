<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';
$ssend_id = $_GET['send_id'];
$page = $_GET["page"];

// как только нажата кнопка отправить товар, формируется таблица 
// (шапка таблицы из этого файла) и в заявке на отправку все товары получают статус processed
if (isset($_GET['send_id'])) {

	// выбираем первый попавшийся товар из нашего заказa
	$sql = "SELECT * FROM send_products WHERE send_id='" . $_GET['send_id'] . "' LIMIT 1";

	// реализуем запрос
	$result = $connect->query($sql);

	// результаты запроса в массив
	$products = mysqli_fetch_assoc($result);
}
?>

<!-- 2) обрабатываем отправку (шапка таблицы) =========================================== -->
<div class="card mx-auto mt-2" style="width: 90%;">
	<div class="card-body">
		<h5 class="card-title">Список товара для списания со склада </h5>
		<p class="card-text">
			<table class="table table-responsive">
				<thead class="thead-light">
					<tr>
						<th scope="col">№пп</th>
						<th scope="col">№заказа</th>
						<th scope="col">Уникальный номер продукта</th>
						<th scope="col">Название продукта</th>
						<th scope="col">
							<RP></RP>Складская позиция
						</th>
						<th scope="col">
							<RP></RP>Отметки
						</th>
					</tr>
				</thead>
				<?php
				include "modules/sendingOrderList.php";
				?>
			</table>
			<a href="statusChange.php?send_id=<?php echo $ssend_id ?>&page=<?php echo $page ?>" type="button" class="btn btn-primary float-right mr-1 mb-2">Перейти в меню отгрузки</a>
		</p>
	</div>
</div>
<?php

// подключаем футер
include 'blockSite/footer.php';

?>