<?php
	include_once 'php/conn.php';
	//добавление дизайнера
	$nameProv = trim($_POST['nameProv']);
	$phoneProv = trim($_POST['phoneProv']);
	$mailProv = trim($_POST['mailProv']);

	if(isset($_POST['provAdd'])){
		//наименование
		if(strlen($nameProv) == 0){
			$errorList[] = '<br>Вы не ввели наименование поставщика';
		}else{
			$ok['nameProv'] = true;
		}
		//телефон
		if(strlen($phoneProv) == 0){
			$errorList[] = 'Вы не ввели телефон поставщика';
		}else{
			$ok['phoneProv'] = true;
		}
		//почта
		if(strlen($mailProv) == 0){
			$errorList[] = 'Вы не ввели почту поставщика';
		}else{
			$ok['mailProv'] = true;
		}

		if($ok['mailProv'] && $ok['nameProv'] && $ok['phoneProv']){
			$sqlGoods = mysql_query("INSERT INTO provider (name, phone, e_mail) 
				VALUES ('".$nameProv."','".$phoneProv."','".$mailProv."')");
			$errorList[] = 'Поставщики был успешно добавлен в базу данных<br>';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newProv" </script>';
		}else{
			$errorList[] = 'Ошибка: поставщик не добавлен в базу данных<br>';
		}
    }
//удаление товара
    if(isset($_POST['provRem'])){
    	foreach($_POST['check'] as $id) {
    		mysql_query("DELETE FROM provider WHERE id = '".$id."'"); 
    	}
    	print '<script type="text/javascript"> window.location.href = "Admin.php?_newProv" </script>';
    }
//изменение товара
    $nameProv = trim($_POST['nameProv']);
	$phoneProv = trim($_POST['phoneProv']);
	$mailProv = trim($_POST['mailProv']);
	
    if(isset($_POST['provUpOk'])){
		//наименование
		if(strlen($nameProv) == 0){
			$errorList[] = '<br>Вы не ввели наименование поставщика';
		}else{
			$ok['nameProv'] = true;
		}
		//телефон
		if(strlen($phoneProv) == 0){
			$errorList[] = 'Вы не ввели телефон поставщика';
		}else{
			$ok['phoneProv'] = true;
		}
		//почта
		if(strlen($mailProv) == 0){
			$errorList[] = 'Вы не ввели почту поставщика';
		}else{
			$ok['mailProv'] = true;
		}

		if($ok['mailProv'] && $ok['nameProv'] && $ok['phoneProv']){
			$sqlGoods = mysql_query("UPDATE provider
				SET name = '".$nameProv."', phone = '".$phoneProv."', e_mail = '".$mailProv."' WHERE id = " . $_POST['id_tovar']);
			$errorList[] = 'Товар успешно изменен<br>';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newProv" </script>';
		}else{
			$errorList[] = 'Ошибка: товар не был изменен<br>';
		}
	}
?>
<!-- таблица дизайнерами -->
<center class="white formNewGoods">
	<h2>Поставщики</h2>
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
<!-- таблица товаров -->
	<form name="table" method="POST">
		<div class="newStatTable newGoodsTable table illumination">
			<table>
				<tr>
					<th></th>
				    <th>№</th>
				    <th>Наименование</th>
				    <th>Телефон</th>
				    <th>Почта</th>
				</tr>
				<?php
					include_once 'php/conn.php';
					$disTablAdmin = mysql_query("SELECT * FROM provider");
					
					while($dateDisig = mysql_fetch_assoc($disTablAdmin))
					{
					    echo "<tr class='hoverTR' id='". $dateDisig['id'] ."'>
								<td><input type='checkbox' name='check[]' class='cbSelect' value='" . $dateDisig['id'] . "' id='cb-". $dateDisig['id'] ."'></td>
								<td>" . $dateDisig['id'] . "</td>
								<td>" . $dateDisig['name'] . "</td>
								<td>" . $dateDisig['phone'] . "</td>
								<td>" . $dateDisig['e_mail'] . "</td>
							</tr>";
					}
				?>
			</table>
			<div class="panelUpAdd">
				<h2>Добавить новнового поставщика:</h2>
				<hr class="horizontalLine">
				<div><input type="text" class="inputText white" name="nameProv" placeholder="Наименование"></div>
				<div><input type="text" class="inputText white" name="phoneProv" placeholder="Телефон"></div>
				<div><input type="text" class="inputText white" name="mailProv" placeholder="Почта"></div>
			</div>
		</div>
		<div class="btnNewGoods">
			<input type="submit" name="provAdd" value="Добавить поставщика" id="removeNewGoods" class="btn btnMini white">
			<div id="provUp" class="addNewGoods btn btnMini">Изменить поставщика</div>
			<input type="submit" name="provRem" value="Удалить поставщика" id="removeNewGoods" class="btn btnMini white">
		</div>
	</form>
<!-- форма изменения товара -->
	<div id="panelUpProv" class="panelAddGoods hide">
		<form method="post" class="formAddGoods">
			<h2>Редактировать поставщика:</h2>
			<hr class="horizontalLine">
			<div>
				<input type="text" class="hide" name="id_tovar">
				<div><input type="text" class="inputText white" name="nameProv" placeholder="Наименование"></div>
				<div><input type="text" class="inputText white" name="phoneProv" placeholder="Телефон"></div>
				<div><input type="text" class="inputText white" name="mailProv" placeholder="Почта"></div>
			</div>
			<input type="submit" name="provUpOk" value="Сохранить" class="btn btnMini white">
			<input type="submit" name="provUpEx" value="Выйти" class="btn btnMini white">
		</form>
	</div>

<!-- ошибки -->
	<div id="footErrorNewGoods" class="footError white hide">
		<?php
			/* вывод ошибок */
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
<!-- логика -->
<script type="text/javascript">
$(function() {

	$('#footErrorNewGoods').hide();
	$('#footErrorNewGoods').removeClass('hide');

	$('#panelUpProv').hide();
	$('#panelUpProv').removeClass('hide');

	var place_checkbox = 0;
	// нажатие на нужный товар 
	$('.hoverTR').each(function(){
		$(this).on('click', function(){
			if(!$(this).hasClass('targetTR')) $(this).addClass('targetTR'); else $(this).removeClass('targetTR');
			if($('#cb-'+$(this).attr('id')).prop('checked') == false) $('#cb-'+$(this).attr('id')).prop('checked', true); else $('#cb-'+$(this).attr('id')).prop('checked', false);
			place_checkbox = $(this).index()-1;
		});
	});

/* нажатие на 'изменение товара' */
			$('#provUp').click(function() {
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
						$('input[name="id_tovar"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(1)').html())

						$('input[name="nameProv"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(2)').html());
						$('input[name="phoneProv"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(3)').html());
						$('input[name="mailProv"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(4)').html());

						$('#panelUpProv').delay( 100 ).fadeIn('slow');
					}else{
//выделено больше одного для изменения
					}
				}
			});
});
</script>