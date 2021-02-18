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

      <li class="nav-item">
        <button class="btn"><a href="shippedDoc.php" class="nav-link
        <?php if ($page == "shipped_doc") {
          echo 'active';
        }
        ?>">Отгружено(<?php echo $col_doc_ship ?>)</a></button>

      </li>

    </ul>
