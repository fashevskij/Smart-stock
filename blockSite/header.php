<?php
/* СДЕЛАНО
1. На главной странице выводить кнопку авторизации и регистрации пользователя +
2. Если пользователь авторизовался:
  2.1 убираем поле авторизации +
  2.2 выводим поля с ссылками на таблицы +
  2.3 выводим поле с именем пользователя +
  2.4 выводим поле для выхода со страницы пользователя +
  2.5 поле поиска +
*/
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">  
  <link rel="stylesheet" href="/assets/css/my.css">
  
  <title>Smart-stock</title>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">Smart Stock</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <?php 
      //если пользователь авторизовался выводим в navbar ссылки на таблицы
      if(isset($_COOKIE["user_id"])) {
        $sql = "SELECT * FROM users WHERE id=" . $_COOKIE["user_id"];
        $result = mysqli_query($connect, $sql);
        $user = mysqli_fetch_assoc($result);
        ?>
        <li class="nav-item my-lg-0">
          <a class="nav-link" href="/getOrders.php">Приход</a>
        </li>
        <li class="nav-item my-lg-0">
          <a class="nav-link" href="/stock.php">Наличие</a>
        </li>
        <li class="nav-item my-lg-0">
          <a class="nav-link" href="/waitCollectDoc.php">Отправка</a>
        </li>
        <?php
        //если пользователь админ показать настройки
        if ($_COOKIE["user_id"]==1){
        ?>
        <li class="nav-item my-lg-0">
          <a class="nav-link" href="/create_orders.php">Создание прихода</a>
        </li>
        <li class="nav-item my-lg-0">
          <a class="nav-link" href="/settings.php">Настройки</a>
        </li>
        <?php
        }
        ?>
    </ul>
    <ul class="navbar-nav">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $user["lastname"]; ?></a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="/modules/exit.php">Выйти</a>
        </div>
      </li>
    </ul>
        <?php
      } else {
        ?>
        <li class="nav-item my-lg-0">
          <a class="nav-link" href="#exampleModal" data-toggle="modal">Авторизация</a>
        </li>
        <li class="nav-item my-lg-0">
          <a class="nav-link" href="#exampleModalRegistration" data-toggle="modal">Регистрация</a>
        </li>
    </ul>
        <?php
      }
      ?>
  </div>
</nav>