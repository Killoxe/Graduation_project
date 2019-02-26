<?php 
	if(!isset($_COOKIE['auth'])){
		echo '<script>window.location.href = "index.php"; </script>';
	}
?>
<!-- оформление заказа -->
<center id="orderStore" class="orderStore white">
	<h2>Оформление заказа</h2>
	<hr class="horizontalLine">
<!-- оформление заказа -->
	<div>
		<form name="table" method="POST">
		<div class="orderTable table illumination">
			<table>
				<tr>
					<th>Ваш заказ:</th>
				    <th></th>
				    <th></th>
				    <th></th>
				    <th></th>
				    <th></th>
				</tr>
				<?php
					include_once 'php/conn.php';
					$user = mysql_fetch_assoc(mysql_query("SELECT * FROM customer WHERE e_mail LIKE '".  $_COOKIE['e_mail'] ."'"));
					$tovariIzCart = mysql_query("SELECT * FROM cart WHERE id_customer = '". $user['id'] ."'");
					
					while($tvr = mysql_fetch_assoc($tovariIzCart))
					{
						$goods = mysql_fetch_assoc(mysql_query("SELECT * FROM goods WHERE id = ". $tvr['Id_goods']));
					    echo "<tr class='hoverTR' id='". $tvr['id'] ."'>
								<td>" . $goods['name'] . "</td>
								<td>" . $tvr['quantity'] . "</td>
								<td>*</td>
								<td>" . $goods['value'] . "</td>
								<td>=</td>
								<td>"; 
								echo $tvr['quantity']*$goods['value'];
								echo "</td>
							</tr>";
							$summaTovarov += $tvr['quantity']*$goods['value'];
					}
				?>
			</table>
			
		</div>
		</form>
	</div>
	Сумма заказ: <?= $summaTovarov ?> руб.<br> 
	Доставка: Бесплатно
	<div class="panelOrder">
		<div class="sposob_dostavki">
			Способ доставки:<br>
			<select class="inputText form-control black select_sposob_dostavki">
				<option value="1">Доставка</option>
				<option value="2">Самовызов</option>
			</select>
		</div>
		<div class="sposob_oplati">
			Способ оплаты:<br>
			<select class="inputText form-control black select_sposob_oplati">
				<option value="1">Наличный расчет</option>
				<option value="2">Безналичный расчет</option>
				<option value="3">Кредитная карта</option>
			</select>
		</div>
		<div class="adress">
			<input type="text" class="inputText white" name="street" placeholder="Улица">
			<input type="text" class="inputText white" name="hous" placeholder="Дом">
			<input type="text" class="inputText white" name="korpus" placeholder="Корпус">
			<input type="text" class="inputText white" name="stroenie" placeholder="Строение">
			<input type="text" class="inputText white" name="apartment" placeholder="Кв./Офис">
		</div>
		<div class="credit_card_input">
			<input type="text" class="inputText white" name="numberCart" placeholder="Номер карты"><br>
			Срок действия карты:<br>
			<input type="text" class="inputText white" name="year" placeholder="год">
			<input type="text" class="inputText white" name="month" placeholder="месяц"><br>
			Имя и фамилия держателя карты:<br>
			<input type="text" class="inputText white" name="name" placeholder="имя">
			<input type="text" class="inputText white" name="surname" placeholder="фамилия">
			<input type="text" class="inputText white" name="kod" placeholder="Секретный код">
		</div>
		<div class="time">
			Время доставки:<br>
			<input type="text" class="inputText white" name="ot" placeholder="С">
			<input type="text" class="inputText white" name="do" placeholder="До">
		</div>
		<textarea name="comment" class="inputText white" placeholder="Комментарии к заказу"></textarea>
	</div>	
	<div class="white btnOrderOff">
		<div id="addOrder" class="btn btnMini">Оформить заказ</div>
	</div>
</center>
<!-- логика -->
<script>
	$(document).ready(function(){
		$('.credit_card_input').hide();

		/* проверка споособа оплаты */
		$('.select_sposob_oplati').change(function(){
			if($(this).val() == '3'){
				$('.credit_card_input').show();
			}else{
				$('.credit_card_input').hide();
			}
		});

		/* проверка спобоа доставки */
		$('.select_sposob_dostavki').change(function(){
			if($(this).val() == '2'){
				$('.adress').hide();
				$('.time').hide();
			}else{
				$('.adress').show();
				$('.time').show();
			}
		});
	});
</script>
<?php
//добавление заказа
	include_once 'php/conn.php';
	$street = trim($_POST['street']);
	$hous = trim($_POST['hous']);
	$korpus = trim($_POST['korpus']);
	$stroenie = trim($_POST['stroenie']);
	$apartment = trim($_POST['apartment']);
	$numberCart = trim($_POST['numberCart']);
	$year = trim($_POST['year']);
	$month = trim($_POST['month']);
	$name = trim($_POST['name']);
	$surname = trim($_POST['surname']);
	$kod = trim($_POST['kod']);
	$ot = trim($_POST['ot']);
	$do = trim($_POST['do']);
	$comment = trim($_POST['comment']);

	$furnityra = $_POST['goodsAcc'];
	$disigner = $_POST['goodsDdisig'];

	if(isset($_POST['addOrder'])){
		

		//if($ok['name'] && $ok['value'] && $ok['quantity'] && $ok['color'] && $ok['material'] && $ok['image']){
			$sqlGoods = mysql_query("INSERT INTO orders (, id_access, id_disigner, name, value, quantity, characterr, description, color, material, img_goods, model) 
				VALUES ('".$category."','".$furnityra."','".$disigner."','".$name."','".$value."','".$quantity."','".$character."','".$description."','".$color."','".$material."','".$dir_photo_tovar."','".$dir_model_tovar."')");
			$errorList[] = 'Товар успешно добавлен в базу данных';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newGoods" </script>';
		/*}else{
			$errorList[] = '<br>Ошибка: товар не добавлен в базу данных';
		}*/
    }