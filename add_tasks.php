
<?php
//formularz dla managera z tworzeniem zadańs
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
 
   <style>
    #activesub6 {background-color: #e0610d;}
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
    font-size: 16px;"> <div class="circle"id="circle"></div><a href="nots.php" class="btn btn-danger square-btn-adjust">Powiadomienia</a>
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
                        <h2>Dodaj zadanie</h2> 
                    </div>
                </div>
                 <hr />
        <div class="subtask-form">
        <center>
        <br />
<form enctype="multipart/form-data" action="addt.php" method="post" id="formularz">
        <div class="stemat"><p class="tematt">Temat zadania: <br /><input type="text" name="topic" class="stematp" required/></p></div>
        <div class="stemat"><p class="termint"> Priorytet:
            <input type="radio" name="priority" value="1"/> tak 
            <input type="radio" name="priority" value="0" checked/> nie </p></div>
        <div class="termin"><p class="termint">Termin rozpoczęcia: <input type="date" id= "calendar" name="stime" class="terminp" required/></p></div>
        <div class="termin"><p class="termint">Termin wykonania: <input type="date" id= "calendar2" name="etime" class="terminp" required/></p></div>
        <div class="stresc"><p class="tresct">Treść zadania: <br /><textarea name="description" id="trescp" rows="6" style="width:88%" required></textarea></p></div>
        <div class="stresc"><p class="tresct">Załącz plik: <br /><input type="file" size="32" name="attachment" value=""/><p/><div/>
                <div class="stresc"><button type="submit">Dodaj</button></center><div/>
</form>
                 <br>
                 <br>
             <!-- #f5f5f6 kolor tła guzika -->        
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
<script>


$( ".w3-button" ).click(function() {
  var element= this.name;
  $( ".panel"+element ).toggle();
});
</script>
