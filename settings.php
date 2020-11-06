<?php
// страница настройки вместимости склада
// под вместительность склада размечается таблица в БД stock
// вводим количество стеллажей, полок, лотков в соответствии с параметрами склада
// старая таблица полностью очищается
// созданная таблица содержит сквозную нумерацию через поле newid, статус всех ячеек - free
// для всех ячеек сгенерированы адреса
// остальные поля пустые

// подключаем базу данных
	include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';
?>

<div class="card mx-auto mt-2" style="width: 70%;">
  <div class="card-body">
	
	<h5 class='card-title font-weight-bold text-danger'>Внимание!<br>Функционал данной страницы уничтожит ВСЕ данные о товарах на складе!</h5>
    <h5 class="card-title">Настройка вместительности склада по категориям габаритности</h5>

	<!-- формы для ввода параметров склада -->
    	<form action="/modules/stockMarkUp.php" method="POST">
			<div class="row">
				<div class="form-group col-md-12">
					<label for="stockSettingsSize">Класс габаритности: A</label>
					<div class="col-md-6 mt-1">
				    	<input type="number" class="form-control" name="stockInit_A1" id='stockSettingsSize' placeholder="Количество стеллажей">
				  	</div>
				  	<div class="col-md-6 mt-1">
				    	<input type="number" class="form-control" name="stockInit_A2" id='stockSettingsSize' placeholder="Количество полок на стеллаже">
				  	</div>
				  	<div class="col-md-6 mt-1">
				    	<input type="number" class="form-control" name="stockInit_A3" id='stockSettingsSize' placeholder="Количество лотков на полке">
				  	</div>
		    	</div>

				<div class="form-group col-md-12">
					<label for="stockSettingsSize">Класс габаритности: B</label>
					<div class="col-md-6 mt-1">
				    	<input type="number" class="form-control" name="stockInit_B1" id='stockSettingsSize' placeholder="Количество стеллажей">
				  	</div>
				  	<div class="col-md-6 mt-1">
				    	<input type="number" class="form-control" name="stockInit_B2" id='stockSettingsSize' placeholder="Количество полок на стеллаже">
				  	</div>
				  	<div class="col-md-6 mt-1">
				    	<input type="number" class="form-control" name="stockInit_B3" id='stockSettingsSize' placeholder="Количество лотков на полке">
				  	</div>
		    	</div>

		    	<div class="form-group col-md-12">
					<label for="stockSettingsSize">Класс габаритности: C</label>
					<div class="col-md-6 mt-1">
				    	<input type="number" class="form-control" name="stockInit_C1" id='stockSettingsSize' placeholder="Количество зон наземного размещения">
				  	</div>
		    	</div>
			</div>

			<button class="btn btn-primary mt-3" type="submit">Принять разметку склада</button>
		</form>

  </div>
</div>

<?php
// подключаем футер
include 'blockSite/footer.php';
?>