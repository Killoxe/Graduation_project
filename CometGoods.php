<center class="white formNewGoods">
	<h2>Коментарии к товарам</h2>
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
	<div class="newGoodsTable table illumination">
		<table>
			<tr>
				<th></th>
			    <th>№</th>
			    <th>Пользователь</th>
			    <th>Товар</th>
			    <th>Отзыв</th>
			    <th>Оценка</th>
			</tr>
			<?php
				include_once 'php/conn.php';
				$statTablAdmin = mysql_query("SELECT * FROM review");
				
				while($dateStat = mysql_fetch_assoc($statTablAdmin))
				{
					$customerStat = mysql_fetch_assoc(mysql_query("SELECT * FROM customer WHERE id LIKE ".$dateStat['id_customer'].""));
					$associateGoods = mysql_fetch_assoc(mysql_query("SELECT * FROM goods WHERE id LIKE ".$dateStat['id_goods'].""));
				    echo "<tr class='hoverTR' id='". $dateStat['id'] ."'>
							<td><input type='checkbox' name='check[]' class='cbSelect' value='" . $dateStat['id'] . "' id='cb-". $dateStat['id'] ."'></td>
							<td>" . $dateStat['id'] . "</td>
							<td>" . $customerStat['surname'] ." ". $customerStat['name'] ." ". $customerStat['patron'] . "</td>
							<td>" . $associateGoods['name'] ."</td>
							<td>" . $dateStat['review'] . "</td>
							<td>" . $dateStat['rating'] . "</td>
						</tr>";
				}
			?>
		</table>
	</div>
</center>
<!-- логика -->
<script type="text/javascript">
$(function() {
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