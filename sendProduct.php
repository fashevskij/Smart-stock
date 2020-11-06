   <?php
    // подключаем базу данных
    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

    // подключаем хеадер
    include 'blockSite/header.php';
    ?>

   <!-- создаем шапку таблицы-->
   <div class="card mx-auto mt-2" style="width: 90%    ;">
       <div class="card-body">

           <h5 class="card-title">Накладная №OД000<?php echo $_GET['send_id'] ?> от <?php echo $_GET['datatime'] ?></h5>
           <p class="card-text">
               <!-- создаем таблицу-->

               <table class="table table-responsive" >
                   <thead class="thead-light">
                       <tr>
                           <th>№пп</th>
                           <th>Уникальный номер продукта</th>
                           <th>Название продукта</th>
                           <th>Количество</th>

                       </tr>
                   </thead>
                   <?php
                    // Подключаем  лист отправки продукции
                    include "modules/sendProductList.php";
                    ?>
               </table>
           </p>
       </div>
   </div>

   <?php

    // подключаем футер
    include 'blockSite/footer.php';

    ?>