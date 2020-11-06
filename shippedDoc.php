

<?php
// подключаем базу данных
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

// подключаем хеадер
include 'blockSite/header.php';

//указываем название страницы 
$page = "shipped_doc";

 // Получаем данные из БД        
     $sql = " SELECT * FROM send_products WHERE status_send='Отгружено' ";

    $result = mysqli_query($connect, $sql);
    $col_doc_ship = mysqli_num_rows($result);
// Подключаем  шапку 
 include "blockSite/sendOrderCap.php";
// Пока  присутствую значения  в переменной выводим данные
    while ($sendList = mysqli_fetch_assoc($result)){
    
    ?>
         
            <tbody>
                <tr>
                      <!--Выводим дату и время из масива -->           
                    <td>
                        <?php echo date ("d.m.y H:i:s",strtotime ($sendList['datatime'] ) )?>     
                    </td>
                     <!--Выводим ид отправки  из масива --> 
                    <td>№<?php echo $sendList['send_id']?>
                    </td>
                     <!--Выводим контрагента из масива -->  
                    <td>
                        <?php echo $sendList['customer'] ?>      
                    </td>
                     <!--Выводим дату отгрузки из масива -->
                    <td>
                        <?php echo date ("d.m.y",strtotime ($sendList['shipping_date'] ) )?> 
                    </td>
                    <!--Выводим сопроводительную информацию из масива -->                     
                    <td>
                        <?php echo $sendList['info'] ?>          
                   
                    </td> 

                    
                     <td>
                        
                      <div  class="btn-group " role="group">
                            <!--Добавляем кнопку  просмотр-->
                          <a  href='sendProduct.php?send_id=<?php echo $sendList["send_id"]?>&datatime=<?php echo date ("d.m.y",strtotime ($sendList['datatime'] ) )?>' type="button" >
                              <img src="assets/img/eye-icon.png" style =" height: 50px; width: 50px">
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
  



