<!-- каталог магазина -->
<center id="catalogGoodsStore" class="catalogGoodsStore hide">
<!-- вывод каталога товаров -->
<?php
	include_once 'php/conn.php';
	$category = mysql_query("SELECT * FROM category_goods");
	$idCateg = $category["id"];
//выводим товары при выборе категории
	if(isset($_GET[category])){
		$goodsIMG = mysql_query("SELECT * FROM goods WHERE id_category = ".$_GET[category]."");
		if (mysql_num_rows($goodsIMG) == 0) {
//если нет товаров по выбранной категории
			echo "<h2 class='white'>Каталог пуст</h2>";
		}else{
			while($roww = mysql_fetch_assoc($goodsIMG))
			{
			    echo "<div class='goodsCardsCatalog illumination'> 
			    		<img class='kartinka' src='" . $roww['img_goods'] . "' id='". $roww['id'] ."'/>
			    		<div class='panelDescription'>
					    	<div class='descriptionGood'>
					    		<span class='nameGoods'>". $roww['name'] ."</span><br>
					    		<span class='priseGoods'>". $roww['value'] ." руб.</span>
					    	</div>
					    	<div class='panelBuy'>
					    		<div class='buyGood'>Купить</div>
					    		<div class='cartsStore' id='cart-". $roww['id'] ."'>В корзину</div>
					    	</div>
					    </div>
			    	</div>";
			} 
		}
    }else{
//выводим товары без выбора категории
    	/* если создана s (search) */
		if(isset($_GET['search'])){
			/* запрос в ДИЗИГНЕРЫ */
			$disigneri_query = mysql_query("SELECT * FROM disigner WHERE name LIKE '%". $_GET[search] ."%' OR surname LIKE '%". $_GET[search] ."%' OR patron LIKE '%". $_GET[search] ."%'");
			/* проверка на наличие найденых ДИЗИГНЕРОВ, если есть ДИЗИГНЕРЫ, тогда запрос с ними, иначе без них */
			if(mysql_num_rows($disigneri_query) != 0){
				while($dis = mysql_fetch_assoc($disigneri_query)){
					$zapros = $zapros."SELECT * FROM goods WHERE name LIKE '%". $_GET[search] ."%' OR id_disigner IN (". $dis['id'];
				}
				$zapros = $zapros.")";
			}else{
				$zapros = "SELECT * FROM goods WHERE name LIKE '%". $_GET[search] ."%'";
			}

			$goodsIMG = mysql_query($zapros);
			/* проверка на наличие записей */
			if(mysql_num_rows($goodsIMG) != 0){
				while($roww = mysql_fetch_assoc($goodsIMG))
				{
				    echo "<div class='goodsCardsCatalog illumination'> 
				    		<img class='kartinka' src='" . $roww['img_goods'] . "' id='". $roww['id'] ."'/>
				    		<div class='panelDescription'>
						    	<div class='descriptionGood'>
						    		<span class='nameGoods'>". $roww['name'] ."</span><br>
						    		<span class='priseGoods'>". $roww['value'] ." руб.</span>
						    	</div>
						    	<div class='panelBuy'>
						    		<div class='buyGood'>Купить</div>
						    		<div class='cartsStore' id='cart-". $roww['id'] ."'>В корзину</div>
						    	</div>
						    </div>
				    	</div>";
				}	
			}else{
				echo '<h2 class="white">Ничего не найдено</h2>';
			}
		}

		if(isset($_GET[goods]) && $_GET[goods] == '3d'){
			$goodsIMG = mysql_query("SELECT * FROM goods WHERE model is NOT NULL");
			while($roww = mysql_fetch_assoc($goodsIMG))
			{
			    echo "<div class='goodsCardsCatalog illumination'> 
			    		<img class='kartinka' src='" . $roww['img_goods'] . "' id='". $roww['id'] ."'/>
			    		<div class='panelDescription'>
					    	<div class='descriptionGood'>
					    		<span class='nameGoods'>". $roww['name'] ."</span><br>
					    		<span class='priseGoods'>". $roww['value'] ." руб.</span>
					    	</div>
					    	<div class='panelBuy'>
					    		<div class='buyGood'>Купить</div>
					    		<div class='cartsStore' id='cart-". $roww['id'] ."'>В корзину</div>
					    	</div>
					    </div>
			    	</div>";
			}
		}

		if(isset($_GET[goods]) && $_GET[goods] == 'new'){
			$goodsIMG = mysql_query("SELECT * FROM goods ORDER BY id DESC");
			while($roww = mysql_fetch_assoc($goodsIMG))
			{
			    echo "<div class='goodsCardsCatalog illumination'> 
			    		<img class='kartinka' src='" . $roww['img_goods'] . "' id='". $roww['id'] ."'/>
			    		<div class='panelDescription'>
					    	<div class='descriptionGood'>
					    		<span class='nameGoods'>". $roww['name'] ."</span><br>
					    		<span class='priseGoods'>". $roww['value'] ." руб.</span>
					    	</div>
					    	<div class='panelBuy'>
					    		<div class='buyGood'>Купить</div>
					    		<div class='cartsStore' id='cart-". $roww['id'] ."'>В корзину</div>
					    	</div>
					    </div>
			    	</div>";
			}
		}
    }
?>
</center>
<!-- логика -->
<script>
//открытие карточки товара из каталога
$('.kartinka').each(function(){
	$(this).on('click', function(){
		window.location.replace("Mag.php?idGoods="+$(this).attr('id'));
		$('#goodsCard').removeClass('hide');
		$('#catalogGoodsStore').hide();
	});
});

$('.cartsStore').each(function(){
	$(this).on('click', function(){
		var idd = $(this).attr('id');
		var id = idd.split('-');

		$.ajax({
	        type: "POST",
	        url: 'php/AddToCart.php',
	        data: "idTovar="+id[1],
	        success: function(data) {
	           alert(data);
	        }
	    });
	});
});
</script>