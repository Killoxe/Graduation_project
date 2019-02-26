<?php
$customer = mysql_fetch_assoc(mysql_query("SELECT * FROM customer WHERE e_mail LIKE '". $_COOKIE['e_mail']. "'"));
?>
<!-- личный кабинет -->
<center id="roomCustmer" class="roomCustmer hide">
<!-- меню -->
	<div class="menuRoomCustmer illumination gray">
		<h3>Добрый день <?php echo $customer['surname'] ," ", $customer['name'] ," ", $customer['patron']; ?></h3>
		<hr class="horizontalLine">
		<ul>
			<li id="btnPersonalData" class="btn">Личные данные</li>
			<li id="btnHistoryOrders" class="btn">История заказов</li>
			<li id="btnStatusOrders" class="btn">Статус заказов</li>
			<li id="btnConsultation" class="btn">Консультация</li>
		</ul>
	</div>
<!-- панель с данными -->
	<div class="panelRoomCustmer illumination white">
<!-- персональные данные -->
		<div id="personalDataCustmer" class="personalDataCustmer">
			<h2>Личные данные</h2>
			<hr class="horizontalLine">
			<div class="dataCustmer">
				ФИО: <?php echo $customer['surname'] ," ", $customer['name'] ," ", $customer['patron']; ?><br>
				Телефон: <?php echo $customer['phone']; ?><br>
				E-mail: <?php echo $_COOKIE['e_mail']; ?><br>
			</div>
			<div id="upCus" class="btn btnMini">Добавить или изменить данные</div>
		</div>
<!-- форма изменения персональных данных md5-->
	<div id="panelUpCus" class="panelAddGoods hide">
		<form method="post" class="formAddGoods" enctype="multipart/form-data">
			<h2>Изменить персональные данные:</h2>
			<hr class="horizontalLine">
			<div class="roomCusForm">
				Фамилия: <input type="text" class="inputText white" name="surnameCos" placeholder=<?php echo $customer['surname']; ?>><br>
				Имя: <input type="text" class="inputText white" name="nameCos" placeholder=<?php echo $customer['name']; ?>><br>
				Отчество: <input type="text" class="inputText white" name="patronCos" placeholder=<?php echo $customer['patron']; ?>><br>
				Телефон: <input type="text" class="inputText white" name="phoneCos" placeholder=<?php echo $customer['phone']; ?>><br>
				Почта: <input type="text" class="inputText white" name="mailCos" placeholder=<?php echo $customer['e_mail']; ?>><br>
				Пароль: <input type="text" class="inputText white" name="passCos" placeholder=<?php echo $customer ['pass']; ?>><br>
				Повторите пароль: <input type="text" class="inputText white" name="dublPassCos" placeholder=<?php echo $customer['pass']; ?>><br>
			</div>
			<input type="submit" name="OkUpCus" value="Сохранить" class="btn btnMini white">
			<input type="submit" name="goodsEx" value="Выйти" class="btn btnMini white">
		</form>
	</div>
<!-- история заказов -->
		<div id="historyOrders" class="historyOrders hide">
			<h2>История заказов</h2>
			<hr class="horizontalLine">
			<div class="tableHistoryOrders table">
				<table>
				<tr>
				    <th>№</th>
				    <th>Товары и кол-во</th>
				    <th>Сотрудник</th>
				    <th>Дата и время заказа</th>
				    <th>Дата и время доставки</th>
				    <th>Стоимость</th>
				</tr>

					<?php
					include_once 'php/conn.php';
					/*$customerHistory = mysql_query("SELECT * FROM customer WHERE e_mail LIKE '". $_COOKIE['e_mail']. "'") or trigger_error(mysql_error()." in ". $customerHistory);
					$history = mysql_query("SELECT * FROM orders WHERE id_customer LIKE '". $customerHistory['id']. "'") or trigger_error(mysql_error()." in ". $history);*/

					$order_query = mysql_query("SELECT * FROM orders WHERE id_customer = '". $customer['id'] ."' GROUP BY id_customer");
					
					while($history = mysql_fetch_assoc($order_query))
					{
						//$goodHistory = mysql_fetch_assoc(mysql_query("SELECT * FROM goods_in_orders WHERE id_orders LIKE ".$history['id']."") or trigger_error(mysql_error()." in ". $goodHistory));
						//$good = mysql_fetch_assoc(mysql_query("SELECT * FROM goods WHERE id LIKE ".$goodHistory['id_goods']."") or trigger_error(mysql_error()." in ". $good));

						
						$assoc = mysql_fetch_assoc(mysql_query("SELECT * FROM associate WHERE id = ". $history[id_assoc]));

					    echo "<tr class='hoverTR' id='". $history[id] ."'>
								<td>" . $history[id] . "</td>
								<td>"; 

								$tovari_v_orders = mysql_query("SELECT * FROM goods_in_orders WHERE id_orders = '". $history[id] ."'");
								while($tvri = mysql_fetch_assoc($tovari_v_orders)){
									$tovari_array[] = $tvri[id_goods];
									/*$goods_po = mysql_fetch_assoc(mysql_query("SELECT * FROM goods WHERE id = ". $tvri[id_goods]));

									$quantity_goods = mysql_query("SELECT * FROM orders");
									
									$echo_goods_po = $echo_goods_po.$goods_po[name].' (), ';*/
								}
								/*$echo_goods_po = substr($echo_goods_po, 0, -2);
								echo $echo_goods_po;*/

								for($i = 0; $i < count($tovari_array); $i++){
									echo $tovari_array[$i].'<br>';
								}



								echo "</td>
								<td>" . $assoc[surname] ." ". $assoc[name] ." ". $assoc[patron] ."</td>
								<td>" . $history[date_ord] ." ". $history[time_ord] ."</td>
								<td>data</td>
								<td>" . $history[value_ord] . "</td>
								
							</tr>";
					}
				?>
				
			</table>
			</div>
		</div>
