<?php
// подключаем БД
include $_SERVER['DOCUMENT_ROOT'] . '/configs/db.php';
$sql = "SELECT * FROM stock";
// реализуем запрос
$result = $connect->query($sql);
//Определяем количество строк в БД
$col_rows = mysqli_num_rows($result);

$i = 0;
//переменная для вывода отсутсвия результата по поиску 
$a = false;
//проходим по каждой строке в БД
while ($i < $col_rows) {
	$stock = mysqli_fetch_assoc($result);
	if ($stock['order_id'] == $_POST["searchIdOrder"]) {

?>
		<tbody>
			<tr>
				<td> <?php echo $stock['order_id'] ?></td>
				<td><?php echo $stock['prod_id'] ?></td>
				<td><?php echo $stock['name'] ?></td>
				<td> <?php echo $stock['size'] ?></td>
				<td><?php echo $stock['rack'] ?></td>
				<td><?php echo $stock['shelf'] ?></td>
				<td><?php echo $stock['tray'] ?></td>
				<td><?php echo $stock['date'] ?></td>
				<?php
				if (isset($_GET['send'])) {
				?>
					<td>
						<div id="send" class="form-check form-check-inline">
							<input class="form-check-input" type="checkbox" id="inlineCheckbox1" name="select[]" value="<?php echo $products["newid"]; ?>">
							<label class="form-check-label" for="inlineCheckbox1"></label>
						</div>
					</td>
				<?php
				}
				?>
			</tr>
		</tbody>
<?php
		$a = true;
	}
	$i++;
}

if ($a == false) {
	echo "<h2>" . "Совпадений по поиску не найдено" . "</h2>";
}
?>