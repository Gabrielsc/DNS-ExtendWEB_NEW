<?php

	//require 'functions.php';
	session_start();

	///////////////////////////////////
	// Abrindo conexão novamente ssh //
	$connect_ssh = ssh2_connect($_SESSION['ipserver'], 22);
    if(ssh2_auth_password($connect_ssh, $_SESSION['login'], $_SESSION['senha'])){
    	echo "Conectado..."."<br>";
    }
	

    //////////////////////////////////////
    // Iniciando Deletagem das linha... //

	$remote_file = "/etc/bind/named.conf.local";			//way arq a ser copiado
	$local_file = "/tmp/named.conf.local.cpy"; 				//way arq copiado
	$local_file_modif = "/tmp/named.conf.local.cpy.alt";	//wau arq alterado

	// Copiando arquivo do server remote
	if(!ssh2_scp_recv($connect_ssh, $remote_file, $local_file)){
		return false;
	}

	//Abrir file
	$file_original = fopen($local_file, 'r');		//abri arq para leitura
	$file_alterado = fopen($local_file_modif, 'w');	//cria um arq zerado

	// Var. para avisar se deve copiar ou não linha atual do laço
	$delete_line = false;

	//var. para ir increment. ate chegar a 4, q deve ser quando deve parar de exlucir as linhas
	// o "excluir na verdade eh não copiar a linha para o arquivo $local_file_modif
	$cont = 0;	
	for($i=0;;$i++) {

		$linha = fgets($file_original);
		if(strstr($linha, $_GET['domain']) || $delete_line ){
			//Foi localizado aqui a linha q deve ser deletada
			// Juntamente com as 2 seguintes portanto...
			$delete_line = true;
			$cont++;
			if($cont == 4){
				// Recebe para false, pq eh quando deve parar de excluir,  ou 
				// no caso agora comecar a copiar as linha restantes do file original
				$delete_line = false;
			}			
		}else{
			//escreve linha do arq original
			fwrite($file_alterado, $linha); 
		}
		if ($linha==null) break;
		//Teste...mostrar arq original..linha a linha
		//echo $linha."<br>";
		
	}

	//fechando arquivos
	fclose($file_original);
	fclose($file_alterado);

	if(ssh2_scp_send($connect_ssh, $local_file_modif, $remote_file)){

?>  	<script type="text/javascript">
	        alert("Sucesso");
	    </script>
<?php

	}else{
?>		<script type="text/javascript">
	        alert("Falha na operação");
	    </script>
<?php
	}

	// retornando para page zonas-diretas...
	header('Location:index.php?page=zonas-diretas');

	///////////////////////////////////////////////////////


/*	//Mostrar arq alterado...
	echo "<hr>";
	//Ler arquivo alterrado..
	$data = file_get_contents($local_file_modif);
	$convert = explode("\n", $data);
	for ($i=0;$i<count($convert);$i++) {
	    echo nl2br("$convert[$i] \n");
	}
*/

	//header('Location:index.php?page=zonas-diretas');

?>