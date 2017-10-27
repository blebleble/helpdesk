<?php
//zakładka dla managera, wyświetla wszystkie zadania i podzadania
	session_start();
	
	if(!isset($_SESSION['online']) || !$_SESSION['online'] || $_SESSION['function'] > 2)
	{
            header('Location: main.php');
            exit();
	}
  
        if(isset($_SESSION['alert'])){ 
            $alert= $_SESSION['alert'];
            $none='none';
            echo " <div class='alert'>
            <span class='closebtn'onclick=this.parentElement.style.display='none';>&times;</span> 
            <center> $alert </center>
            </div>";
            unset($_SESSION['alert']);
        }     
        
?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>HelpDesk</title>
	<!-- BOOTSTRAP STYLES-->
    <link href="template/assets/css/bootstrap.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="template/assets/css/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
     <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <link rel="Stylesheet" type="text/css" href="timeline/style.css" />
   
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
               
                <a class="navbar-brand" href="main.php"><?php echo $_SESSION['fname']." ".$_SESSION['lname']?></a> 
            </div>
    <div style="color: white;
    padding: 15px 50px 5px 50px;
    float: right;
    font-size: 16px;"> <div class="circle" id="circle"> </div><a href="nots.php" class="btn btn-danger square-btn-adjust">Powiadomienia</a>
        <a href="logout.php" class="btn btn-danger square-btn-adjust">Wyloguj</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
				<li class="text-center">
                                    
                                 <?php 
                    
                    require_once "database/dbinfo.php";
                    require_once "database/connect.php";
    
                    $connection = db_connection(); 
                    
                    $sql='SELECT COUNT(id) FROM cats';
                    $result= $connection->query($sql);
                    $row = $result->fetch_assoc();
                    $ile=$row['COUNT(id)'];
                    
                    $id= rand(1,$ile);
                    $sql2= "SELECT link FROM cats WHERE ID=$id";
                    $result2= $connection->query($sql2);
                    $row2 = $result2->fetch_assoc();
                    $path=$row2['link'];
                    
                    
                   echo " <img src='$path' class='user-image img-responsive'/>";
      
                       ?>
					</li>
				
                    <li>
                        <a   href="main.php" ><i "></i> Strona główna</a>
                    </li>
                    
                    <li>
                        <a href="tasks.php" ><i "></i>Moje aktywne zadania</a>
                    </li>			
	 
                  <li>
                        <a href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
                    </li>
                   <?php 
                   
                   If ($_SESSION['function']=="2" ){
                      echo '<li>
                        <a  href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';
                      echo '<li><a href="add_subtasks.php"><i "></i> Dodaj podzadanie</a>
                    </li>';
                      echo '<li><a class="active-menu" href="team_tasks.php"><i "></i> Zadania grupy</a>
                    </li>';
					 echo '<li><a href="managers.php"><i "></i> Zadania innych managerów</a>
                    </li>';
                      
                   } 
                   
                   
                     If ($_SESSION['function']=="1"){
                       echo '<li>
                        <a  href="add_user.php"><i "></i> Dodaj użytkownika</a>
                    </li>';    
                   }?>
                    <li>
                        <a  href="edit_profile.php" ><i "></i>Edytuj profil</a>
                    </li>
					
					<li>
                        <a  href="search.php" ><i "></i>Wyszukaj</a>
                    </li>
					<li>
                        <a  href="suspended.php" ><i "></i>Zawieszone</a>
                    </li>
					
                    	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Zadania grupy</h2> 
                          </div>
                     </div>
                 <hr />
                          
    <?php  
    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
           $sql = "SELECT $db_task_tab.$db_task_id, $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_task_tab LEFT JOIN $db_users_tab ON $db_task_tab.$db_task_userid = $db_users_tab.$db_users_id WHERE $db_task_tab.$db_task_hang = '0' AND $db_task_tab.$db_task_done = '0' AND $db_task_tab.$db_task_userid=".$_SESSION['id'];
           $result = $connection->query($sql);


    while($row = $result->fetch_assoc()){

            echo "<div class='teamtask-form'>";
            echo "<p class='team-taskform'";
            echo "<br><div style ='float:left;position: relative;left: 30px; width:40%'> nazwa zadania: $row[$db_task_name] <br> manager: $row[$db_users_fname]  $row[$db_users_lname] <br>  data rozpoczęcia: $row[$db_task_sdate]<br>  data zakończenia:  $row[$db_task_edate]<br> opis:  $row[$db_task_description]</div>";
            echo "<br><br><button style ='float:right;position: relative;right: 30px;' type='submit' id='utask'  onclick='deleteST($row[$db_task_id], 1)'>usuń</button>";
            echo "<br><br><button style ='float:right;position: relative;right: 30px;' type='submit' id='etask'  onclick='editTask($row[$db_task_id])'>edytuj</button>"; 
			echo "<br><br><button style ='float:right;position: relative;right: 30px;' type='submit' id='utask'  onclick='hangST($row[$db_task_id])'>zawieś</button>";
			echo "<br><br><button style ='float:right;position: relative;right: 30px;' type='submit' id='utask'  onclick='closeST($row[$db_task_id])'>zamknij</button>";			
            echo "<br><br><button type='submit' style='position: relative;left: 30px;' id='$row[$db_task_id]'  onclick='hide($row[$db_task_id])'>pokaż podzadania</button><br><br> <br>";
            echo "<div id='sh$row[$db_task_id]' style='display:none'>";
            echo "</p>";
            $sql = "SELECT $db_subtask_tab.$db_subtask_done, $db_subtask_tab.$db_subtask_name, $db_subtask_tab.$db_subtask_id, $db_subtask_tab.$db_subtask_description, $db_subtask_tab.$db_subtask_sdate, $db_subtask_tab.$db_subtask_edate, $db_subtask_tab.$db_subtask_conf, $db_subtask_tab.$db_subtask_block, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_subtask_tab LEFT JOIN $db_users_tab ON $db_subtask_tab.$db_subtask_userid = $db_users_tab.$db_users_id WHERE $db_subtask_taskid=$row[$db_task_id]"; 
            $result2 = $connection->query($sql);
            while ($row2=$result2->fetch_assoc()){ 
                echo "<p class='team-subtaskform'>";
                if ($row2[$db_subtask_done]){
                    $status = "zakończone";
                }
                else{
                    $status = "otwarte";
                }
                echo "nazwa podzadania: $row2[$db_subtask_name]<br> "
                        . "pracownik: $row2[$db_users_fname]  $row2[$db_users_lname] <br> "
                        . "data rozpoczęcia: $row2[$db_subtask_sdate]<br> "
                        . "data zakończenia:  $row2[$db_subtask_edate]<br> "
                        . "status: $status<br>"
                        . "opis:  $row2[$db_subtask_description]<br>";
                if ($row2[$db_subtask_conf]){
                    echo "<font color='green'>zatwierdzono</font><br>";
                }
                else{
                    echo "<font color='red'>niezatwierdzono</font><br>";
                }
                if ($row2[$db_subtask_block]){
                    echo "<i>użytkownik nie może wprowadzać zmian w dacie</i>";
                    $pref = 'od';
                }else{
                    echo "<i>użytkownik może wprowadzać zmiany w dacie</i>";
                    $pref = 'za';
                }echo "<br><br><button  type='submit' id='usub' onclick='deleteST($row2[$db_subtask_id], 0)'>usuń</button>";
                echo '  ';
                echo "<button type='submit' id='esub' onclick='editSubtask($row2[$db_subtask_id])'>edytuj</button>";
                echo '  ';
                echo "<button type='submit' onclick='blockSubtask($row2[$db_subtask_id])'>".$pref."blokuj zmiany</button><br><br>";
                echo "<br><br>";
                echo "</p>";
            }
            echo "</div>";
            echo "</div>";
            echo "<br><br><br>";
    }
    $connection -> close();
    ?>
                  
                 <br>
                 <br>
                 <br>        

    </div>

    
	</div>
</div>
                 
                 
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    
   
</body>
</html>
<script type="text/javascript" src="js/subtasks.js"></script>
<script type="text/javascript" src="js/notifications.js"></script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
