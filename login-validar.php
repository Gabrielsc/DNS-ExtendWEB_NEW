<?php

	session_start();

	$ip_server = '10.0.4.179';
	$connect_ssh = ssh2_connect($ip_server, 22);
	if(ssh2_auth_password($connect_ssh, $_POST['login'], $_POST['senha'])){
		$_SESSION['logado'] = true;
		$_SESSION['connection'] = $connect_ssh;
		header('Location:index.php');
	}else{
		header('Location:login.php');	
	}

?>