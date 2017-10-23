<?php
//strona główna - panel logowania
	session_start();
	
	if ((isset($_SESSION['online'])) && ($_SESSION['online']==true))
	{
		header('Location: main.php');
		exit();
	}

?>



<!DOCTYPE HTML>
<html lang="pl">
<head>
	  <meta charset="UTF-8">
 
      <link rel="stylesheet" href="login/css/style.css">
  
</head>

<body>
	
	<form action="login.php" method="post">
	
		<header>Logowanie</header>
                
                <label>Login: <span></span></label>
                <input type="text" name="login" required/>
                <label>Hasło: <span></span></label>
                <input type="password" name="pass" required/>
                
                <button type="submit" class="button"/>Zaloguj</button>

	</form>
	
<?php
	if(isset($_SESSION['error']))	echo $_SESSION['error'];
	unset($_SESSION['error']);
?>

</body>
</html>