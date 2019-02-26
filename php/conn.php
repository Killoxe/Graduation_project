<?php 
    $db_host = 'localhost';
    $db_name = 'store';
    $db_username = 'root';
    $db_password = '';
    
    $connect_to_db = mysql_connect($db_host, $db_username, $db_password);

    mysql_select_db($db_name, $connect_to_db);
?>