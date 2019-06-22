<?php
	class arquivo{
		private $id;
		private $idSala;
		private $nome;
		private $tipo;
		private $arquivo;

		public function __set($atributo, $valor){
        	$this->$atributo = $valor;
    	}
    	public function __get($atributo){
       		return $this->$atributo;
    	}

    	function criar(){
    		include('../Controller/conect.php');

			$ids= $this->idSala;
			$n= $this->nome;
			$t= $this->tipo;
			$a= mysqli_real_escape_string($conn, $this->arquivo);

    		$sql= "INSERT INTO arquivo VALUES (DEFAULT, '$ids', '$n', '$t', '$a')";

    		if (mysqli_query($conn, $sql) ) {
				echo 'Arquivo enviado com sucesso';
			} else {
				  echo "Erro interno: ".$conn->error ;
			}
			mysqli_close($conn);

    	}
    	function excluir(){
    		include('../Controller/conect.php');
    		$id= $this->id;
    		$sql="DELETE FROM sala WHERE id='$id'";

    		if (mysqli_query($conn, $sql) ) {
				echo 'Arquivo excluido com sucesso';
			} else {
				  echo "Erro interno: ".$conn->error ;
			}
			mysqli_close($conn);

    	}
    	function visualizar(){
    		$t = $this->tipo;
    		$a = $this->arquivo;
    		header("Content-Type:".$t);
			echo $a;

    	}
    	function find($id){
    		include('../Controller/conect.php');
    		$sql= "SELECT * FROM arquivo WHERE id= '$id'";
    		$ln = mysqli_fetch_array(mysqli_query($conn, $sql));

    		$arquivo = new arquivo;
    		$arquivo->__set('id', $ln['id']);
    		$arquivo->__set('idSala', $ln['idSala']);
    		$arquivo->__set('nome', $ln['nome']);
    		$arquivo->__set('tipo', $ln['tipo']);
    		$arquivo->__set('arquivo', $ln['arquivo']);

    		mysqli_close($conn);

    		return $arquivo;
    	}
	}
?>