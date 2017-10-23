<?php
//aktywowanie lub dezaktywowanie zadań (przenoszenie między osie tasks i old_tasks)
if (empty($_POST)){
    header("Location: main.php");
    exit();
}
require_once "database/dbinfo.php";
require_once "database/connect.php";

$connection = db_connection();
if ($connection != false){
    $sid = $_POST['sid'];
    $tid = $_POST['tid'];
    $sql = "UPDATE $db_subtask_tab SET $db_subtask_done = NOT $db_subtask_done WHERE $db_subtask_id='$sid'";
    if ($row = $connection->query($sql)){
        if ($_POST['active']){
            $text = 8; //8: zakończono wykonywania zadania
            $curr_timestamp = date('Y-m-d H:i:s');
            $sql = "INSERT INTO $db_notifications_tab ($db_notifications_id, $db_notifications_date, $db_notifications_type) VALUES (NULL, '$curr_timestamp', '$text')";        
            echo $sql."<br>";
            if ($result = $connection -> query($sql)){
                //info testowe: działa
                $notificationid = $connection->insert_id;
                $sql = "SELECT $db_task_userid FROM $db_task_tab WHERE $db_task_id=$tid";
                echo $sql."<br>";
                $result = $connection -> query($sql);
                $row = $result -> fetch_assoc();
                $masterid = $row[$db_task_userid];
                //powiadomienie tylko dla managera: w pola taskID i subtaskID wrzucamy dane dla usera który dokonuje zmian, nie dla usera, który je odczytuje w powiadomieniu (dla managera nie są one potrzebne, dostaje za to informacje kto zmienił datę)
                $sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_id, $db_nots_user_notificationid, $db_nots_user_userid, $db_nots_user_taskid, $db_nots_user_subtaskid, $db_nots_user_readnots) VALUES (NULL, '$notificationid', '$masterid', '$tid', '$sid', '0')";
                $connection->query($sql);
            }
            header("Location: tasks.php");
        }
        else{
            header("Location: old_tasks.php");
        }
    }
    $connection->close();
}
?>