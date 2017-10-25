<?php

$id = $_POST["data"];

require_once "database/dbinfo.php";
require_once "database/connect.php";
$connection = db_connection(); 

$i=0;

$sql="SELECT $db_subtask_name FROM $db_subtask_tab WHERE $db_subtask_taskid = $id";
$result = $connection->query($sql);
while($row = $result->fetch_assoc()) {
$array[$i]=$row[$db_subtask_name];

$i++;
}

echo json_encode($array);

?>