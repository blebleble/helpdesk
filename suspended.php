<?php
//wyświetlanie wyszukiwarki niezrobionych (done = 0) i zawieszonych (hang = 1) zadań
//formularz dla managera z przydzielaniem podzadań (?????)
        session_start();
	
	if(!isset($_SESSION['online']) || !$_SESSION['online'] || $_SESSION['function'] > 2) //function := 2 ==> manager
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
	<link rel="stylesheet" href="table/css/style.css">
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
        <div class="dropdown">
  <button class="dropbtn">Profil</button>
    <div class="dropdown-content">
    <a href="edit_profile.php" class="w3-bar-item w3-button">Edytuj profil</a>
    <a href="logout.php">Wyloguj</a> 
    </div>
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

  <li><a href="main.php" class="w3-bar-item w3-button">Strona główna</a></li>
  <li><a class="w3-bar-item w3-button active-menu" name='a' style="cursor:pointer">Zadania</a></li>
  <div class="panela">
  <div class="hover"><li><a href="tasks.php" class="w3-bar-item w3-button sidelist">Moje aktywne zadania</a></li></div>
  <div class="hover"><li><a href="old_tasks.php" class="w3-bar-item w3-button sidelist">Zamknięte zadania</a></li></div>
  <div class="hover"><li><a href="suspended.php" class="w3-bar-item w3-button sidelist">Zawieszone</a></li></div>
<?php 
                   
                   If ($_SESSION['function']=="2" ){
                      echo '<div class="hover"><li><a href="team_tasks.php" class="w3-bar-item w3-button sidelist">Zadania grupy</a></li></div>';
                      echo '<div class="hover"><li><a href="managers.php" class="w3-bar-item w3-button sidelist">Zadania innych menadżerów</a></li></div>';
                   }
                   ?>
</div>

<?php
                If ($_SESSION['function']=="2" ){
                echo' <li><a class="w3-bar-item w3-button" name="b" style="cursor: pointer">Dodaj</a></li>';
       
  }
  ?>
<div class="panelb">
    <div class="hover"><li><a href="add_tasks.php" class="w3-bar-item w3-button sidelist">Dodaj zadanie</a><li></div>
    <div class="hover"><li><a href="add_subtasks.php" class="w3-bar-item w3-button sidelist">Dodaj podzadanie</a><li></div>
</div>

  <li><a href="search.php" class="w3-bar-item w3-button">Wyszukaj</a></li>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Wyszukaj zawieszone zadania</h2> 
                       </div>
                     </div>
                 <hr />
				 
				 
				 <div style='margin-left:70%' > wyszukaj <input id='search' type='text'> </div> 
				
				<table class="responstable" id='table'>
        <thead>                          
            <tr>
                <th>Data ropoczęcia</th>
                <th>Data zakończenia</th>
                <th>Nazwa zadania</th>
                <th>Opis</th>
                <th></th>
            </tr>
        </thead>
   <tbody>
   
   <?php
  
   require_once "database/dbinfo.php";
   require_once "database/connect.php";
  
    
    $connection = db_connection();
           $sql = "Select * FROM $db_task_tab WHERE $db_task_done = '0' AND $db_task_hang='1'";
           $result = $connection->query($sql);
            while ($row=$result->fetch_assoc()){    
                    echo "<tr  onMouseover=this.bgColor='#D9E4E6' onMouseout=this.bgColor='white' onclick='showAll($row[$db_task_id])'>";
                    echo "<td> $row[$db_task_sdate]</td>";
                    echo "<td> $row[$db_task_edate]</td>";
                    echo "<td> $row[$db_task_name]</td>";
                    echo "<td> $row[$db_task_description]</td>";
                    echo "<td>";
                    if ($row[$db_task_userid]== $_SESSION['id']){
                    echo "<button type='submit' onclick='event.stopPropagation();hangST($row[$db_subtask_taskid])'>Reaktywuj</button></td>";}

            }
   
   ?>   
        </tr> 
		</tbody> 
	</table>                                              
   
				 		 
				 
				 
    
	</div>
</div>
                 
                 
               
    </div>
             <!-- /. PAGE INNER  -->
            </div>
         <!-- /. PAGE WRAPPER  -->
        </div>
    
   
</body>
</html>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="js/datefield.js"></script>
<script type="text/javascript" src="js/datefield2.js"></script>
<script type="text/javascript" src="js/notifications.js"></script>
<script type="text/javascript" src="js/table.js"></script>
<script type="text/javascript" src="js/subtasks.js"></script>
<script>


$( ".w3-button" ).click(function() {
  var element= this.name;
  $( ".panel"+element ).toggle();
});
</script>