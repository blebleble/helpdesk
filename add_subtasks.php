<?php
//formularz dla managera z przydzielaniem podzadań
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

<?php include("sidebar.php"); ?>

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

 <?php sidebar(); ?>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Dodaj podzadanie</h2> 
                       </div>
                     </div>
                 <hr />
				 <div class="subtask-form">
<form action="addsubt.php" method="post">
<center>
<?php
    
    
    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    $sql = "SELECT $db_users_fname, $db_users_lname, $db_functions_desc, $db_users_id FROM $db_users_tab INNER JOIN $db_functions_tab ON $db_users_function = $db_functions_id WHERE $db_users_function>1 ORDER BY $db_users_function, $db_users_lname ASC";
    $result = $connection->query($sql);
        echo '<div class="temat"><p class="stemat">';
        echo '<select name="user" class="task" required>';
        echo '<option value="">Wybierz osobę</option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row[$db_users_id].'">'.$row[$db_functions_desc].' '.$row[$db_users_fname].' '.$row[$db_users_lname].'</option>';
        }
        echo '</select>';
    echo "<br/><br/>";
    $id = $_SESSION['id'];
    if (isset($_GET['id'])){
        
    $sql = "SELECT $db_task_id, $db_task_name, $db_task_edate, $db_task_userid FROM $db_task_tab WHERE $db_task_userid = $id AND $db_task_id =".$_GET['id'];
    $result2 = $connection->query($sql);
    $row2 = $result2->fetch_assoc();
                 
            
    $sql = "SELECT $db_task_id, $db_task_name, $db_task_edate, $db_task_userid FROM $db_task_tab WHERE $db_task_userid = $id AND NOT $db_task_id =".$_GET['id'];
    $result = $connection->query($sql);
        echo '<select name="task" class="task" required>';
        echo '<option value="'.$row2[$db_task_id].'">'.$row2[$db_task_name] .' </option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row[$db_task_id].'">'.$row[$db_task_name].'</option>';
        }
    echo '</select>';
    
        }else{
            
         $sql = "SELECT $db_task_id, $db_task_name, $db_task_edate, $db_task_userid FROM $db_task_tab WHERE $db_task_userid = $id ";
    $result = $connection->query($sql);
        echo '<select name="task" id="select_task" class="task" required>';
        echo '<option value=""> Wybierz zadanie </option>';
        while($row = $result->fetch_assoc()) {
            echo '<option value="'.$row[$db_task_id].'">'.$row[$db_task_name].'</option>';
        }
    echo '</select>';       
            
        }
    
    
    
    
    $connection->close();
?>
        <div class="stemat"><p class="tematt">Temat podzadania: <br><input type="text" list="subtasks_list" name="topic" autocomplete="off" class="stematp" style="width:90%" required/></p></div>
        <datalist id="subtasks_list">
          <option value="Boston">
		   <option value="Boston">
		    <option value="Boston">
        </datalist>
        <div class="termin"><p class="termint">Termin rozpoczęcia: <input type="date" id="calendar" name="stime" required/></p></div>
        <div class="termin"><p class="termint">Termin wykonania: <input type="date" id="calendar2" name="etime" required/></p></div>
        <div class="stresc"><p class="tresct">Treść podzadania: <br><textarea name="description" id="trescp" rows="6" style="width:90%" required></textarea></p></div>
        <div><p><button type="submit" >Stwórz</button></p></div>
		</center>
</form>
</div>
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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="js/datefield.js"></script>
<script type="text/javascript" src="js/datefield2.js"></script>
<script type="text/javascript" src="js/taskid.js"></script>
<script type="text/javascript" src="js/notifications.js"></script>
<script>


$( ".w3-button" ).click(function() {
  var element= this.name;
  $( ".panel"+element ).toggle();
});
</script>

