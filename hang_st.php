<?php
//zawieszanie/odwieszanie zadań
session_start();
require_once "database/dbinfo.php";
require_once "database/connect.php";
  
$id = $_GET['id'];
	
    $connection = db_connection();
           $sql = "UPDATE $db_task_tab SET $db_task_hang = NOT $db_task_hang WHERE $db_task_id= $id";
           $result = $connection->query($sql);
		   
?>