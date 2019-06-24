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

    	function criar($idu){
    		$n = $this->nome;
    		$d = $this->descricao;

    		include('../Controller/conect.php');
    		$insert = "INSERT INTO sala VALUES (DEFAULT, '$n', '$d')";
            $generatedId = "SELECT LAST_INSERT_ID()";

    		if(mysqli_query($conn, $insert)){
    			echo "Sala criada com sucesso";
    		}
    		else{
    			echo "Erro interno ".$conn->error;
    		}

            $r = mysqli_query($conn, $generatedId);
            if($r){
                echo 'ultimo id recuperado';
            }
            else{
                echo 'Erro interno '.$conn->error;
            }
            $ln = mysqli_fetch_array($r);

            $lastId = $ln[0];
            $participa = "INSERT INTO participa VALUES ($idu, $lastId, 'ADM')";

            if(mysqli_query($conn, $participa)){
                echo "aprticipa criado com sucesso";
            }
            else{
                echo "Erro interno ".$conn->error;
            }

            $insertChat = "INSERT INTO Chat VALUES (DEFAULT, '$lastId','Chat principal','NRM', 'Chat padrão de boas vindas')";

            $r4 = mysqli_query($conn, $insertChat);

            if($r4 == true){
                echo "deu bom 4 ";
            }
            else{
                echo "deu ruim 4 : ".$conn->error;
            }


    		mysqli_close($conn);
            return $lastId;
    	}

        function alterar(){
            $id = $this->id;
            $n=$this->nome;
            $d=$this->descricao;
            
            include("../Controller/conect.php");
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
            include("../Controller/conect.php");
            $sql="DELETE FROM sala WHERE id=$id";
            mysqli_query($conn,$sql);
            mysqli_close($conn);
        }
    

    	function find($id){
    		include("../Controller/conect.php");

			$sql="SELECT * FROM sala s where id = $id";
			$executa= mysqli_query($conn,$sql);
			
			$ln= mysqli_fetch_array($executa);
			$sala = new sala;
            $sala->__set('id', $ln['id']);
			$sala->__set('nome', $ln['nome']);
			$sala->__set('descricao', $ln['descricao']);
            return $sala;
			
			mysqli_close($conn);
	    }



	}
?>