<?php 
$id = $_POST["id"];
$color = $_POST["color"];

require_once "database/dbinfo.php";
require_once "database/connect.php";
    
$connection = db_connection(); 

$sql = "UPDATE $db_nots_user_tab  SET $db_nots_user_color='$color' WHERE $db_nots_user_id = $id";
$connection->query($sql);
echo $sql;


 ?>