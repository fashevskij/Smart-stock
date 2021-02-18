<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';
?>

<!-- перечень товаров в заказе для приема на склад (шапка таблицы) -->
<div class="card mx-auto mt-2" style="width: 90%	;">
	<div class="card-body">
		<h5 class="card-title">Перечень товаров в поставке
			<a href='/gettingProductsProcedure.php?orderId=<?php echo $_GET['orderId']; ?>' type="button" class="btn btn-primary float-right mr-1 mb-2" onclick='placeProductsOnStock(this)'>Принять товар</a>
		</h5>
		<p class="card-text">
			<table class="table">
				<thead class="thead-light">
					<tr>
						<th scope="col">Order</th>
						<th scope="col">Id</th>
						<th scope="col">Name</th>
						<th scope="col">Quantity</th>
						<th scope="col">Info</th>
					</tr>
				</thead>

				<!-- наполнение таблицы товарами для приема -->
				<?php
				include "modules/getProductsList.php";
				?>

			</table>
		</p>
	</div>
</div>
<?php

// подключаем футер
include 'blockSite/footer.php';

?>