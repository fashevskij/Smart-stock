<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';


if (isset($_POST["button-send"])) {
  //формируем запрос где в таблицу с заказами вставляем новый заказ введенный нами
  $sql = "INSERT INTO `send_products`(`datatime`, `send_id`, `customer`, `shipping_date`, `status_send`, `info`) 
  VALUES ('" . $_POST['datatime'] . "' , '" . $_POST['send_id'] . "' , '" . $_POST['customer'] . "',
  '" . $_POST['shipping_date'] . "' , 'Ожидают сборки' , '" . $_POST['info'] . "')";
  // реализуем запрос
  $result = mysqli_query($connect, $sql);
  //запишим в переменную id заказа который мы ввели выше
  $send = $_POST['send_id'];
  //поместим ее в куки
  setcookie("send_id", $send, time() + 3600);
}

?>

<!--Создаем блок шапка инфо о товаре-->
<form method="POST">
  <div id="stock" class="card mx-auto mt-2" style="width: 90%;">
    <div class="card-body">
      <h5 class="card-title">Наличие продукции на складе</h5>
      <p class="card-text">
        <table class="table table-responsive">
          <thead class="thead-light">
            <tr>
              <th>№ документа поставки</th>
              <th>Уникальный номер продукта</th>
              <th>Название продукта</th>
              <th>Размер</th>
              <th>Стелаж</th>
              <th>Полка</th>
              <th>Место</th>
              <th>Дата постаки</th>
              <?php
              //если существует кнопка отправмить
              if (isset($_GET['send'])) {
                //формируем запрос где сравниваем id заказа с введенным нами выше который поместили в куки
                $sql = "SELECT * FROM `send_products` WHERE `send_id`=" . $_COOKIE["send_id"];
                $result = mysqli_query($connect, $sql);
                $send_id = mysqli_fetch_assoc($result);
                
                //если были выбраны товары
                if (isset($_POST['select'])) {
                  for ($i = 0; $i < count($_POST['select']); $i++) {
                    //формируем запрос где проверяем выбраные прордукты через массив
                    $sql2 = "SELECT * FROM `stock` WHERE `newid`=" . $_POST['select'][$i];
                    $result2 = mysqli_query($connect, $sql2);
                    $products = mysqli_fetch_assoc($result2);
                    //формируем запрос на вставку выбраных продуктов из стока в другую таблицу
                    $sql3 = "INSERT INTO `send_nom`(`id_send_doc`, `product_id`, `products`, `size`, `count`) VALUES
                  ('" . $send_id["send_id"] . "' , '" . $products["prod_id"] . "' ,
                  '" . $products["name"] . "' , '" . $products["size"] . "', '1')";
                    $result3 = mysqli_query($connect, $sql3);
                    //формируем запрос в таблицу для смены статуса полки на свободный
                    $sql4 = "UPDATE `stock` SET `state`='free',`order_id`=''
                    ,`prod_id`='',`name`='',`size`='" . $products['size'] . "'
                    ,`rack`='" . $products['rack'] . "',`shelf`='" . $products['shelf'] . "',`tray`='" . $products['tray'] . "',`date`='' 
                    WHERE `newid`=" . $_POST['select'][$i];
                    //выполняем запрос
                    $result4 = mysqli_query($connect, $sql4);
                  }
                }



              ?>
                <th><button id="send-products" name="send-products" type="submit">Отправить</button></th>
              <?php
              }
              if (isset($_POST['send-products'])) {
                //формируем запрос для того чтобы поменять статус заказа на отгружено
                $sql5 = "UPDATE `send_products` SET `status_send` = 'Отгружено' WHERE `send_products`.`send_id` =" . $_COOKIE["send_id"];
                //выполняем запрос
                $result5 = mysqli_query($connect, $sql5);
                header("Location: /shippedDoc.php");
              }

              ?>

            </tr>
          </thead>
          <!--Создаем блок поиска товаров по выбраным категориям-->
          <tbody>
            <tr>
              <td>
                <form class="form-inline my-2 my-lg-0 " method="POST">
                  <input class="form-control form-control-sm mr-sm-2 mb-2" style="width: 70px" type="number" name="searchIdOrder" placeholder="Id order">
                  <button class="btn btn-outline-success mr-sm-2 my-2 my-sm-0 btn-sm" type="submit">Поиск</button>
                </form>
              </td>
              <td>
                <form class="form-inline my-2 my-lg-0" method="POST">
                  <input class="form-control form-control-sm mr-sm-2 mb-2" style="width: 80px" type="number" aria-label="Search" name="searchIdProducts" placeholder="Id products">
                  <button class="btn btn-outline-success mr-sm-5 my-2 my-sm-0 btn-sm" type="submit">Поиск</button>
                </form>
              </td>
              <td>
                <form class="form-inline my-2 my-lg-0" method="POST">
                  <input class="form-control form-control-sm mr-sm-2 mb-2" type="search" placeholder="Name products" aria-label="Search" name="searchName">
                  <button class="btn btn-outline-success mr-sm-5 my-2 my-sm-0 btn-sm" type="submit">Поиск</button>
                </form>
              </td>
              <td>
                <form class="form-inline my-2 my-lg-0" method="POST">
                  <input class="form-control form-control-sm mr-sm-2 mb-2" style="width: 60px" type="search" aria-label="Search" name="searchSize" placeholder="Size">
                  <button class="btn btn-outline-success mr-sm-5 my-2 my-sm-0 btn-sm" type="submit">Поиск</button>
                </form>
              </td>
              <form method="POST">
                <td>

                  <input class="form-control form-control-sm mr-sm-2 mb-2" style="width: 60px" type="search" aria-label="Search" name="searchRack" placeholder="Rack">

                </td>
                <td>
                  <input class="form-control form-control-sm mr-sm-2 mb-2" style="width: 60px" type="search" aria-label="Search" name="searchShelf" placeholder="Shelf">
                </td>
                <td>
                  <input class="form-control form-control-sm mr-sm-2 mb-2" style="width: 60px" type="search" aria-label="Search" name="searchTray" placeholder="Tray">


                  <button class="btn btn-outline-success mr-sm-5 my-2 my-sm-0 btn-sm" type="submit" name="searchPlace">Поиск</button>

                </td>

              </form>
              <td>
                <form class="form-inline my-2 my-lg-0" method="POST">
                  <input class="form-control form-control-sm mr-sm-2 mb-2" type="search" placeholder="Date" aria-label="Search" name="searchDate">
                  <button class="btn btn-outline-success mr-2 ml-2 btn-sm" type="submit">Поиск</button>
                </form>
              </td>
            </tr>
          </tbody>
          <?php include "modules/stock_list.php"; ?>

        </table>
      </p>
    </div>
  </div>
</form>
<?php
// подключаем футер
include 'blockSite/footer.php';
?>