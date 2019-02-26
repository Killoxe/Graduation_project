<!-- таблица с товарами -->
<center class="white formNewGoods">
	<h2>Товары</h2>
	<hr class="horizontalLine">
<!-- поиск -->
	<div class="searchBarMag">
		<form method="post">
			<input class="search" name="search" type="text" placeholder="Поиск...">
			<button class="goSearch" name="goSearch" type="submit">
				<img src="img/012-magnifying-glass.png" title="Поиск">
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
				    <th>Название</th>
				    <th>Кол-во</th>
				    <th>Стоимость в руб.</th>
				    <th>Цвет</th>
				    <th>Материал</th>
				    <th>Фотография</th>
				    <th>3D модель</th>
				    <th>Категория</th>
				    <th>Фурнитура</th>
				    <th>Дизайнер</th>
				    <th class='description'>Описание</th>
				    <th class='description'>Характеристики</th>
				</tr>
				<?php
					include_once 'php/conn.php';

					/* запрос поиска */
					if(isset($_POST[goSearch])){
						$goodsTablAdmin = mysql_query("SELECT * FROM goods WHERE name LIKE '%". $_POST[search] ."%' OR color LIKE '%". $_POST[search] ."%' OR material LIKE '%". $_POST[search] ."%' OR value LIKE '%". $_POST[search] ."%'");
					}else{
						$goodsTablAdmin = mysql_query("SELECT * FROM goods");
					}
					
					
					while($dateGoods = mysql_fetch_assoc($goodsTablAdmin))
					{
						$goodCategory = mysql_fetch_assoc(mysql_query("SELECT * FROM category_goods WHERE id LIKE ".$dateGoods['id_category'].""));
						$goodAccess = mysql_fetch_assoc(mysql_query("SELECT * FROM accessories WHERE id LIKE ".$dateGoods['id_access'].""));
						$goodsDisigner = mysql_fetch_assoc(mysql_query("SELECT * FROM disigner WHERE id LIKE ".$dateGoods['id_disigner'].""));
					    echo "<tr class='hoverTR' id='". $dateGoods['id'] ."'>
								<td><input type='checkbox' name='check[]' class='cbSelect' value='" . $dateGoods['id'] . "' id='cb-". $dateGoods['id'] ."'></td>
								<td>" . $dateGoods['id'] . "</td>
								<td>" . $dateGoods['name'] . "</td>
								<td>" . $dateGoods['quantity'] . "</td>
								<td>" . $dateGoods['value'] . "</td>
								<td>" . $dateGoods['color'] . "</td>
								<td>" . $dateGoods['material'] . "</td>
								<td>" . $dateGoods['img_goods'] . "</td>
								<td>" . $dateGoods['model'] . "</td>
								<td>" . $goodCategory['name'] . "</td>
								<td>" . $goodAccess['name'] . "</td>
								<td>" . $goodsDisigner['surname'] ." ". $goodsDisigner['name'] ." ". $goodsDisigner['patron'] . "</td>
								<td class='character'>" . $dateGoods['description'] . "</td>
								<td class='character'>" . $dateGoods['characterr'] . "</td>
							</tr>";
					}
				?>
			</table>
		</div>
		<div class="btnNewGoods">
			<div id="addNewGoods" class="addNewGoods btn btnMini">Добавить товар</div>
			<div id="upGoods" class="addNewGoods btn btnMini">Изменить товар</div>
			<input type="submit" name="goodsRem" value="Удалить товар" id="removeNewGoods" class="btn btnMini white">
		</div>
	</form>
<!-- форма добавления товара -->
	<div id="panelAddGoods" class="panelAddGoods hide">
		<form method="post" class="formAddGoods" enctype="multipart/form-data">
			<h2>Добавить новый товар:</h2>
			<hr class="horizontalLine">
			<div>
				<input type="text" class="inputText white" name="goodsName" placeholder="Название">
				<input type="text" class="inputText white" name="goodsPriсe" placeholder="Цена, руб">
				<input type="text" class="inputText white" name="goodQuan" placeholder="Количество, шт">
				<input type="text" class="inputText white" name="goodsColor" placeholder="Цвет">
				<input type="text" class="inputText white" name="goodsMaterial" placeholder="Материал">
			</div>
			<div>
				<select name="goodsCateg" class="inputText white">
					<option value="0">Категория</option>
					<?php
						$sqlCateg = mysql_query("SELECT * FROM category_goods");
						while($rowCateg = mysql_fetch_array($sqlCateg)){
							echo '<option value="'. $rowCateg["id"] .'">'.$rowCateg["name"].'</option>';
							//$categId = $rowCateg["id"];
						}
					?>
				</select>
				<select name="goodsAcc" class="inputText white">
					<option value="0">Фурнитура</option>
					<?php
						$sqlAcc = mysql_query("SELECT * FROM accessories");
						while($rowAcc = mysql_fetch_array($sqlAcc)){
							echo '<option value="'. $rowAcc["id"] .'">'. $rowAcc["name"] .'</option>';
							//$accId = $rowAcc["id"];
						}

					?>
				</select>
				<select name="goodsDdisig" class="inputText white">
					<option value="0">Дизайнер</option>
					<?php 
						$sqlDisig = mysql_query("SELECT * FROM disigner");
						while($rowDisig = mysql_fetch_array($sqlDisig)){
							echo '<option value="'. $rowDisig["id"] .'">'. $rowDisig["surname"] .' '. $rowDisig["name"] .' '. $rowDisig["patron"] .'</option>';
							//$disigId = $rowDisig["id"];
						}
					?>
				</select>
			</div>
			<div>
				Фотография: <input type="file" class="inputText white" class="formFoto" multiple="8" name="photo_tovar">
				3D модель: <input type="file" class="inputText white" class="formFoto" multiple="8" name="photo_model" accept=".html">
			</div>
			<div>
				<textarea name="goodsDescription" class="inputText white" placeholder="Характеристики"></textarea>
				<textarea name="goodsCharacter" class="inputText white" placeholder="Описание"></textarea>
			</div>
			<input type="submit" name="goodsOk" value="Сохранить" class="btn btnMini white">
			<input type="submit" name="goodsEx" value="Выйти" class="btn btnMini white">
			<a href="Admin.php?_newDisig" class="btn btnMini white">Добавить дизайнера</a>
			<a href="Admin.php?_newCateg" class="btn btnMini white">Добавить категорию</a>
			<a href="Admin.php?_newFurnit" class="btn btnMini white">Добавить фурнитуру</a>
		</form>
	</div>
