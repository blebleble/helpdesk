<?php
require_once 'database/connect.php';
require_once 'database/dbinfo.php';

$order= $_POST['array']; //tablica z id kolejnych subtasków

$connection = db_connection();

foreach ($order as $i => $sid)
{
    $e=$i+1;
    $sql = "UPDATE $db_subtask_tab SET $db_subtask_row = '$e' WHERE $db_subtask_id = '$sid'";
    $result = $connection->query($sql);
}

?>