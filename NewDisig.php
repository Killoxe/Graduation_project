<?php
	include_once 'php/conn.php';
//добавление дизайнера
	$nameDis = trim($_POST['disName']);
	$surnameDis = trim($_POST['disSurname']);
	$patronDis = trim($_POST['disPatron']);
	if(isset($_POST['disAdd'])){
//фамилия
		if(strlen($surnameDis) == 0){
			$errorList[] = '<br>Вы не ввели фамилию дизайнера';
		}else{
			$ok['surnameDis'] = true;
		}
//имя
		if(strlen($nameDis) == 0){
			$errorList[] = 'Вы не ввели имя дизайнера';
		}else{
			$ok['nameDis'] = true;
		}
//отчество
		if(strlen($patronDis) == 0){
			$errorList[] = 'Вы не ввели отчество дизайнера';
		}else{
			$ok['patronDis'] = true;
		}
//добавление
		if($ok['surnameDis'] && $ok['nameDis'] && $ok['patronDis']){
			$sqlGoods = mysql_query("INSERT INTO disigner (surname, name, patron) 
				VALUES ('".$surnameDis."','".$nameDis."','".$patronDis."')");
			$errorList[] = 'Дизайнер был успешно добавлен в базу данных<br>';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newDisig" </script>';
		}else{
			$errorList[] = 'Ошибка: дизайнер не добавлен в базу данных<br>';
		}
    }
//удаление
    if(isset($_POST['disRem'])){
    	foreach($_POST['check'] as $id) {
    		mysql_query("DELETE FROM disigner WHERE id = '".$id."'"); 
    	}
    	print '<script type="text/javascript"> window.location.href = "Admin.php?_newDisig" </script>';
    }
?>
<!-- таблица дизайнеров -->
<center class="white formNewGoods">
	<h2>Дизайнеры</h2>
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
<!-- таблица дизайнеров -->
	<form name="table" method="POST">
		<div class="newStatTable newGoodsTable table illumination">
			<table>
				<tr>
					<th></th>
				    <th>№</th>
				    <th>ФИО</th>
				</tr>
				<?php
					include_once 'php/conn.php';
					$disTablAdmin = mysql_query("SELECT * FROM disigner");
					
					while($dateDisig = mysql_fetch_assoc($disTablAdmin))
					{
					    echo "<tr class='hoverTR' id='". $dateDisig['id'] ."'>
								<td><input type='checkbox' name='check[]' class='cbSelect' value='" . $dateDisig['id'] . "' id='cb-". $dateDisig['id'] ."'></td>
								<td>" . $dateDisig['id'] . "</td>
								<td>" . $dateDisig['surname'] . " " . $dateDisig['name'] . " " . $dateDisig['patron'] . "</td>
							</tr>";
					}
				?>
			</table>
			<div class="panelUpAdd">
				<h2>Добавить новнового дизайнера:</h2>
				<hr class="horizontalLine">
				<div><input type="text" class="inputText white" name="disSurname" placeholder="Фамилия"></div>
				<div><input type="text" class="inputText white" name="disName" placeholder="Имя"></div>
				<div><input type="text" class="inputText white" name="disPatron" placeholder="Отчество"></div>
			</div>
		</div>
		<div class="btnNewGoods">
			<input type="submit" name="disAdd" value="Добавить дизайнера" id="removeNewGoods" class="btn btnMini white">
			<input type="submit" name="disRem" value="Удалить дизайнера" id="removeNewGoods" class="btn btnMini white">
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
	// нажатие на нужного дизайнера
	$('.hoverTR').each(function(){
		$(this).on('click', function(){
			if(!$(this).hasClass('targetTR')) $(this).addClass('targetTR'); else $(this).removeClass('targetTR');
			if($('#cb-'+$(this).attr('id')).prop('checked') == false) $('#cb-'+$(this).attr('id')).prop('checked', true); else $('#cb-'+$(this).attr('id')).prop('checked', false);
			place_checkbox = $(this).index()-1;
		});
	});
});
</script>
