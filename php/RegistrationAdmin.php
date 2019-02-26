<?php
	//подключение к бд
    include_once 'php/conn.php';
	
	$login = trim($_POST['regEmail']);
	$password = trim($_POST['regPass']);
	$repeatPassword = trim($_POST['regDublPass']);
	$surname = trim($_POST['regSurname']);
	$name = trim($_POST['regName']);
	$patron = trim($_POST['regPatron']);
	$phone = trim($_POST['regPhone']);

	if (isset($_POST['sub-ok-reg'])){
		
		//проверка логина
		//введен ли логин
		if(strlen($login) == 0){
			$errorList[] = 'Вы не ввели логин';
		}else{//короткий ли логин
			if(strlen($login) < 6){
				$errorList[] = 'Логин слишком короткий';
			}else{
				//длинный ли логин
				if(strlen($login) > 30){
					$errorList[] = 'Логин слишком длинный';
				}else{
					//правильность логина
					if(preg_match('/^[a-zA-Z0-9]{6,30}$/', $login)){
						$ok['login'] = true;
					}else{
						$errorList[] = 'Логин не соответствует требования';
					}	
				}
			}	
		}

		//проверка пароля
		//введен ли пароль
		if(strlen($password) == 0){
			$errorList[] = 'Вы не ввели пароль';
		}else{
			//короткий ли пароль
			if(strlen($password) < 6){
				$errorList[] = 'Пароль слишком короткий';
			}else{
				//длинный ли пароль
				if(strlen($password) > 30){
					$errorList[] = 'Пароль слишком длинный';
				}else{
					//правильность пароля
					if(preg_match('/^[a-zA-Z0-9]{6,30}$/', $password)){
						$ok['password'] = true;
					}else{
						$errorList[] = 'Пароль не соответствует требования';
					}	
				}
			}	
		}

		//проверка подтверждения пароля
		if(strlen($repeatPassword) == 0){
			$error1 = 'Повторите пароль';
		}else{
			//совпадают ли пароли
			if($repeatPassword == $password){
				$ok['repeatPassword'] = true;
			}else{
				$errorList[] = 'Пароли не совпадают<br>';
			}
		}

		//проверка на таких же логинов
		if($ok['login']){
			//ищем в бд
			$checkLogin = mysql_query("SELECT id FROM associate WHERE login='".$login."'");
			//проверяем
			if (mysql_num_rows($checkLogin) == 0) {
				$ok['checkLogin'] = true;
			}else{
				$errorList[] = 'Такой логин уже зарегистрирована<br>';
			}
		}
		
		//наконец регистрируем пользователя
		if($ok['login'] && $ok['password'] && $ok['repeatPassword'] && $ok['checkLogin']){
			$sql = mysql_query("INSERT INTO associate (login, pass, surname, name, patron, phone) 
				VALUES ('".$login."','".md5($password)."','".$surname."','".$name."','".$patron."','".$phone."')");
			print '<script type="text/javascript"> window.location.href = "Admin.php" </script>';
		}



	}
?>