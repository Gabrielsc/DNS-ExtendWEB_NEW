<?php


	function read_file($way){
		//Funcao para ler arquivo
		//variavel $way e o caminho do file

		$data = file_get_contents($way);
		$convert = explode("\n", $data);
		for ($i=0;$i<count($convert);$i++) {
			//ler linha a linha e quebra
			// o nl2br eh para reconhecer o \n
		    echo nl2br("$convert[$i] \n"); 
		}
	}


	//Comando Shell
	//if(isset($_POST['enviar'])){
	//    //$way = "/home/vagrant/resolv.conf";
	//    $result = shell_exec("cd /home/vagrant");
	//    $result2 = shell_exec("who");
	//    echo "$result2";
	//}

?>