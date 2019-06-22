<?php
	class associado{
		private $idUsuario;
		private $idNotificacao;

		public function __set($atributo, $valor){
        	$this->$atributo = $valor;
    	}
    	public function __get($atributo){
       		return $this->$atributo;
    	}

		function criar(){
			include('../Controller/conect.php');

	 		$idu = $this->idUsuario;
	 		$idn = $this->idNotificacao;

	 		$sql = "INSERT INTO associado VALUES ($idu, $idn)";

	 		if(mysqli_query($conn, $sql)){
	 			echo 'registro criado com sucesso';
	 		}
	 		else{
	 			echo 'erro interno '.$conn->error;
	 		}
		}

		function excluir(){
			include('../Controller/conect.php');

	 		$idn = $this->idNotificacao;
	 		$sql = "DELETE FROM associado WHERE idUsuario = $idn";
	 	
	 		if(mysql_query($conn, $sql)){
    			echo "registro removido";
    		}
    		else{
    			echo "Erro interno";
    		}
		}

	}
?>