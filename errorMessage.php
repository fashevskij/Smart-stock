<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include $_SERVER['DOCUMENT_ROOT'] . '/blockSite/header.php';
?>

<div class="container">
	<div class="card">
	  <div class="card-header font-weight-bold text-danger">
	    Ошибка
	  </div>
	  <div class="card-body">
	    <h5 class="card-title">Возникла ошибка во время поиска товара на складе</h5>
	    <p class="card-text">Товар не найден в необходимом количестве</p>
	  </div>
	</div>
</div>

<?php
	// подключаем футер
	include $_SERVER['DOCUMENT_ROOT'] . '/blockSite/footer.php';
?>



