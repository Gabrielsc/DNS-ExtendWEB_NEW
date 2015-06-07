<?php

	session_start();
	$connect_ssh = ssh2_connect('192.168.0.109', 22);
	if(ssh2_auth_password($connect_ssh, $_POST['login'], $_POST['senha'])){
		$_SESSION['logado'] = true;
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['senha'] = $_POST['senha'];
		$_SESSION['connect_ssh'] = $connect_ssh;

		header('Location:index.php');
	}else{
		header('Location:login.php');	
	}

?>