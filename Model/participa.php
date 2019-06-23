<?php
	class participa{
		private $idUsuario;
		private $idSala;
		private $tipo;

		public function __set($atributo, $valor){
        	$this->$atributo = $valor;
    	}
    	public function __get($atributo){
       		return $this->$atributo;
    	}

    	function criar(){
			include('../Controller/conect.php');

	 		$idu = $this->idUsuario;
	 		$ids = $this->idSala;
	 		$t = $this->tipo;

	 		$sql = "INSERT INTO participa VALUES ($idu, $ids, '$t')";

	 		if(mysqli_query($conn, $sql)){
	 			echo 'registro criado com sucesso';
	 		}
	 		else{
	 			echo 'erro interno '.$conn->error;
	 		}
		}

		function alterar(){

			$idu = $this->idUsuario;
	 		$ids = $this->idSala;
	 		$t = $this->tipo;
					
			include("../Controller/conect.php");
			$sql="UPDATE participa SET tipo='$t' WHERE idUsuario=$idu AND idSala = $ids";

			if(mysqli_query($conn,$sql)){
				echo "Atualizado com sucesso.";
			} else{
				echo "ERROR: Could not able to execute $sql. " . $conn->error;
			}
		
			mysqli_close($conn);
		}

		function excluir(){
			$idu = $this->idUsuario;
	 		$ids = $this->idSala;
	 							
			include("../Controller/conect.php");
			$sql="DELETE FROM participa WHERE idUsuario=$idu AND idSala = $ids";
			if(mysqli_query($conn,$sql)){
				echo 'Removido com sucesso';
			}
			else{
				echo 'Ero interno '.$conn->error;
			}
			mysqli_close($conn);


		}

		function find($idUsuario, $idSala){

			$idu = $this->idUsuario;
	 		$ids = $this->idSala;
	 							
			include("../Controller/conect.php");
			$sql="SELECT * FROM participa WHERE idUsuario=$idu AND idSala = $ids";

			$ln = mysqli_fetch_array(mysqli_query($conn,$sql));

			$participa = new participa;

			$participa->__set('idUsuario', $ln['idUsuario']);
			$participa->__set('idSala', $ln['idSala']);
			$participa->__set('tipo', $ln['tipo']);

			mysqli_close($conn);

			return $participa;
			
		}
	}
?>