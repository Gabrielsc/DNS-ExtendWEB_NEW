<?php

	session_start();


	//$conect_mysql = mysql_connect('192.168.0.160', $_POST['login'], $_POST['senha']) or print (mysql_error()); 
	//print "Conexão OK!";
	//mysql_close($conect_mysql); 


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