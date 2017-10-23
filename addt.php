<?php
//dodawanie zadania do bazy, przekierowanie z add_tasks
    session_start();
    
    if (empty($_POST)){
            header('Location: add_tasks.php');
            exit();
	}
    
    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){
        
        $priority = $_POST['priority'];
        $sdate = $_POST['stime'];
        $edate = $_POST['etime'];
        
        if ($sdate > $edate){
            
                 $_SESSION['alert']= 'Niepoprawna data';
                 header('Location: add_tasks.php');
                 close();
        }
        $topic = $_POST['topic'];
        $desc = $_POST['description'];
        $userid = $_SESSION['id'];
        
        $sql = "INSERT INTO $db_task_tab ($db_task_id, $db_task_name, $db_task_description, $db_task_sdate, $db_task_edate, $db_task_userid, $db_task_priority, $db_task_done) VALUES (NULL, '$topic', '$desc', '$sdate', '$edate', $userid, $priority, 0)";

        if ($result = $connection->query($sql)){   
                $_SESSION['alert']= 'Dodano zadanie';

        }
    $tid=$connection->insert_id;
        
        //dodawanie załącznika
        if (isset($_FILES)){
            $time=date("ymdHis");
            if (move_uploaded_file($_FILES['attachment']['tmp_name'], 'attachments/'.$time.$_FILES['attachment']['name'])){
                $sql = "INSERT INTO $db_attachment_tab ($db_attachment_id, $db_attachment_name, $db_attachment_type, $db_attachment_size, $db_attachment_taskid) VALUES (NULL, '".$time.$_FILES['attachment']['name']."', '".$_FILES['attachment']['type']."', '".$_FILES['attachment']['size']."','$tid')";
                if ($result = $connection->query($sql));
                }
            unset($_FILES);
            }
        }
    $connection->close();

    header("Location: add_subtasks.php?id=$tid");

?>