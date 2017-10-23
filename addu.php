<?php  
//dodawanie użytkownika do bazy, przekierowanie z add_user 
session_start();

    if (empty($_POST)){
        header('Location: add_user.php');
        exit();
    }

    require_once "database/dbinfo.php";
require_once "database/connect.php";
    
    $connection = db_connection();
    if ($connection != false){
        $login = $_POST['login'];
        $sql = "SELECT COUNT($db_users_id) AS 'ile' FROM $db_users_tab WHERE $db_users_login='$login'";
        $result = $connection->query($sql);
        $row = $result->fetch_assoc();
        if ($row['ile'] > 0){
            
            $_SESSION['alert']='Użytkownik o podanym loginie już istnieje';
            header('Location: add_user.php');
            close();
        }
        
        $fname = ucwords($_POST['fname']);
        $lname = ucwords($_POST['lname']);
        $email = $_POST['email'];
        $function = $_POST['function'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        if ($pass1 == $pass2){
            $hash_pass = md5($pass1);
            $sql = "INSERT INTO $db_users_tab ($db_users_id,$db_users_fname,$db_users_lname,$db_users_email,$db_users_login,$db_users_pass,$db_users_function) VALUES (NULL,'$fname','$lname','$email','$login','$hash_pass',$function)";
            if ($connection->query($sql)){
                  $_SESSION['alert']='Dodano użytkownika';
            }
        }
        else {
            $_SESSION['alert']="Błąd: hasła nie są jednakowe";
        }
    $connection->close();
    }
    header('Location: add_user.php');
?>