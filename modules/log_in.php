<?php
// подключаем БД
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// если есть POST-запрос login - выполняем код
if(
  isset($_POST["login"]) && isset($_POST["password"])
  && $_POST["login"] != "" && $_POST["password"] != ""
) {

  // создадим запрос
  $sql = "SELECT * FROM `users` WHERE `login` LIKE '" . $_POST["login"] . "' AND `password` LIKE '" . $_POST["password"] . "'";
  // результаты запроса сохраним в переменной
  $result = mysqli_query($connect, $sql);

  // подсчитаем количество результатов в выводе
  $col_user = mysqli_num_rows($result);
  
  // если количество найденых пользователей = 1
  if($col_user == 1) {

    // переведем результат в массив
    $user = mysqli_fetch_assoc($result);

    //создаем куки для хранения данных пользователя
    setcookie("user_id", $user["id"]);
    
    // переход на главную
    header("Location: /");
  } else {
    // если условие не выполнилось - выведем сообщение
    echo "<h2>Логин или пароль введены не верно</h2>";
  }
}
?>

<!-- прорисовка формы для авторизации -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Авторизация</h5>
      </div>
      <div class="modal-body">
        <form method="POST">
          <div class="form-group">
            <label for="exampleInputEmail1">Login</label>
            <input type="text" class="form-control" name="login">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="password">
          </div>
       
       <!-- Футер -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
       </form>
    </div>
  </div>
</div>