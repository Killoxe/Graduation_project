<!-- панель с фильтрами и сортировкой -->
<div id="panelFiltrMag" class="panelFiltrMag gray">
	<img src="img/008-interface.png" alt="" width="25" height="25">
		<div class="filtrBar">
			<form method="post">
				<div class="filtrBlok">
					Сортировать:
					<select class="inputText form-control black" name="sortirovat_po">
						<option value="0">По умолчанию</option>
						<option value="1">По цене</option>
						<option value="2">По новизне</option>
					</select>
					<ul class="prise">Цена
						<li>От: <input class="inputText black" type="text" name="cena_ot"></li>
						<li>До: <input class="inputText black" type="text" name="cena_do"></li>
					</ul>
					<ul class="checkBox">Цвет
						<li><input type="checkbox" id="checkClik" name="checkClik"><label for="checkClik"> Белый</label></li>
						<li><input type="checkbox" id="checkClik1" name="checkClik1"><label for="checkClik1"> Голубой</label></li>
						<li><input type="checkbox" id="checkClik2" name="checkClik2"><label for="checkClik2"> Желтый</label></li>
						<li><input type="checkbox" id="checkClik3" name="checkClik3"><label for="checkClik3"> Зеленый</label></li>
						<li><input type="checkbox" id="checkClik4" name="checkClik4"><label for="checkClik4"> Красный</label></li>
						<li><input type="checkbox" id="checkClik5" name="checkClik5"><label for="checkClik5"> Коричневый</label></li>
						<li><input type="checkbox" id="checkClik6" name="checkClik6"><label for="checkClik6"> Оранжевый</label></li>
						<li><input type="checkbox" id="checkClik7" name="checkClik7"><label for="checkClik7"> Розовый</label></li>
						<li><input type="checkbox" id="checkClik8" name="checkClik8"><label for="checkClik8"> Синий</label></li>
						<li><input type="checkbox" id="checkClik9" name="checkClik9"><label for="checkClik9"> Серый</label></li>
						<li><input type="checkbox" id="checkClik10" name="checkClik10"><label for="checkClik10"> Черный</label></li>
						<li><input type="checkbox" id="checkClik11" name="checkClik11"><label for="checkClik11"> Фиолетовый</label></li>
						<li><input type="checkbox" id="checkClik12" name="checkClik12"><label for="checkClik12"> Золотой</label></li>
						<li><input type="checkbox" id="checkClik13" name="checkClik13"><label for="checkClik13"> Серебрянный</label></li>
						<li><input type="checkbox" id="checkClik14" name="checkClik14"><label for="checkClik14"> Медный</label></li>
						<li><input type="checkbox" id="checkClik15" name="checkClik15"><label for="checkClik15"> Многоцветный</label></li>
					</ul>
					<ul class="checkBox">Материал
						<li><input type="checkbox" id="checkClik16" name="checkClik16"><label for="checkClik16"> Метал</label></li>
						<li><input type="checkbox" id="checkClik17" name="checkClik17"><label for="checkClik17"> Дерево</label></li>
						<li><input type="checkbox" id="checkClik18" name="checkClik18"><label for="checkClik18"> Стекло</label></li>
						<li><input type="checkbox" id="checkClik19" name="checkClik19"><label for="checkClik19"> Пластик</label></li>
						<li><input type="checkbox" id="checkClik20" name="checkClik20"><label for="checkClik20"> Ткань</label></li>
						<li><input type="checkbox" id="checkClik21" name="checkClik21"><label for="checkClik21"> Кожа</label></li>
						<li><input type="checkbox" id="checkClik22" name="checkClik22"><label for="checkClik22"> Бумага</label></li>
						<li><input type="checkbox" id="checkClik23" name="checkClik23"><label for="checkClik23"> Камень</label></li>
					</ul>
					<input type="submit" name=goFilter id="goFilter" value="Поиск" class="btn btnMini gray">
				</div>
			</form>
		</div>
</div>

<script type="text/javascript">
	
</script>
<?php
	/* запускаем фильтр ДОДЕЛАТЬ*/
	if(isset($_POST['goFilter'])){

		switch ($_POST['sortirovat_po']) {
			case 0:
				$sort = '';
				break;
			case 1;
				$sort = 'ORDER BY value';
				break;
			case 2;
				$sort = 'ORDER BY id DESC';
				break;
		}

		$filter_query = mysql_query("SELECT * FROM goods WHERE ".$sort);
		echo $filter_query;
	}
?>