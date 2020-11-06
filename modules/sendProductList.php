
<?php
// подключаем базу данных
    include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';

//Выводим данные номенклатуры из БД  send_nom
$sqlnom  = "SELECT * FROM send_nom WHERE id_send_doc =" . $_GET['send_id']; 

$result_nom = mysqli_query($connect, $sqlnom);
 
$col_result_nom = mysqli_num_rows($result_nom);


//Выводим данные чз цикл 
 $i=1; 
while ($send_nom = mysqli_fetch_assoc($result_nom)){
     
?>
     
    <tbody>
        <tr>               
            
            <td><?php echo $i?></td>
            <td><?php echo $send_nom['product_id'] ?></td>            
            <td><?php echo $send_nom['products'] ?></td>                    
            <td><?php echo $send_nom['count'] ?></td> 
                                          
          
        </tr>
    </tbody>
   
    
    <?php

   $i++ ;  
}
    ?>