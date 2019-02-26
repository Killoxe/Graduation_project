<?php 
    include_once 'conn.php';

    if(isset($_COOKIE[auth])){
    	$customer = mysql_fetch_assoc(mysql_query("SELECT * FROM customer WHERE e_mail LIKE '". $_COOKIE['e_mail'] ."'"));

    	$ifis = mysql_fetch_assoc(mysql_query("SELECT * FROM cart WHERE id_customer = ". $customer[id] ." AND Id_goods = ". $_POST['idTovar']));
    	if($ifis[id] == 0){
    		mysql_query("INSERT INTO cart (id_goods, id_customer) VALUES ('". $_POST['idTovar'] ."', '". $customer['id'] ."')");
    		echo 'Товар успешно добавлен в корзину';
    	}else{
    		echo 'Такой товар уже есть в корзине';
    	}
    }else{
    	echo 'Вы не авторизованны';
    }
    
?>