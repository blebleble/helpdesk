<?php 
// dodawanie nowego podzadania, przekierowanie z add_subtasks
    session_start();
    if (empty($_POST)){
	header('Location: add_subtasks.php');
	exit();
    }
    
    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){
        
        $sdate = $_POST['stime'];
        $edate = $_POST['etime'];
        
        if ($sdate > $edate){
            $_SESSION['alert']= 'Niepoprawna data';
            header('Location: add_subtasks.php');
            close();
        }

        $tid = $_POST['task'];
        $userid = $_POST['user'];
        $topic = $_POST['topic'];
        $desc = $_POST['description'];
        
        
        $sql= "Select $db_task_edate, $db_task_priority from $db_task_tab WHERE $db_task_id=$tid";
        $select_result = $connection->query($sql);
        $select_row = $select_result -> fetch_assoc();
        
        if($edate>$select_row[$db_task_edate]&& $select_row[$db_task_priority]==1){
            $_SESSION['alert']= 'Niepoprawna data: termin podzadania dłuższy niż zadania głównego';
            header('Location: add_subtasks.php');
        }else{
        if ($edate>$select_row[$db_task_edate]){
            $sql = "UPDATE $db_task_tab SET $db_task_edate='$edate' WHERE $db_task_id= $tid"; 
            $connection->query($sql);
        }}
        
        $sql = "INSERT INTO $db_subtask_tab ($db_subtask_id,$db_subtask_taskid,$db_subtask_name,$db_subtask_sdate,$db_subtask_edate,$db_subtask_description,$db_subtask_userid) VALUES (NULL,$tid,'$topic','$sdate','$edate','$desc',$userid)";
        if ($result = $connection->query($sql)){
            $sid = $connection->insert_id;
            $_SESSION['alert']= 'Dodano podzadanie';
            $text = 4; //4: masz przydzielone nowe podzadanie
            $curr_timestamp = date('Y-m-d H:i:s');
            $sql = "INSERT INTO $db_notifications_tab ($db_notifications_id, $db_notifications_date, $db_notifications_type) VALUES (NULL, '".$curr_timestamp."', '$text')";
            
            if ($result = $connection -> query($sql)){
                    //info testowe: działa
                $notificationid = $connection->insert_id;       
                $sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_id, $db_nots_user_notificationid, $db_nots_user_userid, $db_nots_user_taskid, $db_nots_user_subtaskid, $db_nots_user_readnots) VALUES (NULL, '$notificationid', '$userid', '$tid', '$sid', '0')";
                if ($result = $connection->query($sql)){
                        //info testowe: działa
                }
            }
            $connection->close();
        }
    }
header('Location: add_subtasks.php');    
?>