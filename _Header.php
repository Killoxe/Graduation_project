<?php
	session_start();
?>
<center class="header gray">
<!-- кнопки для регистрации, авторизации, лич кабинета, корзины и выхода -->
	<ul class="panelCos">
		<form method="get">
			<li class="roReg">
				<a href="javascript:void(0);"><img src="img/006-file.png" title="Регистрация" id="btnRegIndex"></a>
			</li>
			<li class="roAvtor">
				<a href="javascript:void(0);"><img src="img/008-key.png" title="Авторизация" id="btnAvtorIndex"></a>
			</li>
			<li class="roUser">
				<a href="Mag.php?_room"><img src="img/020-user.png" title="Личный кабинет"></a>
			</li>
			<li class="">
				<a href="Mag.php?_cart"><img src="img/010-shopping-cart.png" title="Корзина"></a>
			</li>
			<li class="roExit">
				<a href="Mag.php?_close"><img src="img/006-close.png" title="Выйти"></a>
			</li>
		</form>
	</ul>
	<h1><a href="Mag.php" class="logo">EMPHAS<span class="yellowI">I</span>S</a></h1>
<!-- меню магазина -->
	<nav class="headerMagMenu">
		<ul class="panelMenu1">
			<li><a href="javascript:void(0)"><img src="img/012-bars.png" title="Меню" class="hide"><span class="textMenuMag">МЕНЮ</span>
<!-- выплывающее меню с категорией товаров и поискоим  -->
			<div class="subMenu">
<!-- дублированное меню для адаптации -->
				<ul class="hideMenuMag hide">
					<li><a href="Mag.php?goods=new">НОВОЕ</a></li>
					<li><a href="Mag.php?goods=pop">ПОПУЛЯРНОЕ</a></li>
					<li><a href="Mag.php?goods=3d">3D МОДЕЛИ</a></li>
					<li><a href="Mag.php?_aboutUs">О НАС</a></li>
					<li><a href="Mag.php?_disigner">ДИЗАЙНЕРЫ</a></li>
					<li><a href="Mag.php?_provider">ПОСТАВЩИКИ</a></li>
					<li><a href="Mag.php?_help">ПОМОЩЬ</a></li>
				</ul>
<!-- поиск -->
				<div class="searchBarMag">
					<form>
						<input class="search" name="search" type="text" placeholder="Поиск..." AUTOCOMPLETE="off">
						<button class="goSearch">
							<img src="img/012-magnifying-glass.png" title="Поиск">
						</button>
					</form>
				</div>
<!-- вод категорий товара -->
				<ul class="catalog">
					<?php
						$category = mysql_query("SELECT * FROM category_goods");
						while($row1 = mysql_fetch_array($category)){echo '<li><a href="Mag.php?category='.$row1["id"].'">'.$row1["name"].'</a></li>';}
					?>
				</ul>
			</div>
<!-- меню -->
			</a></li>
			<li><a href="Mag.php?goods=new">НОВОЕ</a></li>
			<li><a href="Mag.php?goods=pop">ПОПУЛЯРНОЕ</a></li>
			<li><a href="Mag.php?goods=3d">3D МОДЕЛИ</a></li>
		</ul>
		<ul class="panelMenu2">
			<li><a href="Mag.php?_aboutUs">О НАС</a></li>
			<li><a href="Mag.php?_disigner">ДИЗАЙНЕРЫ</a></li>
			<li><a href="Mag.php?_provider">ПОСТАВЩИКИ</a></li>
			<li><a href="Mag.php?_help">ПОМОЩЬ</a></li>
		</ul>
	</nav>
<!-- блок авторизации -->
		<center id="menuIndexAvtor" class="hide">
			<div class="logo white">
				<h1>АВТОРИЗАЦ<span class="yellowI">И</span>Я</h1>
			</div>
			<hr class="horizontalLine">
			<div class="blockAvtorIndex">
				<form method="post">
					<input class="inputText white" type="email" name="avtorEmail" placeholder="E-mail">
					<input class="inputText white" type="password" name="avtorPass" placeholder="Пароль">
					<input type="submit" name="sub-ok-av" id="sub-ok-av" value="Далее" class="btn btnMini white">
					<a href="javascript:void(0);" class="white focusBtn btn btnMini" id="subNoAvtor">Назад</a>
				</form>
			</div>
		</center>
<!-- блок регистации -->
		<center id="menuIndexReg" class="hide">
			<div class="logo white">
				<h1>РЕГИСТРАЦ<span class="yellowI">И</span>Я</h1>
			</div>
			<hr class="horizontalLine">
			<div class="blockRegIndex">
				<form method="post">
					<input class="inputText white" name="regEmail" type="email" placeholder="E-mail">
					<input class="inputText white" name="regPass" type="password" placeholder="Пароль">
					<input class="inputText white" name="regDublPass" type="password" placeholder="Повотите пароль">
					<input type="submit" name="sub-ok-reg" id="sub-ok-reg" value="Далее" class="btn btnMini white">
					<a href="javascript:void(0);" class="white focusBtn btn btnMini" id="subNoReg">Назад</a>
				</form>
			</div>
		</center>
<!-- лист с ошибками -->
		<div id="footError" class="footError white hide">
			<form class="listError" method="post">
				<?php
					/* вывод ошибок */
					include_once 'php/AddRemUpGoods.php';
					$i = 0;
					foreach ($errorList as $err){
						$i++;
						echo $err.'<br>';
					}
					if($i != 0){
						echo "<script type='text/javascript'>
						$('#footError').delay( 1000 ).fadeIn('slow').delay( 4000 ).fadeOut('slow');
						</script>";
					}
				?>
			</form>
		</div>
</center>
<!-- логика -->
<script>
	document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>');

		$('#menuIndexAvtor, #menuIndexReg, #footError').hide();
		$('#menuIndexAvtor, #menuIndexReg, #footError').removeClass('hide');

		$('#btnAvtorIndex').click(function() {
			$('#menuIndex').fadeOut('slow');
			$('#menuIndexAvtor').delay( 100 ).fadeIn('slow');
		});

		$('#subNoAvtor').click(function() {
			$('#menuIndexAvtor').fadeOut('slow');
			$('#menuIndex').delay( 600 ).fadeIn('slow');
		});

		$('#btnRegIndex').click(function() {
			$('#menuIndex').fadeOut('slow');
			$('#menuIndexReg').delay( 100 ).fadeIn('slow');
		});

		$('#subNoReg').click(function() {
			$('#menuIndexReg').fadeOut('slow');
			$('#menuIndex').delay( 600 ).fadeIn('slow');
		});

		$('.goSearch').click(function(){
			window.location.href = 'Mag.php?s='+$('.search').val();
		});

</script>
<?php
//Если не авторизованны
	if($_COOKIE['auth'] == 'false' || !isset($_COOKIE['auth'])){
		echo "<script type='text/javascript'>
				$(function() {
					$('.roExit, .roUser').addClass('hide');
				});
			</script>";
	}
//Если авторизованны
	if($_COOKIE['auth'] == 'true'){
		echo "<script type='text/javascript'>
				$(function() {
					$('.roReg, .roAvtor').addClass('hide');
				});
			</script>";
	};
?>