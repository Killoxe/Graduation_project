<!-- панель с фильтрами и сортировкой -->
<div id="panelFiltrMag" class="panelFiltrMag gray">
	<img src="img/008-interface.png" alt="" width="25" height="25">
		<div class="filtrBar">
			<form method="post">
				<div class="filtrBlok">
					Сортировать:
					<select class="inputText form-control black" id="sortirovat_po" name="sortirovat_po">
						<option value="0">По умолчанию</option>
						<option value="1">По цене</option>
						<option value="2">По новизне</option>
					</select>
					<ul class="prise">Цена
						<li>От: <input class="inputText black" type="text" id="cena_ot" name="cena_ot"></li>
						<li>До: <input class="inputText black" type="text" id="cena_do" name="cena_do"></li>
					</ul>
					<ul class="checkBox">Цвет
						<li><input type="checkbox" id="checkClik0" name="checkClik0"><label for="checkClik0"> Белый</label></li>
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
	/* запускаем фильтр */
	if(isset($_POST[goFilter])){
		$where = false;
		$check = false;
		$onlyone = true;

		$check2 = false;
		$onlyone2 = true;

		/* очищаем все товары */
		echo '<script> $(".catalogGoodsStore").html(""); </script>';
		$text_query = "SELECT * FROM goods";

		/* цена от и до */
		if($_POST[cena_ot] != '' && $_POST[cena_do] != ''){
			$text_query = $text_query.' WHERE value BETWEEN '. $_POST[cena_ot] .' AND '. $_POST[cena_do];
			?><script>
				var cena_ot = '<?= $_POST[cena_ot] ?>';
				var cena_do = '<?= $_POST[cena_do] ?>';
			</script><?php
			$where = true;
			echo '<script> $("#cena_ot").val(cena_ot); $("#cena_do").val(cena_do); </script>';
		}else{
			if($_POST[cena_ot] != ''){
				$text_query = $text_query.' WHERE value >= '.$_POST[cena_ot];
				?><script>
					var cena_ot = '<?= $_POST[cena_ot] ?>';
				</script><?php
				$where = true;
				echo '<script> $("#cena_ot").val(cena_ot); </script>';
			}else{
				if($_POST[cena_do] != ''){
					$text_query = $text_query.' WHERE value <='.$_POST[cena_do];
					?><script>
						var cena_do = '<?= $_POST[cena_do] ?>';
					</script><?php
					$where = true;
					echo '<script> $("#cena_do").val(cena_do); </script>';
				}
			}
		}		
		
		/* фильтр по цвету */
		$colors = ['белый', 'болубой', 'белтый', 'зеленый', 'красный', 'коричневый', 'оранжевый', 'розовый', 'синий', 'серый', 'черный', 'фиолетовый', 'золотой', 'серебрянный', 'медный', 'многоцветный'];
		for($i = 0; $i < count($colors); $i++){
			/* выделен ли чекбокс */
			if($_POST[checkClik.$i] == 'on'){
				/* есть ли в запросе уже вэр */
				if(!$where){
					/* один раз всего */
					if($onlyone){
						$text_query = $text_query.' WHERE color IN ('; // если нет вэра
						$where = true;
						$onlyone = false;
					}
				}else{
					/* один раз всего */
					if($onlyone){
						$text_query = $text_query.' AND color IN ('; //если есть
						$onlyone = false;
					}
				}
				
				$text_query = $text_query.'\''.$colors[$i].'\', '; //изменяем квери

				?><script>
					var id_checked = '<?= $i ?>';
				</script><?php
				echo '<script> $("#checkClik"+id_checked).attr("checked", true); </script>'; //выделяем чекбокс
				$check = true;
			}
			/* если последний $i то закрываем */
			if($i == count($colors)-1 && $check == true){
				$text_query = substr($text_query, 0, -2); // удаление последней запятой
				$text_query = $text_query.')'; 
			}
		}



		/* фильтр по материалу */
		$materials = ['Метал', 'Дерево', 'Стекло', 'Пластик', 'Ткань', 'Кожа', 'Бумага', 'Камень'];
		for($i = 16; $i < count($materials)+16; $i++){
			/* выделен ли чекбокс */
			if($_POST[checkClik.$i] == 'on'){
				/* есть ли в запросе уже вэр */
				if(!$where){
					/* один раз всего */
					if($onlyone2){
						$text_query = $text_query.' WHERE material IN ('; // если нет вэра
						$where = true;
						$onlyone2 = false;
					}
				}else{
					/* один раз всего */
					if($onlyone2){
						$text_query = $text_query.' AND material IN ('; //если есть
						$onlyone2 = false;
					}
				}
				
				$text_query = $text_query.'\''.$materials[$i-16].'\', '; //изменяем квери

				?><script>
					var id_checked = '<?= $i ?>';
				</script><?php
				echo '<script> $("#checkClik"+id_checked).attr("checked", true); </script>'; //выделяем чекбокс
				$check2 = true;
			}
			/* если последний $i то закрываем */
			if($i-15 == count($materials) && $check2 == true){
				$text_query = substr($text_query, 0, -2); // удаление последней запятой
				$text_query = $text_query.')'; 
			}
		}



		/* сортровка по */
		switch ($_POST[sortirovat_po]) {
			case 0:
				echo '<script> $("#sortirovat_po option:eq(0)").prop("selected", true); </script>';
				break;
			case 1;
				$text_query = $text_query.' ORDER BY value';
				echo '<script> $("#sortirovat_po option:eq(1)").prop("selected", true); </script>';
				break;
			case 2;
				$text_query = $text_query.' ORDER BY id DESC';
				echo '<script> $("#sortirovat_po option:eq(2)").prop("selected", true); </script>';
				break;
		}

		/* конечный запрос */
		//echo $text_query;
		$filter_query = mysql_query($text_query);
		

		/* вывод */
		while($filter = mysql_fetch_assoc($filter_query)){
			?><script type="text/javascript">
				var id_from_filter = '<?= $filter[id] ?>';
				var img = '<?= $filter[img_goods] ?>';
				var name = '<?= $filter[name] ?>';
				var value = '<?= $filter[value] ?>';
			    
			    $("#catalogGoodsStore").html( $("#catalogGoodsStore").html() + '<div class="goodsCardsCatalog illumination"> <img class="kartinka" src="'+img+'" id="'+id_from_filter+'"/> <div class="panelDescription"> <div class="descriptionGood"> <span class="nameGoods">'+name+'</span><br> <span class="priseGoods">'+value+' руб.</span> </div> <div class="panelBuy"> <div class="buyGood">Купить</div> <div class="cartsStore" id="cart-'+id_from_filter+'">В корзину</div> </div> </div> </div> ');
			</script><?php
		}

		/* а если 0 записей */
		if(mysql_num_rows($filter_query) == 0){
			echo '<script> $("#catalogGoodsStore").html("<h2 class="white">По вашему фильтру ничего не найдено</h2>")</script>';
		}
	}
?>
<script>
//открытие карточки товара из каталога
$('.kartinka').each(function(){
	$(this).on('click', function(){
		window.location.replace("Mag.php?idGoods="+$(this).attr('id'));
		$('#goodsCard').removeClass('hide');
		$('#catalogGoodsStore').hide();
	});
});
</script>