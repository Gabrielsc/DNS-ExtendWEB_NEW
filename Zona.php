<?php

	class Zona{

		public $domain;
		public $type;
		//public $file_name="db";
		
		function __construct($domain, $type){
			$this->domain = $domain;
			$this->type = $type;
		}

		

		public function loadData($domain, $type){
			$this->domain = $domain;
			$this->type = $type;		
		}

		public function getDomain(){
			return "Valor domain: $this->domain";
		}

		

		public function add($conection){
			//WoW FUNCIONA!!!

			$remote_file = "/etc/bind/named.conf.local";	#way arq a ser copiado
			$local_file = "/home/named.conf.local.cpy"; 	#way arq copiado

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
			fwrite($file, "}\n");
			fclose($file);
			/////////////////////////////////////////////

			// Copiando arquivo alterado para server remote
			// Retornado false se nao copiou
			return ssh2_scp_send($conection, $local_file, $remote_file);
		}


		public function rm($conection, $domain_dado){

		}

		public function toString(){
			return "domain:$this->domain; type:$this->type";
		}

		
	}

?>