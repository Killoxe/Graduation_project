<?php
if(isset($_GET[idGoods])){
$query1 = mysql_query("SELECT * FROM goods WHERE id = ".$_GET[idGoods]."");
echo "<script>
		$('#catalogGoodsStore').hide();
		$('#panelFiltrMag').hide();
</script>";
while ($tovar = mysql_fetch_array($query1)){
	$goodCategory = mysql_fetch_assoc(mysql_query("SELECT * FROM category_goods WHERE id LIKE ".$tovar['id_category'].""));
	$goodAccess = mysql_fetch_assoc(mysql_query("SELECT * FROM accessories WHERE id LIKE ".$tovar['id_access'].""));
	$goodsDisigner = mysql_fetch_assoc(mysql_query("SELECT * FROM disigner WHERE id LIKE ".$tovar['id_disigner'].""));
	?>
	<!-- карточка товара -->
<center id="goodsCard" class="goodsCards">
<!-- фото товара -->
	<div class="goodsImg ">
		<?php echo "<img class='illumination' src=" .$tovar['img_goods']. " alt=''>"; ?>
		<!--div class="panelImgGoods">
		</div-->
	</div>
<!-- описание товара -->
	<div class="goodsDescriptionPanel white illumination">
		<?php echo "<h2>".$tovar['name']."</h2>"; ?>
		<hr class="horizontalLine">
		<div class="priseGood">
			Цена: <?php echo $tovar['value']; ?> руб.<br>
			В наличии: <?php echo $tovar['quantity']; ?> шт.
		</div>
		<div class="quantityGoods">
			<input type="number" class="inputText white" placeholder="Кол-во">
		</div>
		<div class="panelBtnGoods">
			<div class="btn btnMini">КУПИТЬ</div>
			<div class='btn btnMini cartGoods' id='cart-". $tovar['id'] ."'>В КОРЗИНУ</div>
			<?php
				if($tovar['model'] != ''){
					echo '<a target="_blank" href="'. $tovar['model'] .'" class="btn btnMini white">3D МОДЕЛЬ</a>';
				}
			?>
		</div>
		<hr class="horizontalLine">
		<h3>Характеристики</h3>
		<p class="pp">Категория: <?php echo $goodCategory['name']; ?>

			Дизайнер: <?php echo $goodsDisigner['surname'] ." ". $goodsDisigner['name'] ." ". $goodsDisigner['patron']; ?>

			Фурнитура: <?php echo $goodAccess['name']; ?>


			<?php echo $tovar['characterr']; ?>
		</p>
	</div>
<!-- панель с комментариями, габаритами товара и похожими товарами -->
	<div class="goodsComment illumination">
		<div class="menuComment gray">
			<div id="btnPanelOptions" class="btnPanelOptions btn">Описание</div>
			<div id="btnPanelComment" class="btnPanelComment btn">Комментарии</div>
			<div id="btnSimilar" class="btnSimilar btn">Похожие товары</div>
		</div>
<!-- комментарии -->
		<div class="panelComment white hide">
			<h2>Комментарии</h2>
			<hr class="horizontalLine">
			<?php
				$comment = mysql_query("SELECT * FROM review WHERE id_goods =  ".$tovar['id']."");
				while($row1 = mysql_fetch_array($comment))
					{
						$customer = mysql_fetch_assoc(mysql_query("SELECT * FROM customer WHERE id LIKE ".$row1['id_customer'].""));
						echo '<div class="comment">
							<div class="nameCus">
								'. $customer['surname'] ." ". $customer['name'] ." ". $customer['patron'] .'
							</div>
							<div class="rating">
								Оценка: '.$row1['rating'].'/5
							</div>
							<div class="review">
								Комментарий: '.$row1['review'].'
							</div>
						</div>';}
			?>
		</div>
<!-- описание -->
		<div class="panelOptionsGoods white">
			<h2>Описание товара</h2>
			<hr class="horizontalLine">
			<p>
				<?= $tovar['description']; ?>
			</p>
		</div>
<!-- похожее -->
		<div class="panelSimilarsGoods white hide">
			<h2>Похожие товара</h2>
			<hr class="horizontalLine">
		</div>
	</div>
</center>
<?php } } ?> 
<script>
		document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>');

			$('.panelSimilarsGoods, .panelComment').hide();
//открытие понели с комментариями
			$('.btnPanelComment').each(function(){
				$(this).on('click', function(){
					$('.panelOptionsGoods, .panelSimilarsGoods').fadeOut('slow');
					$('.panelComment').removeClass('hide').hide().delay( 600 ).fadeIn('slow');
				});
			});
//открытие понели с характеристиками товара
			$('.btnPanelOptions').each(function(){
				$(this).on('click', function(){
					$('.panelComment, .panelSimilarsGoods').fadeOut('slow');
					$('.panelOptionsGoods').removeClass('hide').hide().delay( 600 ).fadeIn('slow');
				});
			});
//открытие понели с похожими товарами
			$('.btnSimilar').each(function(){
				$(this).on('click', function(){
					$('.panelOptionsGoods, .panelComment').fadeOut('slow');
					$('.panelSimilarsGoods').removeClass('hide').hide().delay( 600 ).fadeIn('slow');
				});
			});

</script>
<script>
$('.cartGoods').each(function(){
	$(this).on('click', function(){
		var idd = $(this).attr('id');
		var id = idd.split('-');

		$.ajax({
	        type: "POST",
	        url: 'php/AddToCart.php',
	        data: "idTovar="+id[1],
	        success: function(data) {
	           alert('Товар успешно добавлен в корзину');
	        }
	    });
	});
});
</script>