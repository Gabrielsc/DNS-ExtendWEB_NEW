<?php

// Classe Zona, adiciona, remove, .......

	class Zona{

		public $domain;
		public $type;

		//Contrutor passa 2 paramentros
		public function __construct($domain, $type){
			$this->domain = $domain;
			$this->type = $type;
		}

		public function getDomain(){
			return "Valor domain: $this->domain";
		}

		public function add($conection){
			//WoW FUNCIONA!!!

			$remote_file = "/etc/bind/named.conf.local";			#way arq a ser copiado
			$local_file = "/tmp/named.conf.local.cpy"; 				#way arq copiado

			// Copiando arquivo do server remote
			if(!ssh2_scp_recv($conection, $remote_file, $local_file)){
				//echo "nao copiou..";
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


		//Registros de Recursos Dominio - Hosts cadastrados no dominio
		public function getRRDominio($conection, $domain){
			// Retornar uma matriz em que cada linha representa uma linha
			// do arquivo de dados da zona, cada indice dessa linha contem os dados da linha...
			// Ex.:
			//Array ( [0] => Array ( [0] => @ [1] => IN [2] => NS [3] => localhost. ) 
			//        [1] => Array ( [0] => @ [1] => IN [2] => A [3] => 127.0.0.1 ) 
			//        [2] => Array ( [0] => @ [1] => IN [2] => AAAA [3] => ::1 ) 
			//		  [3] => Array ( [0] => ) ) 

			$remote_file = "/etc/bind/db.$domain";
			$local_file = "/tmp/db.$domain.cpy";

			// Copiando arquivo do server remote
			if(!ssh2_scp_recv($conection, $remote_file, $local_file)){
				return false;
			}

			// Transforma o arquivo na string e guarda...
			$file = file_get_contents($local_file);
			// Quebra a string em linha guardando num array, 
			// onde cada indice eh uma linha... 
			$convert = explode("\n", $file);

			$array = array(); //array para guardar dados resgatados..
			for ($i=8, $k=0; $i<count($convert); $i++, $k++) {
				// i -> var represnt linha atual do arq...
				// k -> var representa indice no array q ira retornar...inicia com 0
				$array[$k] = explode("	", $convert[$i]);
			}

			return $array;
		}



		// Pesquisa zona pelo seu domain(que deve ser passado como parametro)
		// retornar array com dados da zona
		public function pesquisaZona($conection, $domain){

			$remote_file = "/etc/bind/named.conf.local";	#way arq a ser copiado
			$local_file = "/tmp/named.conf.local.cpy"; 		#way arq copiado

			// Copiando arquivo do server remote
			if(!ssh2_scp_recv($conection, $remote_file, $local_file)){
				return false;
			}
			
			$file = file_get_contents($local_file);
			$convert = explode("\n", $file);
			$encontrado = false;

			for ($i=0; $i < count($convert); $i++) {

				if(strstr($convert[$i], $domain)){
					//echo "Domain: ".$convert[$i]."<br>";
					//echo "Type: ".$convert[$i+1]."<br>";
					//echo "File: ".$convert[$i+2]."<br><br>";
					
					$type = explode(" ", $convert[$i+1]);
					$file = explode(" ", $convert[$i+2]);
					$encontrado = true;
					break;

				}
			}

			if(!$encontrado){
				return false;
			}

			$array = array('0' => $type[1], '1' => $file[1]);

			return $array;
		}

		// Pesquisa no arquivo da zona que se deseja verificar os hosts cadastrados
		// retorna um array de um dado hosts, com info. do mesmo como type,...
		public function pesquisaNaZona($conection, $domain, $host){

			$remote_file = "/etc/bind/db.$domain";
			$local_file = "/tmp/db.$domain.cpy";

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