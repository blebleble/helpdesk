<?php
//dodawanie komentarza do bazy, przekierowanie z tasks_all
    session_start();
    
    if (empty($_POST)){
            header("location: main.php");
            exit();
	}
    
    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){
        $comment = $_POST['comment'];
        $sid= $_POST['sid'];
        $curr_timestamp = date('Y-m-d H:i:s');
        $tid= $_POST['tid'];
        $sql = "INSERT INTO $db_messages_tab ($db_messages_id, $db_messages_userid, $db_messages_taskid, $db_messages_date, $db_messages_text) VALUES (NULL,'". $_SESSION['id']."', '$tid', '$curr_timestamp', '$comment')";
        $connection->query($sql);

            $text = 1; // 1: dodano nowy komentarz
            $sql = "INSERT INTO $db_notifications_tab ($db_notifications_id, $db_notifications_date, $db_notifications_type) VALUES (NULL, '".date('Y-m-d H:i:s')."', '$text')";
            if ($result = $connection -> query($sql)){
                //info kontrolne, że działa
                $notificationid = $connection->insert_id;
                $sql = "SELECT $db_subtask_userid, $db_subtask_id FROM $db_subtask_tab WHERE $db_subtask_taskid=$tid AND $db_subtask_userid<>".$_SESSION['id']." GROUP BY $db_subtask_userid";
                $result = $connection->query($sql);
                while ($row = $result->fetch_assoc()){
                    $sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_id, $db_nots_user_notificationid, $db_nots_user_userid, $db_nots_user_taskid, $db_nots_user_subtaskid,  $db_nots_user_readnots) VALUES (NULL, '$notificationid', '$row[$db_subtask_userid]', '$tid', '$row[$db_subtask_id]', '0')";
                    $connection->query($sql);
                }
            }
    }    
    $connection->close();
    header("location: tasks_all.php?sid=$sid&tid=$tid");
?>