<!-- статус заказа -->
		<div id="statusOrders" class="statusOrders hide">
			<h2>Статус заказов</h2>
			<hr class="horizontalLine">
			<div class="tableStatusOrders table">
				<table>
				<tr>
				    <th>№</th>
				    <th>Товары</th>
				    <th>Кол-во</th>
				    <th>Дата и время заказа</th>
				    <th>Дата и время доставки</th>
				    <th>Стоимость</th>
				</tr>
				<tr>
					<td>1</td>
				</tr>
				
			</table>
			</div>
		</div>
<!-- консультация -->
		<div id="consultation" class="consultation hide">
			<h2>Консультация</h2>
			<hr class="horizontalLine">

		</div>
	</div>
</center>
<script type="text/javascript">
$(function() {

			$('#historyOrders, #statusOrders, #consultation, #panelUpCus').hide();
			$('#historyOrders, #statusOrders, #consultation, #panelAddCus').removeClass('hide');

			$('#btnPersonalData').click(function() {
				$('#historyOrders, #statusOrders, #consultation').fadeOut('slow');
				$('#personalDataCustmer').delay( 600 ).fadeIn('slow');
			});

			$('#btnHistoryOrders').click(function() {
				$('#personalDataCustmer, #statusOrders, #consultation').fadeOut('slow');
				$('#historyOrders').delay( 600 ).fadeIn('slow');
			});

			$('#btnStatusOrders').click(function() {
				$('#historyOrders, #personalDataCustmer, #consultation').fadeOut('slow');
				$('#statusOrders').delay( 600 ).fadeIn('slow');
			});

			$('#btnConsultation').click(function() {
				$('#historyOrders, #statusOrders, #personalDataCustmer').fadeOut('slow');
				$('#consultation').delay( 600 ).fadeIn('slow');
			});

			$('#panelUpCus').hide();
			$('#panelUpCus').removeClass('hide');
			$('#upCus').click(function() {
				$('#panelUpCus').delay( 100 ).fadeIn('slow');
			});

	});
</script>
<?php
	$surname = trim($_POST['surnameCos']);
	$name = trim($_POST['nameCos']);
	$patron = trim($_POST['patronCos']);
	$phone = trim($_POST['phoneCos']);
	$mail = trim($_POST['mailCos']);
	$pass = trim($_POST['passCos']);
	$dublPass = trim($_POST['dublPassCos']);
//изменение даных
	if(isset($_POST['OkUpCus'])){
//изменение только телефона
		if(strlen($phone) != 0){
			$sqlCusPhone = mysql_query("UPDATE customer 
			SET phone = '". $phone. "' WHERE e_mail LIKE '". $customer['e_mail'] ."'");
		}
//изменение фио
		if(strlen($surname) != 0 && strlen($name) != 0 && strlen($patron) != 0){
			$sqlCusPhone = mysql_query("UPDATE customer 
					SET surname = '". $surname."', name = '". $name."' , patron = '". $patron."' WHERE e_mail LIKE '". $customer['e_mail'] ."'");
		}
//изменение пароля =================доделать================
		/*if(strlen($surname) != 0 && strlen($name) != 0 && strlen($patron) != 0){
			$sqlCusPhone = mysql_query("UPDATE customer 
					SET surname = '". $surname."', name = '". $name."' , patron = '". $patron."' WHERE e_mail LIKE '". $customer['e_mail'] ."'");
		}*/
		//print '<script type="text/javascript"> window.location.href = "Mag.php?_room" </script>';
	}



?>