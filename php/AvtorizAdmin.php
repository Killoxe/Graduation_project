<?php
	//подключение к бд
    include_once 'php/conn.php';
	
	if (isset($_POST['sub-ok-avtor'])){

		$loginAdmin = trim($_POST['avtorLogin']);
		$passwordAdmin = trim($_POST['avtorPass']);

		//проверка логина
		if($loginAdmin == ''){
			$error = 'Вы не ввели логин';
		}else{
			if($passwordAdmin == ''){
				$errorList[] = 'Вы не ввели пароль<br>';
			}else{
				$ok = true;
			}

		}

//если ввели логин и пароль, то проверяем и заходим
		if($ok){
			$query_loginadmin = mysql_query("SELECT login, pass FROM associate WHERE login LIKE '". $loginAdmin ."' LIMIT 1");
			
			$dateLogin = mysql_fetch_assoc($query_loginadmin);
			if(mysql_num_rows($query_loginadmin) == 0){
				$errorList[] = 'Ошибка: Такого пользователя не существует<br>';
			}else{
				if($dateLogin['pass'] == md5($passwordAdmin)){
					setcookie('authAdmin', 'true', time()+3600, '/');
					setcookie('login', $dateLogin['login'], time()+3600, '/');
					print '<script type="text/javascript"> window.location.href = "Admin.php" </script>';
					$errorList[] = '';
				}else{
					$errorList[] = 'Вы ввели не правильный пароль';
				}
			}
		}
	}
?>