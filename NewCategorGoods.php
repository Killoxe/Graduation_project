<?php
	include_once 'php/conn.php';
//добавление категории товара
	$nameCateg = trim($_POST['nameCateg']);
	if(isset($_POST['categGoodsAdd'])){
//наименование
		if(strlen($nameCateg) == 0){
			$errorList[] = '<br>Вы не ввели наименование категории товара';
		}else{
			$ok['nameCateg'] = true;
		}

		if($ok['nameCateg']){
			$sqlGoods = mysql_query("INSERT INTO category_goods (name) 
				VALUES ('".$nameCateg."')");
			$errorList[] = 'Категория товара была успешно добавлен в базу данных<br>';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newCateg" </script>';
		}else{
			$errorList[] = 'Ошибка: категория товара не добавлен в базу данных<br>';
		}
    }
//удаление категории товара
    if(isset($_POST['categGoodsRem'])){
    	foreach($_POST['check'] as $id) {
    		mysql_query("DELETE FROM category_goods WHERE id = '".$id."'"); 
    	}
    	print '<script type="text/javascript"> window.location.href = "Admin.php?_newCateg" </script>';
    }
?>
<!-- таблица категорий товара -->
<center class="white formNewGoods">
	<h2>Категории товаров</h2>
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
<!-- таблица категорий товара -->
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
					$goodsCategTablAdmin = mysql_query("SELECT * FROM category_goods");
					
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
				<h2>Добавить категорию товара:</h2>
				<hr class="horizontalLine">
				<div><input type="text" class="inputText white" name="nameCateg" placeholder="Наименование"></div>
			</div>
		</div>
		<div class="btnNewGoods">
			<input type="submit" name="categGoodsAdd" value="Добавить категорию товара" id="removeNewGoods" class="btn btnMini white">
			<input type="submit" name="categGoodsRem" value="Удалить категорию товара" id="removeNewGoods" class="btn btnMini white">
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