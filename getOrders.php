<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';
?>

<!-- шапка таблицы -->
<div class="card mx-auto mt-2" style="width: 70%;">
	<div class="card-body">
		<h5 class="card-title">Список предстоящих поставок</h5>
		<p class="card-text">
			<table class="table table-responsive">
				<thead class="thead-light">
					<tr>
						<th scope="col">Номер документа</th>
						<th scope="col">Статус приемки</th>
						<th scope="col">Дата</th>
						<th scope="col">Контрагент</th>
					</tr>
				</thead>

				<!-- генерируем наполнение таблицы -->
				<?php
				include "modules/getOrdersList.php";
				?>

			</table>
		</p>
	</div>
</div>
<?php

// подключаем футер
include 'blockSite/footer.php';

?>