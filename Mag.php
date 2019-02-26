<?php 
	session_start();
//авторизация и регистрация
	include_once 'php/Avtoriz.php';
	include_once 'php/Registration.php';
//подключение к бд
    include_once 'php/conn.php';
//при выходе из сессии
    if(isset($_GET['_close'])){
        setcookie('auth', null, time()-3600, '/');
		setcookie('e_mail', null, time()-3600, '/');
        print '<script type="text/javascript"> window.location.href = "Index.php" </script>';
    }
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
<body id="">
<!-- шапка магазина -->
<header>
	<?php
		include_once '_Header.php';
	?>
</header>
<!-- топ, панель с фильтром, каталог товаров, страница товара, и тд -->	
<div class="panelStore">
    <?php
	    include_once 'MagGoods.php';
	    include_once '_Panel.php';
	    include_once 'Goods.php';
//личный кабинет
	    if(isset($_GET['_room'])){
			include_once 'RoomCos.php';
			echo "<script>
				$(function() {
					$('#catalogGoodsStore, #goodsCards, #panelFiltrMag').hide();
				});
			</script>";
		}
//корзина
		if(isset($_GET['_cart'])){
			include_once 'Cart.php';
			echo "<script>
				$(function() {
					$('#catalogGoodsStore, #goodsCards, #panelFiltrMag').hide();
				});
			</script>";
		}
//заказ
		if(isset($_GET['_order'])){
			include_once 'Orders.php';
			echo "<script>
				$(function() {
					$('#catalogGoodsStore, #goodsCards, #panelFiltrMag').hide();
				});
			</script>";
		}
//блог о нас
	    if(isset($_GET['_aboutUs'])){
			include_once 'blog/about_us.php';
			echo "<script>
				$(function() {
					$('#catalogGoodsStore, #goodsCards, #panelFiltrMag').hide();
				});
			</script>";
		}
//дизайнеры
	    if(isset($_GET['_disigner'])){
			include_once 'blog/disigner.php';
			echo "<script>
				$(function() {
					$('#catalogGoodsStore, #goodsCards, #panelFiltrMag').hide();
				});
			</script>";
		}
//поставщики
	    if(isset($_GET['_provider'])){
			include_once 'blog/provider.php';
			echo "<script>
				$(function() {
					$('#catalogGoodsStore, #goodsCards, #panelFiltrMag').hide();
				});
			</script>";
		}
//помощь
	    if(isset($_GET['_help'])){
			include_once 'blog/help.php';
			echo "<script>
				$(function() {
					$('#catalogGoodsStore, #goodsCards, #panelFiltrMag').hide();
				});
			</script>";
		}
	?>
</div>
<!-- подвал -->
<footer class="footerStore">
	<?php
		include_once '_Footer.php';
	?>
</footer>
<!-- автообновление -->
	<script>
		document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] + ':35729/livereload.js?snipver=1"></' + 'script>');

		$('#catalogGoodsStore, #goodsCards, #roomCustmer, #cartStore').removeClass('hide');
	</script>

</body>
</html>