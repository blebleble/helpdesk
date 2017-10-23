<?php
//pobieranie załączników, przekierowanie z tasks_all
session_start();
if (empty($_GET)){
    header("Location: main.php");
    exit();
}
require_once 'database/dbinfo.php';
require_once "database/connect.php";

$id = $_GET['id'];

$connection = db_connection();
if ($connection != false){
    $sql = "SELECT $db_attachment_name, $db_attachment_size, $db_attachment_type FROM $db_attachment_tab WHERE $db_attachment_id='$id'";
    if ($result = $connection->query($sql)){
        $row = $result->fetch_assoc();
        $name = $row[$db_attachment_name];
        clearstatcache();
        if (file_exists("attachments/".$name) && $name!=''){
            header("Cache-control: private");
            header("Content-Type: ".$row[$db_attachment_type]);
            header("Content-Description: File Transfer");
            header("Content-Length: ".$row[$db_attachment_size]);
            header("Content-Disposition: attachment; filename=\"".substr($name, 12)."\";");
            header("Content-Transfer-Encoding: binary");
            readfile("attachments/".$name);
        }
        else{
            $sql = "DELETE FROM $db_attachment_tab WHERE $db_attachment_id='$id'";
            $connection->query($sql);
            $_SESSION['alert'] = "Błąd: plik nie istnieje!";
            header("Location: tasks_all.php?sid=".$_GET['sid']."&tid=".$_GET['tid']);
        }
        $connection->close();
    }
}
else {
    $_SESSION['alert'] = "Błąd w połączeniu z bazą danych. Nie można było odczytać pliku";
}
?>