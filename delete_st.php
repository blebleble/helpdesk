<?php
//usuwanie zadań lub podzadań z bazy, uruchamiane przez deleteST z subtasks.js
if (empty($_GET)){
    header("location: main.php");
    exit();
}
require_once "database/dbinfo.php";
require_once "database/connect.php";

$connection = db_connection();
if ($connection != false){
    //sprawdza czy task(typ := 1) czy subtask (typ := 0)
    if ($_GET['typ']){
        $db_tab = $db_task_tab;
        $db_id = $db_task_id;
    }
    else{
        $db_tab = $db_subtask_tab;
        $db_id = $db_subtask_id;
    }
    $sql="DELETE FROM $db_tab WHERE $db_id=".$_GET['id'];      
    $connection->query($sql);   
}
?>