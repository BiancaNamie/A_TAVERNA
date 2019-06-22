<?php
	 class notificacao{
	 	private $id;
	 	private $mensagem;
	 	private $usuarioOrigem;
	 	private $tipo;
	 	private $idSala;

	 	public function __set($atributo, $valor){
        	$this->$atributo = $valor;
    	}
    	public function __get($atributo){
       		return $this->$atributo;
    	}

	 	function criar(){
	 		include('../Controller/conect.php');

	 		$m = $this->mensagem;
	 		$uo = $this->usuarioOrigem;
	 		$t = $this->tipo;
	 		$ids = $this->idSala;

	 		$sql = "INSERT INTO notificacao VALUES (DEFAULT, $uo, '$m', '$t', $ids)";

	 		if(mysqli_query($conn, $sql)){
    			echo "notificacao criado com sucesso";
    		}
    		else{
    			echo "erro interno ".$conn->error;
    		}
    		$generatedId = "SELECT LAST_INSERT_ID()";
    		$ln =mysqli_fetch_array(mysqli_query($conn, $generatedId));
            $this->id = $ln[0];

    		mysqli_close($conn);
	 	}

	 	function excluir(){
	 		include('../Controller/conect.php');
	 		$id = $this->id;

	 		$sql = "DELETE FROM notificacao WHERE id= $id";
	 		
	 		if(mysqli_query($conn, $sql)){
    			echo "registro removido";
    		}
    		else{
    			echo "Erro interno";
    		}
    		mysqli_close($conn);
	 	}

	 	function find($id){
	 		include('../Controller/conect.php');

	 		$sql = "SELECT * from notificacao WHERE id = $id";
	 		$result = mysqli_query($conn, $sql);

	 		if($result){

    			$ln= mysqli_fetch_array($result);
	    		$notificacao = new notificacao;
	    		$notificacao->__set('id', $ln['Id']);
	    		$notificacao->__set('mensagem', $ln['Mensagem']);
	    		$notificacao->__set('usuarioOrigem', $ln['IdUsuarioOrigem']);
	    		$notificacao->__set('tipo', $ln['Tipo']);
	    		$notificacao->__set('idSala', $ln['idSala']);
	    		mysqli_close($conn);
	    		return $notificacao;
    		}
    		else{
    			echo 'Erro interno '.$conn->error;
    			mysqli_close($conn);
    			return;


    		}
	 	}

	 }
?>