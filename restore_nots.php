<?php
//usuwanie permamentne lub przywracanie powiadomień, przekierowanie z bin
session_start();
if (!empty($_POST)){
    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){ 
        if(isset($_POST['delete'])){
            foreach($_POST['not'] as $selected){
                $sql="DELETE FROM $db_nots_user_tab WHERE  $db_nots_user_id = $selected;";
                $connection->query($sql);
            }
            $sql="DELETE $db_notifications_tab FROM $db_notifications_tab LEFT JOIN $db_nots_user_tab ON $db_notifications_tab.$db_notifications_id=$db_nots_user_tab.$db_nots_user_notificationid WHERE $db_nots_user_tab.$db_nots_user_notificationid IS NULL";
            $connection->query($sql);
        }
        else{
            foreach($_POST['not'] as $selected){
                $sql="UPDATE $db_nots_user_tab SET $db_nots_user_delete = '0' WHERE $db_nots_user_id = $selected;";
                $connection->query($sql);
            }
        }
        $connection->close();
    }
}
header("location: bin.php");
?>