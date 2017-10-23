<?php
//dodawanie załącznika do folderu attachments oraz informacji do bazy danych, przekierowanie z tasks_all
session_start();
    
    if (empty($_FILES)){
        header("location: main.php");
        exit();
    }
    $sid=$_POST['sid'];
    $tid=$_POST['tid'];
	
    require_once "database/dbinfo.php";
	require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){
		echo 'false';
        $time=date("ymdHis");
        
        //kontrola typu (do poprawy)
        $ext = substr($_FILES['attachment']['name'], -3);
        if($ext != 'exe' && $ext!='php' && $ext !='.js'){
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], 'attachments/'.$time.$_FILES['attachment']['name'])){
                $sql = "INSERT INTO $db_attachment_tab ($db_attachment_id, $db_attachment_name, $db_attachment_type, $db_attachment_size, $db_attachment_taskid, $db_attachment_desc) VALUES (NULL, '".$time.$_FILES['attachment']['name']."', '".$_FILES['attachment']['type']."', '".$_FILES['attachment']['size']."', '$tid', '".$_POST['desc']."')";
                if ($result = $connection->query($sql)){
                    $text = 2; //2: dodano nowy załącznik
                    $sql = "INSERT INTO $db_notifications_tab ($db_notifications_id, $db_notifications_date, $db_notifications_type) VALUES (NULL, '".date('Y-m-d H:i:s')."', '$text')";
                    if ($result = $connection -> query($sql)){
                        //info kontrolne, że działa
                        $notificationid = $connection->insert_id;
                        $sql = "SELECT $db_subtask_userid, $db_subtask_id FROM $db_subtask_tab WHERE $db_subtask_taskid=$tid AND $db_subtask_userid<>".$_SESSION['id']." GROUP BY $db_subtask_userid";
                        $result = $connection->query($sql);
                        while ($row = $result->fetch_assoc()){
                            $sql = "INSERT INTO $db_nots_user_tab ($db_nots_user_id, $db_nots_user_notificationid, $db_nots_user_userid, $db_nots_user_taskid, $db_nots_user_subtaskid, $db_nots_user_readnots) VALUES (NULL, '$notificationid', '$row[$db_subtask_userid]', '$tid', '$row[$db_subtask_id]', '0')";
                            $connection->query($sql);
                        }
                    }
                }
            }
        }
        unset($_FILES);
    
    $connection->close(); 
    }
    header("location: tasks_all.php?sid=$sid&tid=$tid");    
?>