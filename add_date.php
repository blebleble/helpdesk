<?php
//zatwierdzanie lub zmiana daty przez usera, przekierowanie z pliku tasks_all.php
    session_start();
    
    if (empty($_POST)){
        header("Location: main.php");
        exit();
    }
    $sid = $_POST['sid'];
    $tid = $_POST['tid'];
    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){
        $sdate = $_POST['stime'];
        $edate = $_POST['etime'];
        $sql= "SELECT $db_task_edate, $db_task_priority FROM $db_task_tab WHERE $db_task_id=$tid";
        $select_result = $connection->query($sql);
        $select_row = $select_result -> fetch_assoc();
        
        if((($edate>$select_row[$db_task_edate]) && ($select_row[$db_task_priority]==1)) || $edate<$sdate){
            $_SESSION['alert']= "Wprowadzono niepoprawne daty";
        }
        else{
            $text = 6; // zmieniono datę podzadania
            if ($edate>$select_row[$db_task_edate]){ //data końcowa podzadania zmienia datę zadania gównego
                $sql_u = "UPDATE $db_task_tab SET $db_task_edate='$edate' WHERE $db_task_id=$tid"; 
                $connection->query($sql_u);
            }
            else{
                $sql = "SELECT $db_subtask_sdate, $db_subtask_edate FROM $db_subtask_tab WHERE $db_subtask_id=$sid";
                $result = $connection->query($sql);
                $row = $result->fetch_assoc();
                if ($row[$db_subtask_sdate]==$sdate && $row[$db_subtask_edate]==$edate){
                    $text = 7; // zatwierdzono datę podzadania
                }
            }
            $sql = "UPDATE $db_subtask_tab SET $db_subtask_sdate='$sdate', $db_subtask_edate= '$edate', $db_subtask_conf='1' WHERE $db_subtask_id='$sid'";
            $connection->query($sql);
            //nowa notyfikacja
            $curr_timestamp = date('Y-m-d H:i:s');
            $sql = "INSERT INTO $db_notifications_tab ($db_notifications_id, $db_notifications_date, $db_notifications_type) VALUES (NULL, '$curr_timestamp', '$text')";        
            if ($result = $connection -> query($sql)){
                //info testowe: działa
                $notificationid = $connection->insert_id;
                $sql = "SELECT $db_task_userid FROM $db_task_tab WHERE $db_task_id=$tid";
                $result = $connection -> query($sql);
                $row = $result -> fetch_assoc();
                $masterid = $row[$db_task_userid];
                //powiadomienie tylko dla managera: w pola taskID i subtaskID wrzucamy dane dla usera który dokonuje zmian, nie dla usera, który je odczytuje w powiadomieniu (dla managera nie są one potrzebne, dostaje za to informacje kto zmienił datę)
                $sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_id, $db_nots_user_notificationid, $db_nots_user_userid, $db_nots_user_taskid, $db_nots_user_subtaskid, $db_nots_user_readnots) VALUES (NULL, '$notificationid', '$masterid', '$tid', '$sid', '0')";
                if ($result = $connection->query($sql)){
                    if ($text==6){
                        $_SESSION['alert']="Zmieniono datę podzadania";
                    }
                    else {
                        $_SESSION['alert']="Zatwierdzono datę podzadania";
                    }
                }
            }
        }
    $connection->close();
    }
    header("Location: tasks_all.php?sid=$sid&tid=$tid");
?>