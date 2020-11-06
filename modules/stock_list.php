<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подготовим запрос в БД, выбрать все ожидающие
$sql = "SELECT * FROM stock";
// реализуем запрос
$result = $connect->query($sql);

// выводим список товара из запроса  

if (isset($_POST["searchName"])) {
  include $_SERVER['DOCUMENT_ROOT'] . '/modules/searchName.php';
} else if (isset($_POST["searchIdOrder"])) {
  include $_SERVER['DOCUMENT_ROOT'] . '/modules/searchIdOrder.php';
} else if (isset($_POST["searchIdProducts"])) {
  include $_SERVER['DOCUMENT_ROOT'] . '/modules/searchIdProducts.php';
} else if (isset($_POST["searchSize"])) {
  include $_SERVER['DOCUMENT_ROOT'] . '/modules/searchSize.php';
} else if (isset($_POST["searchPlace"])) {
  include $_SERVER['DOCUMENT_ROOT'] . '/modules/searchPlace.php';
} else if (isset($_POST["searchDate"])) {
  include $_SERVER['DOCUMENT_ROOT'] . '/modules/searchDate.php';
} else {
  while ($products = mysqli_fetch_assoc($result)) {

?>
    <tbody>
      <?php
      if ($products['name'] != '') {
      ?>
        <tr>
          <td> <?php echo $products['order_id'] ?></td>
          <td><?php echo $products['prod_id'] ?></td>
          <td><?php echo $products['name'] ?></td>
          <td> <?php echo $products['size'] ?></td>
          <td><?php echo $products['rack'] ?></td>
          <td><?php echo $products['shelf'] ?></td>
          <td><?php echo $products['tray'] ?></td>
          <td><?php echo $products['date'] ?></td>
          <?php
          if (isset($_GET['send'])) {
          ?>
            <td>
              <div id="send" class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="select[]" value="<?php echo $products["newid"];?>">
                <label class="form-check-label" for="inlineCheckbox1"></label>
              </div>
            </td>
          <?php
          }
          ?>
        </tr>

      <?php
      }
      ?>

    </tbody>
<?php

  }
}
?>