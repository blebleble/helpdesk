<?php
//blokowanie możliwości zmiany daty dla wykonawcy podzadania, uruchamiane przez blockSubtask z subtasks.js
if (empty($_GET)){
    header("Location: main.php");
    exit();
}
require_once 'database/dbinfo.php';
require_once 'database/connect.php';
$connection = db_connection();
if ($connection != false){
    $sql = "UPDATE $db_subtask_tab SET $db_subtask_block=NOT $db_subtask_block WHERE $db_subtask_id=".$_GET['id'];
    $connection->query($sql);
    $connection->close();
}
?>