<?php
//wyświetlanie w okienku liczby nieprzeczytanych powiadomień
session_start();

require_once "database/dbinfo.php";
require_once "database/connect.php";

$connection = db_connection();
if ($connection != false){
    $sql= "SELECT count($db_nots_user_id) FROM $db_nots_user_tab  WHERE  $db_nots_user_readnots=0 AND $db_nots_user_delete=0 AND $db_nots_user_userid=".$_SESSION['id'];   
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    echo $row ["count($db_nots_user_id)"];
}
?>