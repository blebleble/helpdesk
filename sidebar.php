<?php

// definicja funkcji stopki
function sidebar()
{
  echo '
  <li><a href="main.php" onclick="activeMenu()" class="w3-bar-item w3=button" id="active1">Strona główna</a></li>
  <li><a class="w3-bar-item w3-button" name="a" style="cursor:pointer">Zadania</a></li>
  <div class="panela">
  <div class="hover" id="activesub1"><li><a href="tasks.php" class="w3-bar-item w3-button sidelist">Moje aktywne zadania</a></li></div>
  <div class="hover" id="activesub2"><li><a href="old_tasks.php" class="w3-bar-item w3-button sidelist">Zamknięte zadania</a></li></div>
  <div class="hover" id="activesub3"  ><li><a href="suspended.php" class="w3-bar-item w3-button sidelist">Zawieszone</a></li></div>';

                   
                   If ($_SESSION["function"]=="2" )
                   {
                      echo '
                      <div class="hover" id="activesub4"><li><a href="team_tasks.php" class="w3-bar-item w3-button sidelist">Zadania grupy</a></li></div>
                      <div class="hover" id="activesub5"><li><a href="managers.php" class="w3-bar-item w3-button sidelist">Zadania innych menadżerów</a></li></div>';
                   }
                   
echo '</div>';


                If ($_SESSION["function"]=="2" ){
               echo '<li><a class="w3-bar-item w3-button" name="b" style="cursor: pointer">Dodaj</a></li>';
       
  }
  
echo'
<div class="panelb">
    <div class="hover" id="activesub6"><li><a href="add_tasks.php" class="w3-bar-item w3-button sidelist">Dodaj zadanie</a><li></div>
    <div class="hover" id="activesub7"><li><a href="add_subtasks.php" class="w3-bar-item w3-button sidelist">Dodaj podzadanie</a><li></div>
</div>

    <li><a href="search.php" class="w3-bar-item w3-button" id="active2">Wyszukaj</a></li>
               
            </div>'; 
 }

?>
