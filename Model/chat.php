<?php
	class chat{
        private $idSala;
		private $nome;
		private $descricao;
		private $tipo;

		public function __set($atributo, $valor){
        	$this->$atributo = $valor;
    	}
    	public function __get($atributo){
       		return $this->$atributo;
    	}

    	function criar(){
            $id = $this->idSala;
    		$n = $this->nome;
    		$d = $this->descricao;
    		$t = $this->tipo;

    		include_once("../Controller/conect.php");
    		$insert = "INSERT INTO chat VALUES (DEFAULT, '$id','$n','$t', '$d')";

    		if(mysqli_query($conn, $insert)){
    			return  "Chat criado com sucesso";
    		}
    		else{
    			return "Erro interno".mysqli_error($conn);
    		}
    		mysqli_close($conn);
    	}
         function alterar(){
            $id = $this->id;
            $n=$this->nome;
            $d=$this->descricao;
            $t = $this->tipo;
            
            include_once("../Controller/conect.php");
            $sql="UPDATE chat SET nome='$n', descricao='$d', tipo = '$t' WHERE id='$id'";

            if(mysqli_query($conn,$sql)){
                echo "Atualizado com sucesso.";
            } else{
                echo "ERROR: Could not able to execute $sql. " . $conn->error;
            }
            
            mysqli_close($conn);
         }
        function excluir(){
            $id = $this->id;
            include_once("../Controller/conect.php");
            $sql="DELETE FROM chat WHERE id='id'";
            $executa= mysqli_query($conn,$sql);
            mysqli_close($conn);
            
            session_start();
        }
    

    	function find($id){
    		include_once("../Controller/conect.php");

			$sql="SELECT * FROM chat c where id = '$id'";
			$executa= mysqli_query($conn,$sql);
			
			$ln= mysqli_fetch_array($executa);
			$chat = new chat;
			$chat->__set('nome', $ln['nome']);
			$chat->__set('descricao', $ln['descricao']);
			$chat->__set('tipo', $ln['tipo']);

            return $chat;
			
			mysqli_close($conn);
	    }
	}
?>