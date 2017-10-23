<?php
//oś czasu ze starymi (zrobionymi) zadaniami
	session_start();
	
	if(!isset($_SESSION['online']) || !$_SESSION['online']){
		header('Location: index.php');
		exit();
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
    font-size: 16px;"> <div class="circle" id="circle"></div> <a href="nots.php" class="btn btn-danger square-btn-adjust">Powiadomienia</a>
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
                        <a class="active-menu" href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
                    </li>
                   <?php 
                   
                   If ($_SESSION['function']=="2" ){
                      echo '<li>
                        <a  href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';
                      echo '<li><a href="add_subtasks.php"><i "></i> Dodaj podzadanie</a>
                    </li>';
                       echo '<li><a href="team_tasks.php"><i "></i> Zadania grupy</a>
                    </li>';
					 echo '<li><a href="managers.php"><i "></i> Zadania innych managerów</a>
                    </li>';
                   } 
                   
                   
                     If ($_SESSION['function']=="1"){
                       echo '<li>
                        <a  href="add_user.php"><i "></i> Dodaj użytkownika</a>
                    </li>';    
                   }
                   ?>
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
                     <h2>Zamknięte zadania</h2> 
                       </div>
                     </div>
                 <hr />
                 <br>
                 <br>
                 <br>
                   
                     
                     
                 <div style="float:left; width:50%">   
                     <center><font size=4px><i> Zadania krótsze niż tydzień </i></font></center>
                 <div class="container">
	<div class="row">
    
        <div class="timeline-centered">

        <?php  
        require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){
        $sql = "SELECT $db_subtask_tab.$db_subtask_id, $db_subtask_tab.$db_subtask_taskid, $db_subtask_tab.$db_subtask_name, $db_subtask_tab.$db_subtask_sdate, $db_subtask_tab.$db_subtask_edate, $db_subtask_tab.$db_subtask_description FROM $db_subtask_tab INNER JOIN $db_task_tab ON $db_subtask_tab.$db_subtask_taskid = $db_task_tab.$db_task_id WHERE DATEDIFF( $db_subtask_tab.$db_subtask_edate, $db_subtask_tab.$db_subtask_sdate )< 7  AND $db_subtask_tab.$db_subtask_done='1' AND $db_subtask_tab.$db_subtask_userid =". $_SESSION['id']." ORDER BY $db_task_tab.$db_task_priority DESC, $db_subtask_tab.$db_subtask_edate ASC";
        $result = $connection->query($sql);
        while($row = $result->fetch_assoc()){       
            $sql = "SELECT $db_task_tab.$db_task_priority, $db_subtask_tab.$db_subtask_id, $db_task_tab.$db_task_id, $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_subtask_tab, $db_task_tab LEFT JOIN $db_users_tab ON $db_task_tab.$db_task_userid = $db_users_tab.$db_users_id WHERE $db_task_tab.$db_task_id =".$row[$db_subtask_taskid];
            $result2 = $connection->query($sql);
            $row2=$result2->fetch_assoc();
            echo "<br/>";
            echo  '<article class="timeline-entry">
                  <div class="timeline-entry-inner">';

            if ($row2[$db_task_priority] == 1){
                echo '<div class="timeline-icon bg-priority">';}
            else{
                echo '<div class="timeline-icon bg-success">';}

            echo  '<i class="entypo-feather"></i>
                  </div>
                  <div class="timeline-label">';   
            echo "<h2><a class='dymek' href ='tasks_all.php?sid=$row[$db_subtask_id]&tid=$row[$db_task_id]' >$row[$db_subtask_name]<span><br> <br>Nazwa zadania głównego: $row2[$db_task_name] <br> Manager: $row2[$db_users_fname] $row2[$db_users_lname]<br> Data rozpoczęcia: $row2[$db_task_sdate] <br> Data zakończenia: $row2[$db_task_edate]<br> Opis: $row2[$db_task_description]<br> <br>----------------------------------------------------<br> </span> </a><span></span><h2>"; 

            echo "<a><span>Data rozpoczęcia: $row[$db_subtask_sdate]  <br> ";
            echo "Data zakończenia: $row[$db_subtask_edate]<br><br>";
            echo "Opis zadania: <br> $row[$db_subtask_description]";
            echo "<form action='unactive_subtask.php' method='post'>";
            echo "<input type='hidden' name='active' value=0>";
            echo "<input type='hidden' name='sid' value=$row[$db_subtask_id]>";
            echo "<br /><button type='submit'>Przenieś do aktywnych</button></center>";
            echo "</form>";
            echo'</div>
                 </div>
                 </article>';
            }
        }
    $connection -> close();
    ?>
        

    </div>

        </div>
	</div>
