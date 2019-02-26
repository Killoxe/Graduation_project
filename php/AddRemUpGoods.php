<?php
//добавление товара
	include_once 'php/conn.php';
	$name = trim($_POST['goodsName']);
	$value = trim($_POST['goodsPriсe']);
	$quantity = trim($_POST['goodQuan']);
	$color = trim($_POST['goodsColor']);
	$material = trim($_POST['goodsMaterial']);
	$character = trim($_POST['goodsCharacter']);
	$description = trim($_POST['goodsDescription']);
	$category = $_POST['goodsCateg'];
	$furnityra = $_POST['goodsAcc'];
	$disigner = $_POST['goodsDdisig'];

	if(isset($_POST['goodsOk'])){
		//название товара
		if(strlen($name) == 0){
			$errorList[] = 'Вы не ввели название товара';
		}else{
			if(strlen($name) < 3){
				$errorList[] = 'Слишком короткое название товара';
			}else{
				if(strlen($name) > 30){
					$errorList[] = 'Слишком длинное название товара';
				}else{
					$ok['name'] = true;
				}
			}	
		}
		//цена товара
		if(strlen($value) == 0){
			$errorList[] = 'Вы не ввели цену товара';
		}else{
			if(strlen($value) > 8){
				$errorList[] = 'Слишком большая цена товара';
			}else{
				$ok['value'] = true;
			}	
		}
		//количество товара
		if(strlen($quantity) == 0){
			$errorList[] = 'Вы не ввели количество товара';
		}else{
			$ok['quantity'] = true;
		}
		//цвет товара
		if(strlen($color) == 0){
			$errorList[] = 'Вы не ввели цвет товара';
		}else{
			$ok['color'] = true;
		}
		//материал товара
		if(strlen($material) == 0){
			$errorList[] = 'Вы не ввели материал товара';
		}else{
			$ok['material'] = true;
		}
		//фото
		if((!empty($_FILES['photo_tovar'])) && ($_FILES['photo_tovarphoto_tovar']['error'] == 0)){
			if ((($_FILES['photo_tovar']['type'] == "image/jpeg")
			|| ($_FILES['photo_tovar']['type'] == "image/jpg")
			|| ($_FILES['photo_tovar']['type'] == "image/png"))
			&& ($_FILES['photo_tovar']['type'] < 20000)){
				$lastid = mysql_fetch_row (mysql_query("SELECT MAX(id) FROM goods")); $lastid[0]++;
				//перемещаем загруженный файл в новое место

			/* =====================================================================================================
			* ОБРАТИТЬ ВНИМАНИЕ СЮДА(ПУТЬ КУДА СОХРАНЯЮТСЯ КАРТИНКИ)
			===================================================================================================== */

				$explode_dir = explode("/", $_SERVER['PHP_SELF'], -1);
				$dir_photo_tovar = '../'.$explode_dir[1].'/goods/id-' .$lastid[0]. '.jpg';
				move_uploaded_file($_FILES['photo_tovar']['tmp_name'], $dir_photo_tovar);

				$ok['image'] = true;
			}else{
				$errorList[] = 'Файл не является изображением';
			}
		}else{
			$errorList[] = 'Вы не выбрали изображение';
		}
		//модели
		if((!empty($_FILES['photo_model'])) && ($_FILES['photo_modelphoto_model']['error'] == 0)){
			if ($_FILES['photo_model']['type'] < 20000){
				$lastid = mysql_fetch_row (mysql_query("SELECT MAX(id) FROM goods")); $lastid[0]++;
				//перемещаем загруженный файл в новое место

			/* =====================================================================================================
			* ОБРАТИТЬ ВНИМАНИЕ СЮДА(ПУТЬ КУДА СОХРАНЯЮТСЯ КАРТИНКИ)
			===================================================================================================== */

				$explode_dir = explode("/", $_SERVER['PHP_SELF'], -1);
				$dir_model_tovar = '../'.$explode_dir[1].'/model/id-' .$lastid[0]. '.html';
				move_uploaded_file($_FILES['photo_model']['tmp_name'], $dir_model_tovar);
			}else{
				$errorList[] = 'Файл не является изображением';
			}
		}else{
			$errorList[] = 'Вы не выбрали изображение';
		}

		if($ok['name'] && $ok['value'] && $ok['quantity'] && $ok['color'] && $ok['material'] && $ok['image']){
			$sqlGoods = mysql_query("INSERT INTO goods (id_category, id_access, id_disigner, name, value, quantity, characterr, description, color, material, img_goods, model) 
				VALUES ('".$category."','".$furnityra."','".$disigner."','".$name."','".$value."','".$quantity."','".$character."','".$description."','".$color."','".$material."','".$dir_photo_tovar."','".$dir_model_tovar."')");
			$errorList[] = 'Товар успешно добавлен в базу данных';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newGoods" </script>';
		}else{
			$errorList[] = '<br>Ошибка: товар не добавлен в базу данных';
		}
    }
//удаление товара
    if(isset($_POST['goodsRem'])){
    	foreach($_POST['check'] as $id) {
    		mysql_query("DELETE FROM goods WHERE id = '".$id."'"); 
    	}
    	print '<script type="text/javascript"> window.location.href = "Admin.php?_newGoods" </script>';
    }
//изменение товара
    $name = trim($_POST['goodsNameUp']);
	$value = trim($_POST['goodsPriсeUp']);
	$quantity = trim($_POST['goodQuanUp']);
	$color = trim($_POST['goodsColorUp']);
	$material = trim($_POST['goodsMaterialUp']);
	$character = trim($_POST['goodsCharacterUp']);
	$description = trim($_POST['goodsDescriptionUp']);

	/* сюда тоже */
	$category = $_POST['goodsCateg'];
	$furnityra = $_POST['goodsAcc'];
	$disigner = $_POST['goodsDdisig'];

   if(isset($_POST['goodsUpOk'])){
    	
    	if(strlen($name) == 0){
			$errorList[] = 'Вы не ввели название товара';
		}else{
			if(strlen($name) < 3){
				$errorList[] = 'Слишком короткое название товара';
			}else{
				if(strlen($name) > 30){
					$errorList[] = 'Слишком длинное название товара';
				}else{
					$ok['name'] = true;
				}
			}	
		}
		//цена товара
		if(strlen($value) == 0){
			$errorList[] = 'Вы не ввели цену товара';
		}else{
			if(strlen($value) > 8){
				$errorList[] = 'Слишком большая цена товара';
			}else{
				$ok['value'] = true;
			}	
		}
		//количество товара
		if(strlen($quantity) == 0){
			$errorList[] = 'Вы не ввели количество товара';
		}else{
			$ok['quantity'] = true;
		}
		//цвет товара
		if(strlen($color) == 0){
			$errorList[] = 'Вы не ввели цвет товара';
		}else{
			$ok['color'] = true;
		}
		//материал товара
		if(strlen($material) == 0){
			$errorList[] = 'Вы не ввели материал товара';
		}else{
			$ok['material'] = true;
		}

		if($ok['name'] && $ok['value'] && $ok['quantity'] && $ok['color'] && $ok['material']){
			$sqlGoods = mysql_query("UPDATE goods
				SET id_category = '".$category."', id_access = '".$furnityra."', id_disigner = '".$disigner."', name = '".$name."', value = '".$value."', quantity = '".$quantity."', characterr = '".$character."', description = '".$description."', color = '".$color."', material = '".$material."'
				WHERE id = " . $_POST['id_tovar']);
			$errorList[] = 'Товар успешно изменен';
			print '<script type="text/javascript"> window.location.href = "Admin.php?_newGoods" </script>';
		}else{
			$errorList[] = '<br>Ошибка: товар не был изменен';
		}

	}

?>