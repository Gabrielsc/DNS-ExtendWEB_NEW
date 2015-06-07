<?php

	session_start();
	$connection = ssh2_connect('192.168.0.109', 22);
	if(ssh2_auth_password($connection, $_POST['login'], $_POST['senha'])){
		$_SESSION['logado'] = true;
		header('Location:index.php');
	}else{
		header('Location:login.php');	
	}

?>