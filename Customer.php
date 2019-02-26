<center class="white formNewGoods">
	<h2>Клиенты</h2>
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
			    <th>ФИО</th>
			    <th>Телефон</th>
			    <th>Почта</th>
			</tr>
			<?php
				//$q = mysql_query("SELECT * FROM customer WHERE name LIKE '%$query%' OR surname LIKE '%$query%' OR patron LIKE '%$query%' OR phone LIKE '%$query%' OR e_mail LIKE '%$query%'");

				include_once 'php/conn.php';
				$customerStat = mysql_query("SELECT * FROM customer");
				
				while($dateCust = mysql_fetch_assoc($customerStat))
				{
				    echo "<tr class='hoverTR' id='". $dateCust['id'] ."'>
							<td><input type='checkbox' name='check[]' class='cbSelect' value='" . $dateCust['id'] . "' id='cb-". $dateCust['id'] ."'></td>
							<td>" . $dateCust['id'] . "</td>
							<td>" . $dateCust['surname'] ." ". $dateCust['name'] ." ". $dateCust['patron'] . "</td>
							<td>" . $dateCust['phone'] ."</td>
							<td>" . $dateCust['e_mail'] . "</td>
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
<?php

function search ($query) 
{ 
    $query = trim($query); 
    $query = mysql_real_escape_string($query);
    $query = htmlspecialchars($query);

    if (!empty($query)) 
    { 
            $q = "SELECT *
                  FROM customer WHERE name LIKE '%$query%'
                  OR surname LIKE '%$query%' OR patron LIKE '%$query%'
                  OR phone LIKE '%$query%' OR e_mail LIKE '%$query%'";

            $result = mysql_query($q);

            if (mysql_affected_rows() > 0) { 
                $row = mysql_fetch_assoc($result); 
                $num = mysql_num_rows($result);

                $text = '<p>По запросу <b>'.$query.'</b> найдено совпадений: '.$num.'</p>';

                do {
                    // Делаем запрос, получающий ссылки на статьи
                    $q1 = "SELECT `link` FROM `table_name` WHERE `uniq_id` = '$row[page_id]'";
                    $result1 = mysql_query($q1);

                    if (mysql_affected_rows() > 0) {
                        $row1 = mysql_fetch_assoc($result1);
                    }

                    $text .= '<p><a> href="'.$row1['link'].'/'.$row['category'].'/'.$row['uniq_id'].'" title="'.$row['title_link'].'">'.$row['title'].'</a></p>
                    <p>'.$row['desc'].'</p>';

                } while ($row = mysql_fetch_assoc($result)); 
            } else {
                $text = '<p>По вашему запросу ничего не найдено.</p>';
            } 
    } else {
        $text = '<p>Задан пустой поисковый запрос.</p>';
    }

    return $text; 
} ?>