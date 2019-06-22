<?php
	 class amizade{
	 	private $idUsuario1;
	 	private $idUsuario2;

	 	public function __set($atributo, $valor){
        	$this->$atributo = $valor;
    	}
    	public function __get($atributo){
       		return $this->$atributo;
    	}

	 	function criar(){
	 		include('../Controller/conect.php');
	 		$id1 = $this->idUsuario1;
	 		$id2 = $this->idUsuario2;
	 		$sql = "INSERT INTO amizade VALUES ($id1 , $id2)";

	 		if(mysqli_query($conn, $sql)){
    			echo "Amizade criada com sucesso";
    		}
    		else{
    			echo "Erro interno ".$conn->error;
    		}
    		mysqli_close($conn);
	 	}

	 	function excluir(){
	 		include('../Controller/conect.php');
	 		$id1 = $this->idUsuario1;
	 		$id2 = $this->idUsuario2;
	 		$sql1 = "DELETE FROM amizade WHERE idUsuario1 = $id1 and idUsuario2 = $id2";
	 		$sql2 = "DELETE FROM amizade WHERE idUsuario1 = $id2 and idUsuario2 = $id1";

	 		if(mysqli_query($conn, $sql)){
    			echo "Registro removido";
    		}
    		else{
    			echo "Erro interno";
    		}
    		mysqli_close($conn);
	 	}


	 }
?>