<!-- форма изменения товара -->
	<div id="panelUPGoods" class="panelAddGoods hide">
		<form method="post" class="formAddGoods">
			<h2>Редактировать товар:</h2>
			<hr class="horizontalLine">
			<div>
				<input type="text" class="hide" name="id_tovar">
				<input type="text" class="inputText white" name="goodsNameUp" placeholder="Название">
				<input type="text" class="inputText white" name="goodsPriсeUp" placeholder="Цена, руб">
				<input type="text" class="inputText white" name="goodQuanUp" placeholder="Количество, шт">
				<input type="text" class="inputText white" name="goodsColorUp" placeholder="Цвет">
				<input type="text" class="inputText white" name="goodsMaterialUp" placeholder="Материал">
			</div>
			<div>
				<select name="goodsCateg" class="inputText white">
					<option value="0">Категория</option>
					<?php
						$sqlCateg = mysql_query("SELECT * FROM category_goods");
						while($rowCateg = mysql_fetch_array($sqlCateg)){
							echo '<option value="'. $rowCateg["id"] .'">'.$rowCateg["name"].'</option>';
							//$categId = $rowCateg["id"];
						}
					?>
				</select>
				<select name="goodsAcc" class="inputText white">
					<option value="0">Фурнитура</option>
					<?php
						$sqlAcc = mysql_query("SELECT * FROM accessories");
						while($rowAcc = mysql_fetch_array($sqlAcc)){
							echo '<option value="'. $rowAcc["id"] .'">'. $rowAcc["name"] .'</option>';
							$accIdUp = $rowAcc["id"];
						}

					?>
				</select>
				<select name="goodsDdisig" class="inputText white">
					<option value="0">Дизайнер</option>
					<?php 
						$sqlDisig = mysql_query("SELECT * FROM disigner");
						while($rowDisig = mysql_fetch_array($sqlDisig)){
							echo '<option value="'. $rowDisig["id"] .'">'. $rowDisig["surname"] .' '. $rowDisig["name"] .' '. $rowDisig["patron"] .'</option>';
							$disigId = $rowDisig["id"];
						}
					?>
				</select>
			</div>
			<div>
				<textarea name="goodsDescriptionUp" class="inputText white" placeholder="Характеристики"></textarea>
				<textarea name="goodsCharacterUp" class="inputText white" placeholder="Описание"></textarea>
			</div>
			<input type="submit" name="goodsUpOk" value="Сохранить" class="btn btnMini white">
			<input type="submit" name="goodsUpEx" value="Выйти" class="btn btnMini white">
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
						$('input[name="id_tovar"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(1)').html())

						$('input[name="goodsNameUp"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(2)').html());
						$('input[name="goodsPriсeUp"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(4)').html());
						$('input[name="goodQuanUp"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(3)').html());
						$('input[name="goodsColorUp"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(5)').html());
						$('input[name="goodsMaterialUp"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(6)').html());
						$('select[name="goodsCateg"] option').each(function(){
							if($(this).html() == $('.hoverTR:eq('+place_checkbox+') td:eq(9)').html()){
								$(this).prop('selected',true)
							}
						});
						$('select[name="goodsAcc"] option').each(function(){
							if($(this).html() == $('.hoverTR:eq('+place_checkbox+') td:eq(10)').html()){
								$(this).prop('selected',true)
							}
						});
						$('select[name="goodsDdisig"] option').each(function(){
							if($(this).html() == $('.hoverTR:eq('+place_checkbox+') td:eq(11)').html()){
								$(this).prop('selected',true)
							}
						});

						$('textarea[name="goodsDescriptionUp"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(13)').html());
						$('textarea[name="goodsCharacterUp"]').val($('.hoverTR:eq('+place_checkbox+') td:eq(12)').html());

						$('#panelUPGoods').delay( 100 ).fadeIn('slow');
					}else{
//выделено больше одного для изменения
					}
				}
			});
	});
</script>
<?php
	include_once 'php/conn.php';
	include_once 'php/AddRemUpGoods.php';
?>