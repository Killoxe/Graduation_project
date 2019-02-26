<?php 
    include_once 'conn.php';

    mysql_query("UPDATE cart SET quantity = '". $_POST['quantity'] ."' WHERE id = '". $_POST['idTovar'] ."'");
?>