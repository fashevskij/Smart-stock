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
