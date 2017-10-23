<?php
/*
 * TEN PLIK NIE DZIAŁA!!!
 * docelowo: możliwośc edycji danych innych userów przez admina
 */
    session_start();

header('location: main.php');
exit();

    if(!isset($_SESSION['online']) || !$_SESSION['online'] || $_SESSION['function']>1){
            header('Location: index.php');
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
    font-size: 16px;"><div class="circle" id="circle"></div> <a href="nots.php" class="btn btn-danger square-btn-adjust">Powiadomienia</a>
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
                        <a  href="tasks.php" ><i "></i>Moje aktywne zadania</a>
                    </li>			
	 
                    <li>
                        <a  href="old_tasks.php" ><i "></i>Zamknięte zadania</a>
                    </li>
                   <?php 
                   
                   If ($_SESSION['function']=="2"){
                      echo '<li>
                        <a  href="add_tasks.php"><i "></i> Dodaj zadanie</a>
                    </li>';  
                      echo '<li> <a  href="add_subtasks.php"><i "></i> Dodaj podzadanie</a>
                    </li>';
                       echo '<li><a href="team_tasks.php"><i "></i> Zadania grupy</a>
                    </li>';
					 echo '<li><a href="managers.php"><i "></i> Zadania innych managerów</a>
                    </li>';
                   }
                   
                   
                   ?>
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
                     <h2>Edytuj profil</h2> 
                       </div>
                     </div>
                 <hr />
				 <div class="subtask-form">
<form action="editp.php" method="post">
<center>
<?php
    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){
        $sql = "SELECT $db_users_tab.$db_users_id, $db_users_tab.$db_users_login, $db_users_tab.$db_users_email, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname,$db_functions_tab.$db_functions_desc FROM $db_users_tab LEFT JOIN $db_functions_tab ON $db_users_tab.$db_users_function=$db_functions_tab.$db_functions_id";
        if ($result = $connection->query($sql)){
            echo '<div class="temat"><p class="stemat">';
            echo '<select class="task">';
            while ($row = $result->fetch_assoc()){
                $r[$row[$db_users_id]] = $row;
                echo "<option value='$row[$db_users_id]'>$row[$db_functions_desc] $row[$db_users_fname] $row[$db_users_lname]</option>";
            }
            echo "</select>";
            echo "<div class='stemat'><p class='tematt'>login: <br><input type='text' value='$row[$db_users_login]' name='login' class='stematp' style='width:40%' required/></p></div>";
            echo "<div class='stemat'><p class='tematt'>email: <br><input type='email' value='$row[$db_users_email]' name='email' required/></p></div>";
            echo "<div class='stemat'><p class='tematt'>nowe hasło: <br><input type='password' name='pass1' ></p></div>";
            echo "<div class='stemat'><p class='tematt'>powtórz hasło: <br><input type='password' name='pass2' ></p></div>";
        }
    }
?>
<div><p><button type="submit" >Zapisz</button></p></div>
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

<script type="text/javascript" src="js/datefield.js"></script>
<script type="text/javascript" src="js/datefield2.js"></script>
<script type="text/javascript" src="js/notifications.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>