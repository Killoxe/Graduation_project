<?php
	include_once 'php/conn.php';
	//добавление дизайнера
	$nameView = trim($_POST['nameView']);
	//добавление категории товара
	if(isset($_POST['viewAdd'])){
		//наименование
		if(strlen($nameView) == 0){
			$errorList[] = 'Вы не ввели наименование категории товара<br>';
		}else{
			$ok['name'] = true;
		}

		if($ok['name']){
			$sqlGoods = mysql_query("INSERT INTO view (name) 
				VALUES ('".$nameView."')");
			$errorList[] = 'Категория товара была успешно добавлен в базу данных<br>';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newViewFurnit" </script>';
		}else{
			$errorList[] = 'Ошибка: категория товара не добавлен в базу данных<br>';
		}
    }
//удаление категории товара
    if(isset($_POST['viewRem'])){
    	foreach($_POST['check'] as $id) {
    		mysql_query("DELETE FROM view WHERE id = '".$id."'"); 
    	}
    	print '<script type="text/javascript"> window.location.href = "Admin.php?_newViewFurnit" </script>';
    }
?>
<!-- таблица дизайнерами -->
<center class="white formNewGoods">
	<h2>Вид фурнитуры</h2>
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
				</tr>
				<?php
					include_once 'php/conn.php';
					$goodsCategTablAdmin = mysql_query("SELECT * FROM view");
					
					while($dateCateg = mysql_fetch_assoc($goodsCategTablAdmin))
					{
					    echo "<tr class='hoverTR' id='". $dateCateg['id'] ."'>
								<td><input type='checkbox' name='check[]' class='cbSelect' value='" . $dateCateg['id'] . "' id='cb-". $dateCateg['id'] ."'></td>
								<td>" . $dateCateg['id'] . "</td>
								<td>" . $dateCateg['name'] . "</td>
							</tr>";
					}
				?>
			</table>
			<div class="panelUpAdd">
				<h2>Добавить новый вид фурнитуры:</h2>
				<hr class="horizontalLine">
				<div><input type="text" class="inputText white" name="nameView" placeholder="Наименование вида"></div>
			</div>
		</div>
		<div class="btnNewGoods">
			<input type="submit" name="viewAdd" value="Добавить вид фурнитуры" id="removeNewGoods" class="btn btnMini white">
			<input type="submit" name="viewRem" value="Удалить вид фурнитуры" id="removeNewGoods" class="btn btnMini white">
		</div>
	</form>

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

	var place_checkbox = 0;
	// нажатие на нужный товар 
	$('.hoverTR').each(function(){
		$(this).on('click', function(){
			if(!$(this).hasClass('targetTR')) $(this).addClass('targetTR'); else $(this).removeClass('targetTR');
			if($('#cb-'+$(this).attr('id')).prop('checked') == false) $('#cb-'+$(this).attr('id')).prop('checked', true); else $('#cb-'+$(this).attr('id')).prop('checked', false);
			place_checkbox = $(this).index()-1;
		});
	});
});
</script>