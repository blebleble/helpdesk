<?php
//strona główna - kalendarz z podzadaniami i (dla managera) z zadaniami
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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
   <!-- KALENDARZ -->
   <link rel='stylesheet' href='calendar/fullcalendar.css' />
	<script src='calendar/lib/jquery.min.js'></script>
	<script src='calendar/lib/moment.min.js'></script>
        <script src='calendar/fullcalendar.js'></script>
        <script src='calendar/locale/pl.js'></script>
   
        
      <script>
	$(document).ready(function() {
            var date= new Date();
        
		$('#calendar').fullCalendar({
                        height: 700,
			defaultDate: date,
			eventLimit: true,
			events: [ 
       //Z TYM COŚ TRZEBA ZROBIĆ!!!!!!!!!! ////// coś xD
                          <?php 

                        require_once "database/dbinfo.php";
						require_once "database/connect.php";
                        
                        $connection = db_connection();
                        if ($connection != false){
                            $sql= "select $db_subtask_name, $db_subtask_sdate, $db_subtask_edate, $db_subtask_id, $db_subtask_taskid FROM $db_subtask_tab WHERE $db_subtask_done='0' AND $db_subtask_userid =". $_SESSION['id'];                        
                            $result = $connection->query($sql);
                            
                            while($row = $result->fetch_assoc()){
                                $edate = strtotime("$row[$db_subtask_edate] + 1 day");
                                $edate = date("Y-m-d", $edate);
                                $rows= "{url:'tasks_all.php?sid=$row[$db_subtask_id]&tid=$row[$db_subtask_taskid]' , title: '$row[$db_subtask_name]', start: '$row[$db_subtask_sdate]', end: '$edate'},";    
                                echo $rows;
                            }
                      
                            $connection->close();
                        }
                        //else info o błędzie
?>  
			]
		});
		
	});
	</script>
        
<?php 
If($_SESSION['function']=="2" ){ ///// <-------  tuuuuu sie to zaczyna ?>  


  <script>
$(document).ready(function() {
    var date= new Date();

        $('#calendar2').fullCalendar({
                height: 700,
                defaultDate: date,
                eventLimit: true,
                events: [ 

                  <?php 
        //Z TYM TEŻ
                require_once "database/dbinfo.php";
				require_once "database/connect.php";
                
                $connection = db_connection();
                if ($connection != false){
                    $sql= "select $db_task_name, $db_task_sdate, $db_task_edate FROM $db_task_tab WHERE $db_task_done='0' AND $db_task_userid =". $_SESSION['id'];                        
                    $result = $connection->query($sql);

                    while($row = $result->fetch_assoc()){
                        $edate= strtotime("$row[$db_task_edate] + 1 day");
                        $edate = date("Y-m-d", $edate);
                        $rows= "{title: '$row[$db_task_name]', start: '$row[$db_task_sdate]', end: '$edate'},";    
                        echo $rows;
                    }
                $connection->close();
                }
                ?>  
                ]
        });

});
              </script><?php } //< tu konczy :D-------WTF PO CO TO????      ediiiiiit tak więc jak sobie zauwazysz to nasz kod z php zaczyna sie w linii 75 i to jest jego zamknięcie ponieważ cały ten kod js wykonye sie tylko wtedy session function=2 ?> 
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
        <a href="logout.php" class="btn btn-danger square-btn-adjust">Wyloguj</a> 
    </div>
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
                        <a  class="active-menu" href="main.php" ><i "></i> Strona główna</a>
                    </li>
                    
                    <li>
                        <a  href="tasks.php" ><i "></i> Moje aktywne zadania</a>
                    </li>			
	 
                    <li>
                        <a href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
                    </li>
						<li>
                        <a  href="suspended.php" ><i "></i>Zawieszone</a>
                    </li>
                   <?php 
                   
                   If ($_SESSION['function']=="2" ){
                      echo '<li>
                        <a  href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';  
                      echo '<li>
                        <a  href="add_subtasks.php"><i "></i> Dodaj podzadanie</a>
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
				
                    	
                </ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Strona główna</h2> 
                       </div>
                     </div>
                 <hr /><?php
                        if($_SESSION['function']=="2" ){
                            echo "<br>";
                            echo "<h2>Zadania</h2>" ;
                            echo "<br><br>";
                            echo "<div id='calendar2'></div>";
                            } ?>
                 <br>
                     <h2>Podzadania</h2>
                     <br>
                     <br>      
                     <div id='calendar'></div>
                 <br>         
                 
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>

</body>
</html>
<script type="text/javascript" src="js/notifications.js"></script>
