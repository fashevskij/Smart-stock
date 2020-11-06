<?php
include "colDoc.php";

?>
<!-- создаем шапку таблицы-->
<div class="card mx-auto mt-2" style="width: 90%    ;">
  <div class="card-body">
    <!--Создаем шапку-->
    <h5 class="card-title">Документы на отгрузку продукции</h5>
    <!--Создаем вкладки-->
    <ul class="nav nav-tabs">

      </li>
      <li class="nav-item">
        <button class="btn"><a href="waitCollectDoc.php" class="nav-link
        <?php if ($page == "wait_collect_doc") {
          echo 'active';
        }
        ?>">Формирование сборки(<?php echo $col_doc_wait ?>)</a></button>

      </li>

      </li>
      <li class="nav-item">
        <button class="btn"><a href="shippedDoc.php" class="nav-link
        <?php if ($page == "shipped_doc") {
          echo 'active';
        }
        ?>">Отгружено(<?php echo $col_doc_ship ?>)</a></button>

      </li>

    </ul>

    <p class="card-text">
      <!-- создаем таблицу-->
      <table class="table table-responsive">
        <thead class="thead-light">
          <tr>
            <th>Дата</th>
            <th>Номер документа</th>
            <th>Контрагент</th>
            <th>Дата отгрузки</th>
            <th>Коментарий</th>


            <th></th>
          </tr>
        </thead>