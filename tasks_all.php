<?php
//wyświetlanie szczegółów aktywnego podzadania: informacje, komentarze, załączniki
    session_start();

    if(!isset($_SESSION['online']) || !$_SESSION['online']){
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
                   }?>
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
                     <h2></h2> 
                       </div>
                     </div>
                 <hr />
               
                     <?php  
                    require_once "database/dbinfo.php";
					require_once "database/connect.php";
                    
                    $connection = db_connection();
                    if ($connection != false){
                            echo "<div class='subtask-form'><div style='margin-left:10px'>"; ///poczatek szarego tla
                            echo "<div style='float:left; width:57%; height:auto'>"; ///float left 57%
                            
                            $tid= $_GET['tid'];    
                            $sid= $_GET['sid'];
                            $sql = "SELECT $db_subtask_taskid, $db_subtask_name, $db_subtask_sdate, $db_subtask_edate, $db_subtask_description FROM $db_subtask_tab WHERE $db_subtask_id=$sid";
                            $result = $connection->query($sql);
                            while($row = $result->fetch_assoc()){
                                $sql = "SELECT $db_subtask_tab.$db_subtask_id,$db_subtask_tab.$db_subtask_block,$db_subtask_tab.$db_subtask_conf, $db_task_tab.$db_task_name, $db_task_tab.$db_task_description, $db_task_tab.$db_task_sdate, $db_task_tab.$db_task_edate, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_subtask_tab, $db_task_tab LEFT JOIN $db_users_tab ON $db_task_tab.$db_task_userid = $db_users_tab.$db_users_id WHERE $db_subtask_id=$sid AND $db_task_tab.$db_task_id =".$row[$db_subtask_taskid];
                                $result2 = $connection->query($sql);
                                $row2=$result2->fetch_assoc();
                                echo "<br>Nazwa zadania głównego: $row2[$db_task_name] <br>";
                                echo "Manager: $row2[$db_users_fname] $row2[$db_users_lname]<br>";
                                echo "Data rozpoczęcia: $row2[$db_task_sdate] <br>";
                                echo "Data zakończenia: $row2[$db_task_edate]<br>";
                                echo "Opis: <br>$row2[$db_task_description]<br>"; 
                                echo "<br><br><br>";
                                echo "Nazwa podzadania: $row[$db_subtask_name]<br><br>";
                                echo "<form action='add_date.php' method='post'>";
                                $sdate= $row[$db_subtask_sdate];
                                $edate= $row[$db_subtask_edate];
                                if($row2[$db_subtask_block]=='1'){
                                    echo "Termin rozpoczęcia: <input type='date' id='calendar' value= $sdate name='stime' disabled/><br><br>";
                                    echo "Termin wykonania: <input type='date' id='calendar2' value=$edate name='etime' disabled/><br><br>";
                                }else {
                                    echo "Termin rozpoczęcia: <input type='date' id='calendar' value= $sdate name='stime'/><br><br>";
                                    echo "Termin wykonania: <input type='date' id='calendar2' value=$edate name='etime'/><br><br>";
                                }
                                echo "<input type='hidden' name='tid' value=$tid>";
                                echo "<input type='hidden' name='sid' value=$sid>";
                                echo "Opis zadania: <br> $row[$db_subtask_description]<br><br>";
                                if ($row2[$db_subtask_conf]==0){
                                    echo "<i>oczekuje na zatwierdzenie</i>";
                                }
                                if($row2[$db_subtask_block]=='1'){
                                    echo "<br><button type='submit' disabled>Zatwierdź datę</button>";}
                                else{
                                    echo "<br><button type='submit'>Zatwierdź datę</button>";}
                                echo "</form>";
                                // $connection->close();
                            }
                    
    echo "<br><br><br><br><br><b>KOMENTARZE!!!!</b><br><br>";
               
        $sql= "select $db_messages_tab.$db_messages_id, $db_messages_tab.$db_messages_date, $db_messages_tab.$db_messages_text, $db_users_tab.$db_users_fname, $db_users_tab.$db_users_lname FROM $db_messages_tab LEFT JOIN $db_users_tab ON $db_messages_tab.$db_messages_userid= $db_users_tab.$db_users_id WHERE $db_messages_taskid=$tid ";
        $result = $connection->query($sql);

        while($row = $result->fetch_assoc()){       
            //usuwanie komentarzy (admin lub manager)
            if ($_SESSION['function'] <= 2){
                echo "<form action=\"delete_ac.php\" method=\"post\" onsubmit=\"return (del(4))\">";
                echo "<input type=\"hidden\" name=\"tid\" value=$tid>";
                echo "<input type=\"hidden\" name=\"sid\" value=$sid>";
                echo "<input type=\"hidden\" name=\"id\" value=$row[$db_messages_id]>";
                echo "<div style='float:left'><input type=\"image\" src=\"template/assets/img/trash.png\" onClick=\"this.form.submit()\"></div>";
                echo "</form>";
            }
            else echo "<br>";
            echo "Użytkownik: $row[$db_users_fname]  $row[$db_users_lname],  $row[$db_messages_date]";
            echo "<br>";
            echo $row[$db_messages_text];
            echo "<br><br>";
        }
        //dodawanie komentarzy
        echo "<form action='addcom.php' method='post'>";
        echo "<textarea name='comment' id='trescp' rows='6' style='width:50%'></textarea><br><br>";
        echo "<input type='hidden' name='sid' value=$sid>";
        echo "<input type='hidden' name='tid' value=$tid>";
        echo "<br /><button type='submit'>Dodaj komentarz</button></form>";
        echo "<br><br>";
        echo "</div>"; ///zakończenie div 57%
                            
        echo"<div style='float:left; width:43%; height:auto'>"; //loat 43%                    
        echo "<br><b>ZAŁĄCZNIKI!!!</b><br><br>";

        $sql = "SELECT $db_attachment_size, $db_attachment_name, $db_attachment_id, $db_attachment_desc FROM $db_attachment_tab WHERE $db_attachment_taskid = '$tid'";
        $result = $connection->query($sql);
        while ($row = $result->fetch_assoc()){
            
              //usuwanie załączników (admin lub manager)
            if ($_SESSION['function'] <= 2){
                echo "<form action=\"delete_ac.php\" method=\"post\" onsubmit=\"return (del(5))\">";
                echo "<input type=\"hidden\" name=\"tid\" value=$tid>";
                echo "<input type=\"hidden\" name=\"sid\" value=$sid>";
                echo "<input type=\"hidden\" name=\"id\" value=$row[$db_attachment_id]>";
                echo "<input type=\"hidden\" name=\"filename\" value=$row[$db_attachment_name]>";
                echo "<div style='float:left'><input type=\"image\" src=\"template/assets/img/trash.png\" onClick=\"this.form.submit()\"></div>";
                echo "</form>";
            }
            
            echo "<a href=\"download.php?id=$row[$db_attachment_id]&sid=$sid&tid=$tid\">".substr($row[$db_attachment_name], 12)."</a>\t";
            $attachsize = $row[$db_attachment_size];
            if ($attachsize >= 1073741824) {
                $attachsize = (round($attachsize / 1073741824 * 100) / 100) . "gb";
            } elseif ($attachsize >= 1048576) {
                $attachsize = (round($attachsize / 1048576 * 100) / 100) . "mb";
            } elseif ($attachsize >= 1024) {
                $attachsize = (round($attachsize / 1024 * 100) / 100) . "kb";
            } else {
                $attachsize = $attachsize . "b";
            }
            echo "($attachsize)<br>";
            echo "<i>$row[$db_attachment_desc]</i><br>";
          
        }
        //dodawanie załączników
        echo "<form enctype=\"multipart/form-data\" action=\"attach.php\" method=\"post\">";
        echo "<p>Załącz plik: <br><input type=\"file\" size=\"32\" name=\"attachment\" value=\"\"/></p>";
        echo "<p>Opis <br><textarea name=\"desc\" rows='2' style='width:60%'></textarea></p>";
        echo "<input type='hidden' name='sid' value=$sid>";
        echo "<input type='hidden' name='tid' value=$tid>";
        echo "<button type=\"submit\">Wyślij</button></center>";
        echo "</form></div>";/// koniec float 43%
        
        
        echo "<div style='clear:both'>";
        echo "<br><br><br><br>";
         echo"</div></div>";}    /// koniec szarego tła i marginesu 10px
        $connection -> close();
?>
                
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
