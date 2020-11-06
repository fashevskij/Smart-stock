<?php
// подключаем БД
include "configs/db.php";

// подключаем файл с переменными
include "configs/settings.php";

// подключаем хеадер
include 'blockSite/header.php';

/*
1. Начальная страница
2. Регистрация +
3. Авторизация +
4. Страница после авторизация
*/
if ($user_id == 0) {
?>
  <div class="container">  
    <div class="unbreakable">
      <span class="un">Smart </span>
      <span class="break">- </span>
      <span class="able">Stock</span>
    </div>

    <div class="ks">Программа </div>
    <!-- <div class="ks1">для</div> -->
    <div class="ks11">управления</div>
    <div class="ks2"> Складом </div>
  </div>

  <div class="lake" 
  data-title="Smart-Stock"
  data-description="Уникальное Веб-приложение для управления складом, с помощью которого, можно быстро и эффективно принимать товар, размещать его на складе, вести учет.">
    <img class="lac" src="assets/img/i.png">
  </div>
<?php
}
?>

<?php 
// подключаем файл авторизации
include 'modules/log_in.php';

// подключаем файл регистрации нового пользователя 
include 'modules/registration.php';
?>

<!-- подключаем футер -->
<?php include 'blockSite/footer.php'; ?>