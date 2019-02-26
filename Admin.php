<?php 
	session_start();
//вот сюда я переместил
	include_once 'php/AvtorizAdmin.php';
	include_once 'php/RegistrationAdmin.php';
//подключение к бд
    include_once 'php/conn.php';

	if(isset($_GET['_close'])){
        setcookie('authAdmin', null, time()-3600, '/');
		setcookie('login', null, time()-3600, '/');
        print '<script type="text/javascript"> window.location.href = "Index.php" </script>';
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
	<title>Добро пожаловать в EMPHASIS. Панель для сотрудников</title>
	<link rel="icon" type="image/png" href="img/009-line.png">
	<link rel="stylesheet" type="text/css" href="css/Style.css">
	<link rel="stylesheet" type="text/css" href="css/Media.css">
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/jquery-3.3.1.js"></script>
	<script src="js/Logig.js"></script>
</head>
<body>
<!-- шапка -->
<header class="adminHead">
	<h1><a href="Admin.php" class="logo gray">EMPHAS<span class="yellowI">I</span>S</a></h1>		
		<nav class="butAdminMenu hide">
			<ul class="panelMenu1 gray">
				<li class="gray">ТОВАРЫ
					<form class="subMenu">
						<a href="Admin.php?_newGoods">Таблица товаров</a>
						<a href="Admin.php?_statGoods">Статус заказов</a>
						<a href="Admin.php?_cometGoods">Комментарии</a>
						<a href="Admin.php?_newDisig">Добавить дизайнера</a>
						<a href="Admin.php?_newCateg">Добавить категорию товара</a>
						<a href="Admin.php?_newFurnit">Добавить фурнитуру</a>
						<a href="Admin.php?_newViewFurnit">Добавить вид фурнитуры</a>
						<a href="Admin.php?_newProv">Добавить поставщика</a>
					</form>
				</li>
				<li><a href="Admin.php?_customer" class="gray">КЛИЕНТЫ</a></li>
				<li><a href="Admin.php?_regAdmin" class="gray">РЕГИСТРАЦИЯ</a></li>
				<li><a href="Admin.php?_close" class="gray">ВЫХОД</a></li>
			</ul>
		</nav>
</header>
<!-- топ -->
<div class="adminTop">
<!-- авторизация -->
	<center class="avtorAdmin hide">
		<div class="logo white">
			<h1>АВТОРИЗАЦ<span class="yellowI">И</span>Я</h1>
		</div>
		<hr class="horizontalLine">
		<form method="post" class="avtorAdminForm">
			<input class="inputText white" name="avtorLogin" type="text" placeholder="Логин">
			<input class="inputText white" name="avtorPass" type="password" placeholder="Пароль">
			<input type="submit" name="sub-ok-avtor" id="sub-ok-avtor" value="Далее" class="btn btnMini white">
			<a href="Index.php" class="white focusBtn btn btnMini" id="subNoReg">Назад</a>
		</form>
	</center>
<!-- регистрация -->
	<center class="regAdmin hide">
		<div class="logo white">
			<h1>РЕГИСТРАЦ<span class="yellowI">И</span>Я</h1>
		</div>
		<hr class="horizontalLine">
		<form method="post" class="regAdminForm">
			<input class="inputText white" name="regEmail" type="text" placeholder="Логин">
			<input class="inputText white" name="regPass" type="password" placeholder="Пароль">
			<input class="inputText white" name="regDublPass" type="password" placeholder="Повторите пароль"><br>
			<input class="inputText white" name="regSurname" type="text" placeholder="Фамилия">
			<input class="inputText white" name="regName" type="text" placeholder="Имя">
			<input class="inputText white" name="regPatron" type="text" placeholder="Отчество">
			<input class="inputText white" name="regPhone" type="text" placeholder="Телефон">
			<input type="submit" name="sub-ok-reg" id="sub-ok-reg" value="Далее" class="btn btnMini white">
		</form>
	</center>
<!-- лист с ошибками -->
		<div id="footError" class="footError white hide">
			<form class="listError" method="post">
				<?php
					/* вывод ошибок */
					$i = 0;
					foreach ($errorList as $err){
						$i++;
						echo $err.'<br>';
					}

					if($i != 0){
						echo "<script type='text/javascript'>$('#footError').delay( 1000 ).fadeIn('slow');
								$('#footError').delay( 4000 ).fadeOut('slow');</script>";
					}
				?>
			</form>
		</div>
<!-- подключения в нутри топа -->
	<?php

		if(isset($_GET['_newGoods'])){
	        include_once 'NewGoods.php';
    	}
    	if(isset($_GET['_statGoods'])){
	        include_once 'StatGoods.php';
    	}
    	if(isset($_GET['_cometGoods'])){
	        include_once 'CometGoods.php';
    	}
    	if(isset($_GET['_regAdmin'])){
	        echo "<script type='text/javascript'>
					$('.regAdmin').removeClass('hide');
				</script>";
    	}
    	if(isset($_GET['_customer'])){
	        include_once 'Customer.php';
    	}
    	if(isset($_GET['_newDisig'])){
	        include_once 'NewDisig.php';
    	}
    	if(isset($_GET['_newCateg'])){
	        include_once 'NewCategorGoods.php';
    	}
    	if(isset($_GET['_newFurnit'])){
	        include_once 'NewAcc.php';
    	}
    	if(isset($_GET['_newViewFurnit'])){
	        include_once 'NewAccView.php';
    	}
    	if(isset($_GET['_newProv'])){
	        include_once 'NewProv.php';
    	}

	?>
	
</div>
<!-- логика, скрипты -->
<script>
	document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>');

	$(function() {

		$('#footError').hide();
		$('#footError').removeClass('hide');

		$('.butAdminMenu').removeClass('hide');
		$('.avtorAdmin').removeClass('hide');

	});

</script>

</body>
</html>
<?php

//Если не авторизованны
	if($_COOKIE['authAdmin'] == 'false' || !isset($_COOKIE['authAdmin'])){
		echo "<script type='text/javascript'>
				$(function() {
					$('.butAdminMenu').hide();
				});
			</script>";
	}
//Если авторизованны
	if($_COOKIE['authAdmin'] == 'true'){
		echo "<script type='text/javascript'>
				$(function() {
					$('.avtorAdmin').hide();
				});
			</script>";
	};

?>