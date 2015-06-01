<?php

	session_start();
	$connection = ssh2_connect('10.0.2.15', 22);
	if(ssh2_auth_password($connection, $_POST['login'], $_POST['senha'])){
		$_SESSION['logado'] = true;
		header('Location:index.php');
	}else{
		header('Location:login.html');	
	}

?>