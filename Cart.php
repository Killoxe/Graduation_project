<?php
	if(isset($_POST['delete_from_cart'])){
		mysql_query("DELETE FROM cart WHERE id = '". $_POST['hidden_id'] ."'");
	}

	if(!isset($_COOKIE[auth])){
		echo '<script> window.location.href = "index.php" </script>';
	}
?>
<!-- Корзина товаров -->
<center id="cartStore" class="white cartStore hide">
	<h2>Корзина</h2>
	<hr class="horizontalLine">
	<!-- <form name="table" method="POST"> -->
		<div class="cartTable table illumination">
			<table>
				<tr>
					<th></th>
					<th>Товар</th>
				    <th>Количество</th>
				    <th>Цена</th>
				    <th>Сумма</th>
				</tr>
				<?php
					include_once 'php/conn.php';
					$query_cart = mysql_query("SELECT * FROM cart WHERE id_customer = (SELECT id FROM customer WHERE e_mail LIKE '". $_COOKIE[e_mail]."')");
					
					while($cart = mysql_fetch_assoc($query_cart))
					{
						$goods = mysql_fetch_assoc(mysql_query("SELECT * FROM goods WHERE id = '". $cart['Id_goods'] ."'"));
					    echo '<form method="post"><tr class="hoverTR" id="'. $cart['id'] .'">
							<td><input type="hidden" name="hidden_id" value="'. $cart["id"] .'"><input type="submit" class="btn btnMini white cbSelect" name="delete_from_cart" value="Убрать"></td>
							<td><a href="Mag.php?idGoods='. $goods[id] .'">'. $goods[name] .'</a></td>
							<td><input type="number" class="inputText white quantityInput" placeholder="Кол-во" min="1" max="'.$goods['quantity'].'" id="qi-'. $cart['id'] .'"> Всего на складе: ('.$goods['quantity'].')</td>
							<td class="valueTovara" id="vt-'. $cart['id'] .'">'. $goods['value'] .'</td>
							<td class="summaOdnogoTovara" id="sot-'. $cart['id'] .'">'. $goods['value'] .'</td>
						</tr></form>';
					}
				?>
			</table>
		</div>
		<div>Итог к оплате: <span class="itogOplati">0</span></div>
		<div class="white btnOrder">
			<a href="Mag.php?_order" id="upGoods" class="btn btnMini white">Оформить заказ</a>
		</div>
	<!-- </form>
 -->
</center>
<!-- логика -->
<script>
	$(document).ready(function(){
		$('.quantityInput').each(function(){
			var idd = $(this).attr('id');
			var id_cart = idd.split('-');

			/* запрос в бд и занос в инпут кол-ва товара */
			$.ajax({
				type: "POST",
				url: 'php/CountTovarInInput.php',
				data: 'idTovar='+id_cart[1],
				success: function(data){
					$('#qi-'+id_cart[1]).val(data);
					$('#sot-'+id_cart[1]).html($('#vt-'+id_cart[1]).html()*$('#qi-'+id_cart[1]).val());
				}
			});

			$(this).on('change', function(){
				/* изменение итога к оплате при изменении кол-ва */
				 /* НАДО ДОДЕЛАТЬ */
				// var cnt;
				// $.ajax({
				// 	type: 'post',
				// 	url: 'php/CountTovarInInput.php',
				// 	data: 'idTovar='+id_cart[1],
				// 	success: function(data){
				// 		console.log(data);
				// 	}
				// });

				// if(cnt < $(this).val()){
				// 	$('.itogOplati').html( parseInt($('.itogOplati').html()) - ($('#vt-'+id_cart[1]).html() * $('#qi-'+id_cart[1]).val()));
				// }else{
				// 	$('.itogOplati').html( parseInt($('.itogOplati').html()) + ($('#vt-'+id_cart[1]).html() * $('#qi-'+id_cart[1]).val()));
				// }

				$('.itogOplati').html( parseInt($('.itogOplati').html()) + ($('#vt-'+id_cart[1]).html() * $('#qi-'+id_cart[1]).val()));

				/* сумма одного товара */
				$('#sot-'+id_cart[1]).html($('#vt-'+id_cart[1]).html()*$('#qi-'+id_cart[1]).val());

				/* запрос в бд на изменение кол-ва товара (одного) */
				$.ajax({
			        type: "POST",
			        url: 'php/incTovar.php',
			        data: "idTovar="+id_cart[1]+"&quantity="+$('#qi-'+id_cart[1]).val(),
			        success: function(data) {}
			    });
			});

			/* итого к оплате */
			setTimeout(function(){
				$('.itogOplati').html( parseInt($('.itogOplati').html()) + ($('#vt-'+id_cart[1]).html() * $('#qi-'+id_cart[1]).val()));
			},1000);
		});
	});
</script>