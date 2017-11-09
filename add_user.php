<?php
//formularz dla admina z tworzeniem nowego użytkownika
    session_start();

    if ($_SESSION['function']!=1) //function := 1 ==> admin
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

   <style>
    #activesub8 {background-color: #e0610d;}
    .panelb {display: block;}
  </style>
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
                     <h2>Dodaj użytkownika</h2> 
                       </div>
                     </div>
                 <hr />
                     <div class="subtask-form">
                     <form action="addu.php" method="post">
                         <center>
		
                         <div class="stemat"><p class="left">Imię: <br> <input type="text" name="fname" required/></p></div>
                         <div class="stemat"><p class="left">Nazwisko: <br> <input type="text" name="lname" required/></p></div>
                         <div class="stemat"><p class="left">Login: <br> <input type="text" name="login" required/></p></div>
                         <div class="stemat"><p class="left">Adres email: <br> <input type="email" name="email" required/></p></div>
                         <div class="stemat"><p class="left">Hasło: <br> <input type="password" name="pass1" required /></p></div>
                         <div class="stemat"><p class="left">Powtórz hasło: <br> <input type="password" name="pass2" required /></p><br></div>
                         <div class="stemat"><p class="left">Funkcja: <br>
                        <select name="function" required>
				<option value="1">admin</option>
				<option value="2">manager</option>
				<option value="3">grafik</option>
				<option value="4">wykonawca</option>
                                <option value="5">montażysta</option>
                                <br />
			</select></p></div>
                        <div><p class="left"><br><button type="submit">Dodaj</button></p></div>
                            <div style="clear:both"></div>
                            <br><br><br>
                        </center> 
                        
                </form>
                 

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
<script>


$( ".w3-button" ).click(function() {
  var element= this.name;
  $( ".panel"+element ).toggle();
});
</script>
