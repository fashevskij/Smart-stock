<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';
include "blockSite/sendOrderCap.php";


?>
<form method="POST" action="/stock.php?send=1">
  <table class="table">
    <tbody>
    <tr>
      <!--Выводим дату и время из масива -->
      <th scope="col">Дата</th>
      <td>
        <input name="datatime" type="datetime-local">
      </td>
    </tr>
    <tr>
      <th scope="col">Номер документа</th>
      <!--Выводим ид отправки  из масива -->
      <td>
        <input name="send_id">
      </td>
    </tr>
    <tr>
      <th scope="col">Контрагент</th>
      <!--Выводим контрагента из масива -->
      <td>
        <input name="customer">
      </td>
    </tr>
    <tr>
      <th scope="col">Дата отгрузки</th>
      <!--Выводим дату отгрузки из масива -->
      <td>
        <input name="shipping_date" type="datetime-local">
      </td>
    </tr>
    <tr>
      <th scope="col">Коментарий</th>
      <!--Выводим сопроводительную информацию из масива -->
      <td>
        <input name="info">
      </td>
    </tr>

    <td>
      <!--Добавляем блок кнпок-->
      <div class="btn-group" role="group">
        <!--Добавляем кнопку  просмотр-->
        <button class="btn btn-dark" type="submit" name="button-send">
          сборка
          </a></button>
        <!--Добавляем кнопку  сборка-->
      </div>
    </td>
    </tr>
    </tbody>
</form>
<?php


?>

</table>
</p>
</div>
</div>
<?php

// подключаем футер
include 'blockSite/footer.php';

?>
