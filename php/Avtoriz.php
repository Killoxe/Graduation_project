<?php
//подключение к бд
    include_once 'php/conn.php';
//если нажали на кнопку далее
	if (isset($_POST['sub-ok-av'])){
		$email = trim($_POST['avtorEmail']);
		$password = trim($_POST['avtorPass']);
//проверка почты
		if($email == ''){
			$errorList[] = 'Вы не ввели электронную почту';
		}else{
			if($password == ''){
				$errorList[] = 'Вы не ввели пароль';
			}else{
				$ok = true;
			}
		}
//вход для сотрудников
		if ($email == "admin@admin.ru" and $password == "admin") {
			print '<script type="text/javascript"> window.location.href = "Admin.php" </script>';
		}
//если ввели почты и пароль, то проверяем и заходим
		if($ok){
			$data = mysql_fetch_assoc(mysql_query("SELECT e_mail, pass FROM customer WHERE e_mail='".mysql_real_escape_string($email)."' AND pass='".md5($password)."' LIMIT 1"));
			if(mysql_num_rows(mysql_query("SELECT e_mail, pass FROM customer WHERE e_mail='".mysql_real_escape_string($email)."' LIMIT 1")) == 0){
				$errorList[] = 'Ошибка: Такого пользователя не существует';
			}else{
				if($data['pass'] == md5($password)){
					setcookie('auth', 'true', time()+3600, '/');
					setcookie('e_mail', $data['e_mail'], time()+3600, '/');
					print '<script type="text/javascript"> window.location.href = "Mag.php" </script>';
					$errorList[] = '';
				}else{
					$errorList[] = 'Вы ввели не правильный пароль';
				}
			}
		}
	}
?>