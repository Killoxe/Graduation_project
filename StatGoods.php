<?php
	//изменение товара
    $status = trim($_POST['orderStat']);

	
    if(isset($_POST['statusOk'])){
		//количество товара
		if(strlen($status) == 0){
			$errorList[] = '<br>Вы не ввели количество товара';
		}else{
			$ok['status'] = true;
		}

		if($ok['status']){
			$sqlGoods = mysql_query("UPDATE orders
				SET status_ord = '".$status."' WHERE id = " . $_POST['id_stat']);
			$errorList[] = 'Товар успешно изменен<br>';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_statGoods" </script>';
		}else{
			$errorList[] = 'Ошибка: товар не был изменен<br>';
		}

	}
?>
<!-- таблица статуса товара -->
<center class="white formNewGoods">
	<h2>Статус товара</h2>
	<hr class="horizontalLine">
<!-- поиск -->
	<div class="searchBarMag">
		<form method="get" class="search">
			<input name="search" type="search" placeholder="Поиск...">
			<button name="search">
				<img src="img/012-magnifying-glass.png" alt="">
			</button>
					</form>
	</div>
<!-- таблица заказов -->
	<div class="newGoodsTable table illumination">
		<table>
			<tr>
				<th></th>
			    <th>№</th>
			    <th>Клиент</th>
			    <th>Товар</th>
			    <th>Сотрудник</th>
			    <th>Дата и время заказа</th>
			    <th>Статус заказ</th>
			    <th>Кол-во</th>
			    <th>Сумма заказа</th>
			</tr>
			<?php
				include_once 'php/conn.php';
				$statTablAdmin = mysql_query("SELECT * FROM orders");
				
				while($dateStat = mysql_fetch_assoc($statTablAdmin))
				{
					$customerStat = mysql_fetch_assoc(mysql_query("SELECT * FROM customer WHERE id LIKE ".$dateStat['id_customer'].""));
					$associateStat = mysql_fetch_assoc(mysql_query("SELECT * FROM associate WHERE id LIKE ".$dateStat['id_assoc'].""));
				    echo "<tr class='hoverTR' id='". $dateStat['id'] ."'>
							<td><input type='checkbox' name='check[]' class='cbSelect' value='" . $dateStat['id'] . "' id='cb-". $dateStat['id'] ."'></td>
							<td>" . $dateStat['id'] . "</td>
							<td>" . $customerStat['surname'] ." ". $customerStat['name'] ." ". $customerStat['patron'] . "</td>
							<td></td>
							<td>" . $associateStat['surname'] ." ". $associateStat['name'] ." ". $associateStat['patron'] . "</td>
							<td>" . $dateStat['date_ord'] . " " . $dateStat['time_ord'] . "</td>
							<td>" . $dateStat['status_ord'] . "</td>
							<td>" . $dateStat['quantity'] . "</td>
							<td>" . $dateStat['value_ord'] . "</td>
						</tr>";
				}
			?>
		</table>
	</div>
	<div class="btnNewGoods">
		<div id="upStat" class="changeNewGoods btn btnMini">Изменить статус товар</div>
	</div>
<!-- форма изменения статуса -->
	<div id="upStatPanel" class="panelAddGoods hide">
		<form method="post" class="formAddGoods">
			<h2>Изменить статус товара:</h2>
			<hr class="horizontalLine">
			<div>
				<input type="text" class="hide" name="id_stat">
				<input type="text" class="inputText white" name="orderStat" placeholder="Статус">
			</div>
			<input type="submit" name="statusOk" value="Сохранить" class="btn btnMini white">
			<input type="submit" name="goodsOk" value="Выйти" class="btn btnMini white">
			</div>
		</form>
	</div>
<!-- ошибки -->
	<div id="footErrorNewGoods" class="footError white hide">
		<?php
			/* вывод ошибок */
			include_once 'php/AddRemUpGoods.php';
			$i = 0;
			foreach ($errorList as $err){
				$i++;
				echo $err.'<br>';
			}
			if($i != 0){
				echo "<script type='text/javascript'>$('#footErrorNewGoods').delay(1000).fadeIn('slow').delay(5000).fadeOut('slow');</script>";
			}
		?>
	</div>
</center>

<script type="text/javascript">
$(function() {

			$('#upStatPanel').hide();
			$('#upStatPanel').removeClass('hide');
			/*$('#upStat').click(function() {
				$('#upStatPanel').delay( 100 ).fadeIn('slow');
			});*/

			var place_checkbox = 0;
			/* нажатие на нужный товар */
			$('.hoverTR').each(function(){
				$(this).on('click', function(){
					if(!$(this).hasClass('targetTR')) $(this).addClass('targetTR'); else $(this).removeClass('targetTR');
					if($('#cb-'+$(this).attr('id')).prop('checked') == false) $('#cb-'+$(this).attr('id')).prop('checked', true); else $('#cb-'+$(this).attr('id')).prop('checked', false);
					place_checkbox = $(this).index()-1;
				});
			});

			/* нажатие на 'изменение товара' */
			$('#upStat').click(function() {
				var count_checkbox = 0;
				$('.cbSelect').each(function(){
					if($(this).prop('checked') == true){
						count_checkbox++;
					}
				});

				if(count_checkbox == 0){
					//нечего изменять
				}else{
					if(count_checkbox == 1){
						/* перемещение значений */
						$('input[name="id_stat"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(1)').html())

						$('input[name="orderStat"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(6)').html());

						$('#upStatPanel').delay( 100 ).fadeIn('slow');
					}else{
						//выделено больше одного для изменения
					}
				}
			});

	});
</script>