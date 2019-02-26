<?php
//подключение к бд
    include_once 'php/conn.php';
	$email = trim($_POST['regEmail']);
	$password = trim($_POST['regPass']);
	$repeatPassword = trim($_POST['regDublPass']);
//если нажали на кнопку далее
	if (isset($_POST['sub-ok-reg'])){
//проверка почты
//введена ли почта
		if(strlen($email) == 0){
			$errorList[] = 'Вы не ввели электронную почту<br>';
		}else{
//правильность почты
			if(filter_var($email, FILTER_VALIDATE_EMAIL)){
				$ok['email'] = true;
			}else{
				$errorList[] = 'Электронная почта не соответствует требования<br>';
			}
		}
//проверка пароля
//введен ли пароль
		if(strlen($password) == 0){
			$errorList[] = 'Вы не ввели пароль<br>';
		}else{
//короткий ли пароль
			if(strlen($password) < 6){
				$errorList[] = 'Пароль слишком короткий<br>';
			}else{
//длинный ли пароль
				if(strlen($password) > 30){
					$errorList[] = 'Пароль слишком длинный<br>';
				}else{
//правильность пароля
					if(preg_match('/^[a-zA-Z0-9]{6,30}$/', $password)){
						$ok['password'] = true;
					}else{
						$errorList[] = 'Пароль не соответствует требования<br>';
					}	
				}
			}	
		}
//проверка подтверждения пароля
		if(strlen($repeatPassword) == 0){
			$errorList[] = 'Повторите пароль<br>';
		}else{
//совпадают ли пароли
			if($repeatPassword == $password){
				$ok['repeatPassword'] = true;
			}else{
				$errorList[] = 'Пароли не совпадают<br>';
			}
		}
//проверка на таких же почт
		if($ok['email']){
//ищем в бд
			$checkEmails = mysql_query("SELECT id FROM customer WHERE e_mail='".$email."'");
//проверяем
			if (mysql_num_rows($checkEmails) == 0) {
				$ok['checkEmails'] = true;
			}else{
				$errorList[] = 'Такая электронная почта уже зарегистрирована<br>';
			}
		}
//наконец регистрируем пользователя
		if($ok['email'] && $ok['password'] && $ok['repeatPassword'] && $ok['checkEmails']){
			$sql = mysql_query("INSERT INTO customer (e_mail, pass) 
				VALUES ('".$email."','".md5($password)."')");
			setcookie('auth', 'true', time()+3600, '/');
			setcookie('e_mail', $email, time()+3600, '/');
			print '<script type="text/javascript"> window.location.href = "Mag.php?_room" </script>';
		}
	}
?>