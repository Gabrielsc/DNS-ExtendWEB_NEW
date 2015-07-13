<?php
	$id = '';
	$name = $_POST['Name'];
	$email = $_POST['Email'];
	$login = $_POST['Login'];
	$password = $_POST['senha'];
	$confpassword = $_POST['confirmarsenha'];

	$con = new mysqli("localhost","root","root","DNS-ExtendsWEB"); //Estabelece a conexão
	
	if (!$con){
		echo "erro: ".mysqli_connect_error();
		exit();
	}

	if($password===$confpassword){
		echo "teste";

		$passwdencrip = md5($password); //Função md5 criptografa a senha 
		$sql = "INSERT INTO usuario VALUES(\"$id\",\"$name\", \"$email\", \"$login\", \"$passwdencrip\")";
		if ($result = $con->query($sql)) {
			echo "Usuario inserido com sucesso!";
		} 
		//$result->close();
	}else {
		echo "<a href='cadastrar.php'>Voltar</a><br>";
		
		die("senhas diferentes");
	}
	$con->close();
	
	header("Location:login.php");
?>