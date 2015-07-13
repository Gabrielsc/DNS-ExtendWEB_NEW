<?php
	
	session_start();
		$ipserver = $_POST['ipserver'];
		$login = $_POST['login'];
		$password = $_POST['senha'];
		$passwdebcrip = md5($password);

		/*
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
		*/

		
		$con = new mysqli("localhost","root","root","DNS-ExtendsWEB"); //Estabelece a conexão
		if (!$con){
			echo "erro: ".mysqli_connect_error();
			exit();
		}
		$sql = "SELECT * FROM usuario WHERE login = \"$login\" AND password = \"$passwdebcrip\"";

		if ($result = $con->query($sql)) 
		{
			
				while($obj = $result->fetch_object())//varre o obj result
				{
					//$_SESSION['id'] = $obj->id;
					//$_SESSION['name'] = $obj->name;
					//$_SESSION['email'] = $obj->email;
					$_SESSION['login'] = $obj->login;
					$_SESSION['password'] = $obj->password;
					$_SESSION['logado'] = true;
					//Guardando ip para usar na conexão ssh na pagina index.php
					$_SESSION['ipserver'] = $ipserver;
					header("Location:index.php");
					exit();
				}
				if(@$_SESSION['logado']!== 1)
				{
					header("Location:login.php");
					exit();
				}
		}
		
?>