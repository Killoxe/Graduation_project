<?php 
    include_once 'conn.php';

    $count = mysql_fetch_assoc(mysql_query("SELECT * FROM cart WHERE id = '". $_POST['idTovar'] ."'"));
    echo $count['quantity'];
?>