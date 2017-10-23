<?php
//usuwanie (przenoszenie do ksoza) powiadomień
session_start();
if (!empty($_POST)){
    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
     if ($connection != false){ 
        foreach($_POST['not'] as $selected){
            $sql="UPDATE $db_nots_user_tab SET $db_nots_user_delete = '1' WHERE $db_nots_user_id = $selected";
            $connection->query($sql);
        }          
    }
}
header("location: nots.php");
?>