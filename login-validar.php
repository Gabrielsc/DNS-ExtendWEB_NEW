<?php

	session_start();

	$connect_ssh = ssh2_connect($_POST['ipserver'], 22);
	if(ssh2_auth_password($connect_ssh, $_POST['login'], $_POST['senha'])){
		$_SESSION['logado'] = true;
		//$_SESSION['connection'] = $connect_ssh;
		$_SESSION['ipserver'] = $_POST['ipserver'];
		$_SESSION['login'] = $_POST['login'];
		$_SESSION['senha'] = $_POST['senha'];
		header('Location:index.php');
	}else{
		header('Location:login.php');	
	}

?>