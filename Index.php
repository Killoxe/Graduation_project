<?php 
	session_start();
//подключение к бд
    include_once 'php/conn.php';
	include_once 'php/Avtoriz.php';
	include_once 'php/Registration.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
	<title>Добро пожаловать в EMPHASIS</title>
	<link rel="icon" type="image/png" href="img/009-line.png">
	<link rel="stylesheet" type="text/css" href="css/Style.css">
	<link rel="stylesheet" type="text/css" href="css/Media.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery-3.3.1.js"></script>
	<script src="js/Logig.js"></script>
</head>
<body>
<!-- фон, картинка -->
	<div class="backgroundIndex"></div>

<!-- шапка -->
	<header class="headIndex white">
<!-- меню -->
		<div id="menuIndex">
			<center class="logo">
				<h1>EMPHAS<span class="yellowI">I</span>S</h1>
			</center>
			<hr class="horizontalLine">
			<ul class="menuHeadIndex">
				<a href="Mag.php" class="white focusBtn">
					<li class="btn">МАГАЗИН</li>
				</a>
				<a href="javascript:void(0);" class="white focusBtn" id="btnAvtorIndex">
					<li class="btn">АВТОРИЗАЦИЯ</li>
				</a>
				<a href="javascript:void(0);" class="white focusBtn" id="btnRegIndex">
					<li class="btn">РЕГИСТРАЦИЯ</li>
				</a>
			</ul>
		</div>
<!-- блок авторизации -->
		<center id="menuIndexAvtor" class="hide">
			<div class="logo white">
				<h1>АВТОРИЗАЦ<span class="yellowI">И</span>Я</h1>
			</div>
			<hr class="horizontalLine">
			<div class="blockAvtorIndex">
				<form method="post">
					<input class="inputText white" type=email name="avtorEmail" placeholder="E-mail">
					<input class="inputText white" type="password" name="avtorPass" placeholder=Пароль>
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
					<input class="inputText white" name="regEmail" type=email placeholder="E-mail">
					<input class="inputText white" name="regPass" type="password" placeholder=Пароль>
					<input class="inputText white" name="regDublPass" type="password" placeholder="Повотите пароль">
					<input type="submit" name="sub-ok-reg" id="sub-ok-reg" value="Далее" class="btn btnMini white">
					<a href="javascript:void(0);" class="white focusBtn btn btnMini" id="subNoReg">Назад</a>
				</form>
			</div>
		</center>
	</header>
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
<!-- топ, описание -->
	<center class="infoIndex white">
		<div class="caption">
			<h2>НЕМНОГО О НАС</h2>
		</div>
		<hr class="horizontalLine">
		<ul class="descriptionIndex">
			<li>
				<h3>Кто мы?</h3>
				<p>EMPHASIS - модный и популярный интернет-магазин дизайнерской мебели. На нашем сайте собрано все самое актуальное и интересное: 500 моделй дизайнерской мебели ждут своих покупателей. Все самое лучшее от наших топовых дизайнеров для Вас.</p>
			</li>
			<li>
				<h3>Почему мы?</h3>
				<p>За все время существования интернет-магазина наши клиенты были довольны покупками. Для нас самое главное это помочь покупателю комфортно и удобно обустроить пространство. Поэтому мы дорожим каждым клиентом и рассчитываем на взаимовыгодные отношения</p>
			</li>
			<li>
				<h3>Наша цель</h3>
				<p>Цель нашей компании в том, чтобы сделать дизайнерскую мебель более доступной и популяризировать современные интерьеры. Мы мечтаем о том, чтобы красивая мебель окружала наших клиентов каждый день.</p>
			</li>
		</ul>
		<hr class="horizontalLine">
	</center>
<!-- общий подвал -->
	<footer>
		<?php
			include_once '_Footer.php';
		?>
	</footer>
<!-- автообновление -->
	<script>
		document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>');

			$('#menuIndexAvtor, #menuIndexReg, #footError').hide();
			$('#menuIndexAvtor, #menuIndexReg, #footError').removeClass('hide');

			$('#btnAvtorIndex').click(function() {
				$('#menuIndex').fadeOut('slow');
				$('#menuIndexAvtor').delay( 600 ).fadeIn('slow');
			});

			$('#subNoAvtor').click(function() {
				$('#menuIndexAvtor').fadeOut('slow');
				$('#menuIndex').delay( 600 ).fadeIn('slow');
			});

			$('#btnRegIndex').click(function() {
				$('#menuIndex').fadeOut('slow');
				$('#menuIndexReg').delay( 600 ).fadeIn('slow');
			});

			$('#subNoReg').click(function() {
				$('#menuIndexReg').fadeOut('slow');
				$('#menuIndex').delay( 600 ).fadeIn('slow');
			});
		
	</script>
</body>
</html>