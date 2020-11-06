<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';

//указываем название страницы 
$page = "collected_doc";

// Получаем данные из БД        
$sql = " SELECT * FROM send_products WHERE status_send='Собрано' ";

$result = mysqli_query($connect, $sql);
$col_doc_collected = mysqli_num_rows($result);
// Подключаем  шапку 
include "blockSite/sendOrderCap.php";



// Пока  присутствую значения  в переменной выводим данные
while ($sendList = mysqli_fetch_assoc($result)) {

?>

    <tbody>
        <tr>
            <!--Выводим дату и время из масива -->
            <td>
                <?php echo date("d.m.y H:i:s", strtotime($sendList['datatime'])) ?>
            </td>
            <!--Выводим ид отправки  из масива -->
            <td>ОД000<?php echo $sendList['send_id'] ?>
            </td>
            <!--Выводим контрагента из масива -->
            <td>
                <?php echo $sendList['customer'] ?>
            </td>
            <!--Выводим дату отгрузки из масива -->
            <td>
                <?php echo date("d.m.y", strtotime($sendList['shipping_date'])) ?>
            </td>
            <!--Выводим сопроводительную информацию из масива -->
            <td>
                <?php echo $sendList['info'] ?>

            </td>


            <td>
                <!--Добавляем блок кнпок-->
                <div class="btn-group " role="group">
                    <!--Добавляем кнопку  просмотр-->
                    <a href='sendProduct.php?send_id=<?php echo $sendList["send_id"] ?>&datatime=<?php echo date("d.m.y", strtotime($sendList['datatime'])) ?>' type="button">
                        <img src="assets/img/eye-icon.png" style=" height: 50px; width: 50px">
                    </a>
                    <!--Добавляем кнопку  сборка-->
                    <a style="background: #0075d4;" href="statusChange.php?send_id=<?php echo $sendList["send_id"] ?>&page=<?php echo $page ?>" type="button" class="btn btn-secondary">
                        <h8>Отгружено</h8>
                    </a>
                </div>
            </td>
        </tr>
    </tbody>

<?php


}

?>

</table>
</p>
</div>
</div>
<?php

// подключаем футер
include 'blockSite/footer.php';

?>