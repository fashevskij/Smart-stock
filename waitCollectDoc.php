<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';
include "blockSite/sendOrderCap.php";




?>
<form method="POST" action="/stock.php?send=1">
    <tbody>
        <tr>
            <!--Выводим дату и время из масива -->
            <td>
                <input name="datatime" type="datetime-local">
            </td>
            <!--Выводим ид отправки  из масива -->
            <td>
                <input name="send_id">
            </td>
            <!--Выводим контрагента из масива -->
            <td>
                <input name="customer">
            </td>
            <!--Выводим дату отгрузки из масива -->
            <td>
                <input name="shipping_date" type="datetime-local">
            </td>
            <!--Выводим сопроводительную информацию из масива -->
            <td>
                <input name="info">
            </td>


            <td>
                <!--Добавляем блок кнпок-->
                <div class="btn-group " role="group">
                    <!--Добавляем кнопку  просмотр-->
                    <button type="submit" name="button-send">
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