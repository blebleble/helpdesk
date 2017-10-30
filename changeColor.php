<?php 
$id = $_POST["id"];
$color = $_POST["color"];

require_once "database/dbinfo.php";
require_once "database/connect.php";
    
$connection = db_connection(); 

$sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_color) VALUES ('$color') WHERE $db_nots_user_id = $id";
$connection->query($sql);


 ?>