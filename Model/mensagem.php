<?php
	class mensagem{
		private $id;
		private $idChat;
		private $usuario;
		private $mensagem;

		public function __set($atributo, $valor){
	        $this->$atributo = $valor;
	    }
	    public function __get($atributo){
	      	return $this->$atributo;
	    }

		function criar(){
	
			include('../Controller/conect.php');

			$idc=  $this->idChat;
			$u= $this->usuario;
			$m = $this->mensagem;

			$sql = "INSERT INTO mensagem VALUES (DEFAULT, $idc,'$u','$m')";

			if(mysqli_query($conn, $sql)){
				echo 'mensagem enviada com sucesso';
			}
			else{
				echo 'erro interno sql: '.$sql.' erro: '.$conn->error;
			}

			mysqli_close($conn);
			
		}
	}
?>