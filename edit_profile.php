<?php
//edycja profilu uzytkownika - formularz
    session_start();

    if(!isset($_SESSION['online']) || !$_SESSION['online']){
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
                   
                    if ($_SESSION['function']=="2"){
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
                    if ($_SESSION['function']=="1"){
                       echo '<li>
                        <a  href="add_user.php"><i "></i> Dodaj użytkownika</a>
                    </li>';    
                   }
                   ?>
                   <li>
                        <a class="active-menu" href="edit_profile.php" ><i ></i>Edytuj profil</a>
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
        $sql = "SELECT $db_users_fname, $db_users_lname, $db_users_login, $db_users_email FROM $db_users_tab WHERE $db_users_id=".$_SESSION['id'];
        if ($result = $connection->query($sql))
        $row = $result->fetch_assoc();
        echo "<div class='stemat'><p class='left'>Imię: <br><input type='text' value='$row[$db_users_fname]' name='fname'  required/></p></div>";
        echo "<div class='stemat'><p class='left'>Nazwisko: <br><input type='text' value='$row[$db_users_lname]' name='lname'  required/></p></div>";
        echo "<div class='stemat'><p class='left'>Login: <br><input type='text' value='$row[$db_users_login]' name='login'  required/></p></div>";
        echo "<div class='stemat'><p class='left'>Adres email: <br><input type='email' value='$row[$db_users_email]' name='email' required/></p></div>";
        echo "<div class='stemat'><p class='left'>Nowe hasło: <br><input type='password' name='pass1' ></p></div>";
        echo "<div class='stemat'><p class='left'>Powtórz hasło: <br><input type='password' name='pass2' ></p></div>";
        }
?>
    <div style="clear:both"></div>
<div><p><button type="submit" >Zapisz</button></p></div>
<br><br>
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