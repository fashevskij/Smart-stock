<?php
// подключаем БД
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// если есть POST-запрос loginReg?
if(
  isset($_POST["loginReg"]) && isset($_POST["passwordReg"])
  && $_POST["loginReg"] != "" && $_POST["passwordReg"] != ""
) {
  // подготовим запрос в БД
   $sql = "SELECT * FROM `users` WHERE `login` LIKE '" . $_POST["loginReg"] . "'";

  // результаты запроса в переменную
  $result = mysqli_query($connect, $sql);

  // подсчитаем найденных пользователей
  $col_user = mysqli_num_rows($result);

  // если найден 1 пользователь
  if($col_user == 1) {
    ?>

    <!-- выводим сообщение -->
    <div class="alert alert-dark" role="alert">
      Пользователь уже существует
    </div>
    <?php
    // иначе
  } else {
    
    // создадим запрос в БД
    $sql = "INSERT INTO users (login, password, lastname) VALUES ('" . $_POST["loginReg"] . "', '" . $_POST["passwordReg"] . "', '" . $_POST["lastname"] . "')";

    // если успешно выполнен запрос в БД
    if(mysqli_query($connect, $sql)) {
      
      // переход на главную
      header("Location: /");

      // иначе  - сообщение об ошибке
    } else {
    echo "<h2>Произошла ошибка</h2>" . mysqli_error($connect);
    }
  }
}
?>

<!-- прорисуем форму регистрации -->
<div class="modal fade" id="exampleModalRegistration" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Регистрация</h5>
      </div>
      <div class="modal-body">
        <form action="/" method="POST">
          <div class="form-group">
            <label for="exampleInputPassword1">Lastname</label>
            <input type="text" class="form-control" id="exampleInputPassword1" name="lastname">
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" class="form-control" name="loginReg">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="passwordReg">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
       </form>
    </div>
  </div>
</div>