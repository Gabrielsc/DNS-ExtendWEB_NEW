<?php

// Classe Zona, adiciona, remove, .......

	class Zona{

		public $domain;
		public $type;
		//public $file_name="db";

		//Contrutor passa 0 paramentros
		function __contruct0(){
		}

		//Contrutor passa 1 paramentros
		function __contruct1($domain){
			$this->domain = $domain;
		}
		
		//Contrutor passa 2 paramentros
		function __construct2($domain, $type){
			$this->domain = $domain;
			$this->type = $type;
		}

		public function getDomain(){
			return "Valor domain: $this->domain";
		}

		public function add($conection){
			//WoW FUNCIONA!!!

			$remote_file = "/etc/bind/named.conf.local";			#way arq a ser copiado
			$local_file = "/home/vagrant/named.conf.local.cpy"; 	#way arq copiado

			// Copiando arquivo do server remote
			if(!ssh2_scp_recv($conection, $remote_file, $local_file)){
				return false;
			}

			/////////////////////////////////////////////
			// Abrindo, escrevendo e fechando arquivo...
			$file = fopen($local_file, 'a');
			//fwrite($file, $text);
			fwrite($file, "zone $this->domain {\n");
			fwrite($file, "\ttype $this->type;\n");
			fwrite($file, "\tfile /etc/bind/db.$this->domain;\n");
			fwrite($file, "};\n");
			fclose($file);
			/////////////////////////////////////////////

			// Copiando arquivo alterado para server remote
			// Retornado false se nao copiou
			return ssh2_scp_send($conection, $local_file, $remote_file);
		}


		public function del($conection, $domain_dado){

			$remote_file = "/etc/bind/named.conf.local";			#way arq a ser copiado
			$local_file = "/home/vagrant/named.conf.local.cpy"; 	#way arq copiado

			// Copiando arquivo do server remote
			if(!ssh2_scp_recv($conection, $remote_file, $local_file)){
				return false;
			}



		}

		public function getZonas(){
			//$remote_file = "/etc/bind/named.conf.local";	#way arq a ser copiado
			$local_file = "/home/vagrant/named.conf.local.cpy"; 	#way arq copiado

			// Copiando arquivo do server remote
			//if(!ssh2_scp_recv($conection, $remote_file, $local_file)){
			//	return false;
			//}

			$file = file_get_contents($local_file);

			$convert = explode("\n", $file);
			for ($i=10;$i<count($convert);$i++) {
				//ler linha a linha e quebra
				// o nl2br eh para reconhecer o \n
			    echo nl2br("$convert[$i] \n"); 
			}
			return true;
		}

		// Pesquisa zona pelo seu domain(que deve ser passado como parametro)
		// retornar array com dados da zona
		public function pesquisaZona($conection, $domain){

			$remote_file = "/etc/bind/named.conf.local";			#way arq a ser copiado
			$local_file = "/home/vagrant/named.conf.local.cpy"; 	#way arq copiado

			// Copiando arquivo do server remote
			if(!ssh2_scp_recv($conection, $remote_file, $local_file)){
				return false;
			}
			
			$file = file_get_contents($local_file);

			$convert = explode("\n", $file);

			for ($i=0; $i < count($convert); $i++) {

				if(strstr($convert[$i], $domain)){
					echo "Domain: ".$convert[$i]."<br>";
					echo "Type: ".$convert[$i+1]."<br>";
					echo "File: ".$convert[$i+2]."<br><br>";
					
					$type = explode(" ", $convert[$i+1]);
					$file = explode(" ", $convert[$i+2]);
					break;
				}
			}

			//echo $type[0]." e ".$type[1];

			$array = array('0' => $type[1], '1' => $file[1]);

			return $array;

		}

		// Pesquisa no arquivo da zona que se deseja verificar os hosts cadastrados
		// retorna um array de um dado hosts, com info. do mesmo como type,...
		public function pesquisaNaZona($conection, $domain, $host){

			$remote_file = "/etc/bind/db.$domain";
			$local_file = "/home/vagrant/db.$domain.cpy";

			//echo "variavel file_remote = $remote_file";

			// Copiando arquivo do server remote
			if(!ssh2_scp_recv($conection, $remote_file, $local_file)){
				echo "Erro ao copiar...";
				return false;
			}
			
			// $file ira guardar o arquivo de texto como uma string
			$file = file_get_contents($local_file);

			// explode() irá fazer de $file um vetor que cada linha sera um indice
			$convert = explode("\n", $file);
			for ($i=8; $i < count($convert); $i++) {

				if(strstr($convert[$i], $host)){
					//colando no array cada campo da linha que contem a string $host
					$array = explode("	", $convert[$i]);
				}
			}

			return $array;
		}

		public function toString(){
			return "domain:$this->domain; type:$this->type";
		}

		
	}

?>