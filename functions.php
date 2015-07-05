<?php

	function add_domain($domain, $type){
		if(ssh2_scp_recv($connect_ssh, '/etc/bind/named.conf.local', '/home/file.log')){
            echo "Copy Sucesso!!";
        }else{
            echo "Copy Error!!";
        }

        

	}


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



	function del_zona($domain){

		$remote_file = "/etc/bind/named.conf.local";			//way arq a ser copiado
		$local_file = "/tmp/named.conf.local.cpy"; 				//way arq copiado
		$local_file_modif = "/tmp/named.conf.local.cpy.alt";	//wau arq alterado

		// Copiando arquivo do server remote
		if(!ssh2_scp_recv($_SESSION['connection'], $remote_file, $local_file)){
			return false;
		}

		//Abrir file
		$file_original = fopen($local_file, 'r');		//abri arq para leitura
		$file_alterado = fopen($local_file_modif, 'w');	//cria um arq zerado

		for ($i=0;;$i++) {
			$linha = fgets($file_original);
			if ($linha==null) break;
			echo $linha;
		}

		//fechando arquivos
		fclose($file_original);
		fclose($file_alterado);
	}



	// Abri conexao com outra VM e executa um comando pelo SSH
	//$home = "/home/vagrant";
    //$connect_ssh = ssh2_connect('192.168.0.109', 22);
	//ssh2_auth_password($connect_ssh, "root", "adminuser");
	//$return = ssh2_exec($connect_ssh, "echo dane-se >> $home/arq");


	// Comando Shell na VM localhost
	//if(isset($_POST['enviar'])){
	//    //$way = "/home/vagrant/resolv.conf";
	//    $result = shell_exec("cd /home/vagrant");
	//    $result2 = shell_exec("who");
	//    echo "$result2";
	//}

?>

<!--
?>  <script type="text/javascript">
        alert(" <?php echo 'Erro via ssh...'; ?> ");
    </script>
<?php