<?php
	class sala{

		private $id;
		private $nome;
		private $descricao;

		public function __set($atributo, $valor){
        	$this->$atributo = $valor;
    	}
    	public function __get($atributo){
       		return $this->$atributo;
    	}

    	function criar(){
    		$n = $this->nome;
    		$d = $this->descricao;

    		include_once('../Controller/conect.php');
    		$insert = "INSERT INTO sala VALUES (DEFAULT, '$n', '$d')";
            $generatedId = "SELECT LAST_INSERT_ID()";

    		if(mysql_query($conn, $insert)){
    			echo "Erro interno";
    		}
    		else{
    			echo "Sala criada com sucesso";
    		}

            $ln =mysqli_fetch_array(mysql_query($conn, $generatedId));
            $lastId = $ln[0];
    		mysqli_close($conn);
            return $lastId;
    	}

        function alterar(){
            $id = $this->id;
            $n=$this->nome;
            $d=$this->descricao;
            
            include_once("../Controller/conect.php");
            $sql="UPDATE sala SET nome='$n', descricao='$d' WHERE id='$id'";

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
            $sql="DELETE FROM sala WHERE id='id'";
            $executa= mysqli_query($conn,$sql);
            mysqli_close($conn);
            
            session_start();
        }
    

    	function find($id){
    		include_once("../Controller/conect.php");

			$sql="SELECT * FROM sala s where id = '$id'";
			$executa= mysqli_query($conn,$sql);
			
			$ln= mysqli_fetch_array($executa);
			$sala = new sala;
			$sala->__set('nome', $ln['nome']);
			$sala->__set('descricao', $ln['descricao']);
            return $sala;
			
			mysqli_close($conn);
	    }



	}
?>