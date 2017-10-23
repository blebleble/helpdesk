<?php
//wylogowywanie - koniec sesji
	session_start();
	
	session_unset();
	
	header('Location: index.php');

?>