<?php
	include_once 'php/conn.php';
	//добавление фурнитуры
	$name = trim($_POST['accName']);
	$quantity = trim($_POST['accQuan']);
	$view = $_POST['accView'];
	$provider = $_POST['accProv'];

	if(isset($_POST['accOk'])){
		//наименование фурнитуры
		if(strlen($name) == 0){
			$errorList[] = '<br>Вы не ввели наименование фурнитуры';
		}else{
			$ok['name'] = true;
		}
		//количество фурнитуры
		if(strlen($quantity) == 0){
			$errorList[] = 'Вы не ввели количество фурнитуры';
		}else{
			$ok['quantity'] = true;
		}

		if($ok['name'] && $ok['quantity']){
			$sqlGoods = mysql_query("INSERT INTO accessories (name, quantity, id_view, id_provider) 
				VALUES ('".$name."','".$quantity."','".$view."','".$provider."')");
			$errorList[] = 'Товар успешно добавлен в базу данных<br>';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newFurnit" </script>';
		}else{
			$errorList[] = 'Ошибка: товар не добавлен в базу данных<br>';
		}
    }
//удаление товара
    if(isset($_POST['accRem'])){
    	foreach($_POST['check'] as $id) {
    		mysql_query("DELETE FROM accessories WHERE id = '".$id."'"); 
    	}
    	print '<script type="text/javascript"> window.location.href = "Admin.php?_newFurnit" </script>';
    }
//изменение товара
    $name = trim($_POST['accName']);
	$quantity = trim($_POST['accQuan']);
	$view = $_POST['accView'];
	$provider = $_POST['accProv'];
	
    if(isset($_POST['accUpOk'])){
		//количество товара
		if(strlen($name) == 0){
			$errorList[] = '<br>Вы не ввели количество товара';
		}else{
			$ok['name'] = true;
		}
		//цвет товара
		if(strlen($quantity) == 0){
			$errorList[] = 'Вы не ввели цвет товара';
		}else{
			$ok['value'] = true;
		}

		if($ok['name'] && $ok['value']){
			$sqlGoods = mysql_query("UPDATE accessories
				SET name = '".$name."', quantity = '".$quantity."', id_view = '".$view."', id_provider = '".$provider."' WHERE id = " . $_POST['id_acc']);
			$errorList[] = 'Товар успешно изменен<br>';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newFurnit" </script>';
		}else{
			$errorList[] = 'Ошибка: товар не был изменен<br>';
		}

	}
?>
<!-- таблица с товарами -->
<center class="white formNewGoods">
	<h2>Фурнитура</h2>
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
		<div class="newGoodsTable table illumination">
			<table>
				<tr>
					<th></th>
				    <th>№</th>
				    <th>Наименование</th>
				    <th>Кол-во</th>
				    <th>Вид Фурнитуры</th>
				    <th>Поставщик</th>
				</tr>
				<?php
					include_once 'php/conn.php';
					$goodsTablAdmin = mysql_query("SELECT * FROM accessories");
					
					while($dateGoods = mysql_fetch_assoc($goodsTablAdmin))
					{
						$goodCategory = mysql_fetch_assoc(mysql_query("SELECT * FROM view WHERE id LIKE '" .$dateGoods['id_view']. "'"));
						$goodAccess = mysql_fetch_assoc(mysql_query("SELECT * FROM provider WHERE id LIKE '" .$dateGoods['id_provider']. "'"));
					    echo "<tr class='hoverTR' id='". $dateGoods['id'] ."'>
								<td><input type='checkbox' name='check[]' class='cbSelect' value='" . $dateGoods['id'] . "' id='cb-". $dateGoods['id'] ."'></td>
								<td>" . $dateGoods['id'] . "</td>
								<td>" . $dateGoods['name'] . "</td>
								<td>" . $dateGoods['quantity'] . "</td>
								<td>" . $goodCategory['name'] . "</td>
								<td>" . $goodAccess['name'] . "</td>
							</tr>";
					}
				?>
			</table>
		</div>
		<div class="btnNewGoods">
			<div id="addNewGoods" class="addNewGoods btn btnMini">Добавить фурнитуру</div>
			<div id="upGoods" class="addNewGoods btn btnMini">Изменить фурнитуру</div>
			<input type="submit" name="accRem" value="Удалить фурнитуру" id="removeNewGoods" class="btn btnMini white">
		</div>
	</form>
<!-- форма добавления товара -->
	<div id="panelAddGoods" class="panelAddGoods hide">
		<form method="post" class="formAddGoods" enctype="multipart/form-data">
			<h2>Добавить новую фурнитуру:</h2>
			<hr class="horizontalLine">
			<div>
				<input type="text" class="inputText white" name="accName" placeholder="Наименование">
				<input type="text" class="inputText white" name="accQuan" placeholder="Количество">
			</div>
			<div>
				<select name="accView" class="inputText gray">
					<option value="0">Вид фурнитуры</option>
					<?php
						$sqlCateg = mysql_query("SELECT * FROM view");
						while($rowCateg = mysql_fetch_array($sqlCateg)){
							echo '<option value="'. $rowCateg["id"] .'">'.$rowCateg["name"].'</option>';
							//$categId = $rowCateg["id"];
						}
					?>
				</select>
				<select name="accProv" class="inputText gray">
					<option value="0">Поставщик</option>
					<?php
						$sqlAcc = mysql_query("SELECT * FROM provider");
						while($rowAcc = mysql_fetch_array($sqlAcc)){
							echo '<option value="'. $rowAcc["id"] .'">'. $rowAcc["name"] .'</option>';
							//$accId = $rowAcc["id"];
						}
					?>
				</select>
			</div>
			<input type="submit" name="accOk" value="Сохранить" class="btn btnMini white">
			<input type="submit" name="accEx" value="Выйти" class="btn btnMini white">
			<a href="Admin.php?_newViewFurnit" class="btn btnMini white">Добавить вид фурнитуры</a>
			<a href="Admin.php?_newProv" class="btn btnMini white">Добавить поставщика</a>
		</form>
	</div>
<!-- форма изменения товара -->
	<div id="panelUPGoods" class="panelAddGoods hide">
		<form method="post" class="formAddGoods">
			<h2>Редактировать фурнитуру:</h2>
			<hr class="horizontalLine">
			<div>
				<input type="text" class="hide" name="id_acc">
				<input type="text" class="inputText white" name="accName" placeholder="Наименование">
				<input type="text" class="inputText white" name="accQuan" placeholder="Количество">
			</div>
			<div>
				<select name="accView" class="inputText gray">
					<option value="0">Вид фурнитуры</option>
					<?php
						$sqlCateg = mysql_query("SELECT * FROM view");
						while($rowCateg = mysql_fetch_array($sqlCateg)){
							echo '<option value="'. $rowCateg["id"] .'">'.$rowCateg["name"].'</option>';
							//$categId = $rowCateg["id"];
						}
					?>
				</select>
				<select name="accProv" class="inputText gray">
					<option value="0">Поставщик</option>
					<?php
						$sqlAcc = mysql_query("SELECT * FROM provider");
						while($rowAcc = mysql_fetch_array($sqlAcc)){
							echo '<option value="'. $rowAcc["id"] .'">'. $rowAcc["name"] .'</option>';
							//$accId = $rowAcc["id"];
						}
					?>
				</select>
			</div>
			<input type="submit" name="accUpOk" value="Сохранить" class="btn btnMini white">
			<input type="submit" name="accUpEx" value="Выйти" class="btn btnMini white">
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

document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>');
	
$(function() {

			$('#panelAddGoods').hide();
			$('#panelAddGoods').removeClass('hide');
			$('#addNewGoods').click(function() {
				$('#panelAddGoods').delay( 100 ).fadeIn('slow');
			});

			$('#panelUPGoods').hide();
			$('#panelUPGoods').removeClass('hide');

			$('#footErrorNewGoods').hide();
			$('#footErrorNewGoods').removeClass('hide');


			$('#subNoAvtor').click(function() {
				$('#menuIndexAvtor').fadeOut('slow');
				$('#menuIndex').delay( 600 ).fadeIn('slow');
			});

			$('#btnRegIndex').click(function() {
				$('#menuIndex').fadeOut('slow');
				$('#menuIndexReg').delay( 100 ).fadeIn('slow');
			});

			$('#subNoReg').click(function() {
				$('#menuIndexReg').fadeOut('slow');
				$('#menuIndex').delay( 600 ).fadeIn('slow');
			});

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
			$('#upGoods').click(function() {
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
						$('input[name="id_acc"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(1)').html())

						$('input[name="accName"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(2)').html());
						$('input[name="accQuan"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(3)').html());
						$('select[name="accView"] option').each(function(){
							if($(this).html() == $('.hoverTR:eq('+place_checkbox+') td:eq(4)').html()){
								$(this).prop('selected',true)
							}
						});
						$('select[name="accProv"] option').each(function(){
							if($(this).html() == $('.hoverTR:eq('+place_checkbox+') td:eq(5)').html()){
								$(this).prop('selected',true)
							}
						});

						$('#panelUPGoods').delay( 100 ).fadeIn('slow');
					}else{
						//выделено больше одного для изменения
					}
				}
			});
	});
</script>