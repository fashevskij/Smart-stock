<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';
//получаем дату сегодня в формате sql
$today = date("Y-m-d H:i:s");
//если была нажата кнопка отправить
if (isset ($_POST["button"])){
  //формируем запрос к бд на вставку данных 
    $sql ="INSERT INTO `get_products`(`order_id`, `status`, `product_id`, `name`, `size`, `prod_count`, `date`, `manag_name`, `info`) 
    VALUES ('" . $_POST['order_id'] . "', 'wait' ,'" . $_POST['product_id'] . "', '" . $_POST['name'] . "', '" . $_POST['size'] . "', 
    '" . $_POST['prod_count'] . "', '" . $today . "', '" . $_POST['manag_name'] . "', '" . $_POST['info'] . "')";
//отправляем запрос
$result = mysqli_query($connect,$sql);
}


?>

<!-- форма для заполениня данных о отправке товаров-->
<form method="POST" class="card mx-auto mt-3" style="width: 80%;">
<div class="form-row" style="padding: 20px;">
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Номер документа</label>
      <input type="text" class="form-control" id="validationDefault01" name="order_id">
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Номер продукта</label>
      <input type="text" class="form-control" id="validationDefault01" name="product_id">
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Имя продукта</label>
      <input type="text" class="form-control" id="validationDefault01" name="name">
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Габариты продукта</label>
      <input type="text" class="form-control" id="validationDefault01" name="size">
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Количество продукта</label>
      <input type="text" class="form-control" id="validationDefault01" name="prod_count">
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Имя менеджера</label>
      <input type="text" class="form-control" id="validationDefault01" name="manag_name">
    </div>
    <div class="col-md-6 mb-3">
      <label for="validationDefault01">Коментарий к заказу</label>
      <input type="text" class="form-control" id="validationDefault01" name="info">
    </div>

		
    </div>
    <button type="submit" class="btn btn-secondary" name="button">Отправить</button>
</form>

<?php

// подключаем футер
include 'blockSite/footer.php';

?>