</div>
                 
                     
                     
                     
                     
                     
  <div style="float:left; width:50%"> 
      <div style='color: black; text-decoration: none'> <center><font size=4px><i> Zadania dłuższe niż tydzień </i></font></center></div>
  <div class="container">
	<div class="row">
    
        <div class="timeline-centeredleft">

        <?php  
        require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){
        $sql = "SELECT $db_subtask_tab.$db_subtask_id, $db_subtask_tab.$db_subtask_taskid, $db_subtask_tab.$db_subtask_name, $db_subtask_tab.$db_subtask_sdate, $db_subtask_tab.$db_subtask_edate, $db_subtask_tab.$db_subtask_description FROM $db_subtask_tab INNER JOIN $db_task_tab ON $db_subtask_tab.$db_subtask_taskid = $db_task_tab.$db_task_id WHERE DATEDIFF( $db_subtask_tab.$db_subtask_edate, $db_subtask_tab.$db_subtask_sdate )>=7 AND $db_subtask_tab.$db_subtask_done='1' AND $db_subtask_tab.$db_subtask_userid =". $_SESSION['id']." ORDER BY $db_task_tab.$db_task_priority DESC, $db_subtask_tab.$db_subtask_edate ASC";
        $result = $connection->query($sql);
        while($row = $result->fetch_assoc()){       
            $sql = "SELECT $db_task_tab.$db_task_priority, $db_subtask_tab.$db_subtask_id, $db_task_tab.$db_task_id, $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_subtask_tab, $db_task_tab LEFT JOIN $db_users_tab ON $db_task_tab.$db_task_userid = $db_users_tab.$db_users_id WHERE $db_task_tab.$db_task_id =".$row[$db_subtask_taskid];
            $result2 = $connection->query($sql);
            $row2=$result2->fetch_assoc();
            echo "<br/>";
            echo  '<article class="timeline-entry">
                  <div class="timeline-entry-inner">';

            if ($row2[$db_task_priority] == 1){
                echo '<div class="timeline-icon bg-priority">';}
            else{
                echo '<div class="timeline-icon bg-success">';}

            echo  '<i class="entypo-feather"></i>
                  </div>
                  <div class="timeline-label">';   
            echo "<h2><a class='dymek' href ='tasks_all.php?sid=$row[$db_subtask_id]&tid=$row[$db_task_id]' >$row[$db_subtask_name]<span><br> <br>Nazwa zadania głównego: $row2[$db_task_name] <br> Manager: $row2[$db_users_fname] $row2[$db_users_lname]<br> Data rozpoczęcia: $row2[$db_task_sdate] <br> Data zakończenia: $row2[$db_task_edate]<br> Opis: $row2[$db_task_description]<br> <br>----------------------------------------------------<br> </span> </a><span></span><h2>"; 

            echo "<a><span>Data rozpoczęcia: $row[$db_subtask_sdate]  <br> ";
            echo "Data zakończenia: $row[$db_subtask_edate]<br><br>";
            echo "Opis zadania: <br> $row[$db_subtask_description]";
            echo "<form action='unactive_subtask.php' method='post'>";
            echo "<input type='hidden' name='active' value=0>";
            echo "<input type='hidden' name='sid' value=$row[$db_subtask_id]>";
            echo "<br /><button type='submit'>Przenieś do aktywnych</button></center>";
            echo "</form>";
            echo'</div>
                 </div>
                 </article>';
            }
        }
    $connection -> close();
    ?>
        

    </div>

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
<script type="text/javascript" src="js/notifications.js"></script>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>