<?php

class Usuario{
	private $id;
	private $apelido;
    private $nome;
    private $sobrenome;
	private $dataNascimento;
	private $email;
	private $senha;
    
    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }
    public function __get($atributo){
        return $this->$atributo;
    }
	
	function criar(){

		$a=$this->apelido;
		$n=$this->nome;
		$so=$this->sobrenome;
		$d=$this->dataNascimento;
		$e=$this->email;
		$s=$this->senha;
		
		$sql = "INSERT INTO usuario VALUES ( default, '$n', '$so','$d','$a','$e','$s')";		
		include_once("../Controller/conect.php");
		
		if(mysqli_query($conn,$sql)){
			echo "Records inserted successfully.";
			echo '<script language="javascript">';
			echo 'alert("Cadastro realizado com sucesso")';
			echo '</script>';
			header("location: ../View/index.php");
		} else{
			echo "ERROR: Could not able to execute $sql. " . $conn->error;
		}
		
		mysqli_close($conn);
	}
	
	function alterar(){
		$id= $this->id;
		$a=$this->apelido;
		$n=$this->nome;
		$so=$this->sobrenome;
		$d=$this->dataNascimento;
		$e=$this->email;
		$s=$this->senha;
		
		include_once("../Controller/conect.php");
		$sql="UPDATE usuario SET apelido = '$a' nome='$n', sobrenome='$so', dataDeNascimento='$d', email='$e', senha='$s' WHERE id='$id'";

		if(mysqli_query($conn,$sql)){
			echo "Atualizado com sucesso.";
			
			session_start();
			$_SESSION['nome']= $n;
			$_SESSION['sobrenome']= $so;
			$_SESSION['dataNascimento']= $d;
			$_SESSION['email']= $e;
			
			header("location: ../View/principal.php");
		} else{
			echo "ERROR: Could not able to execute $sql. " . $conn->error;
		}
		
		mysqli_close($conn);
	
	}
	
	function excluir(){
		$id= $this->id;
		include_once("../Controller/conect.php");
		$sql="DELETE FROM pessoas WHERE id='$id'";
		$executa= mysqli_query($conn,$sql);
		mysqli_close($conn);
		
		session_start();
		unset($_SESSION['usuario']);
		header("location: ../View/index.php");
	}

	
	function realizarLogin(){
		$a = $this->apelido;
		$s = $this->senha;
		
		$sql = "select * from usuario where apelido Like '$a' and senha Like '$s'";
		
		include_once("../Controller/conect.php");
		
		$result = mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($result);
		$ln = mysqli_fetch_array($result);
		
		if ($rows == 1 ) {
			session_start();
			
			$id=$ln['id'];
			
			$_SESSION['usuario']= $a;
			$_SESSION['id']= $id;		
			$_SESSION['nome']= $ln[1];
			$_SESSION['sobrenome']= $ln[2];
			$_SESSION['dataNascimento']= $ln[3];
			$_SESSION['apelido']= $ln[4];
			$_SESSION['email']= $ln[5];
			
			header("Location: ../View/principal.php");
			echo "Login realizado";

		}
		else{
			echo "usuario ou senha nao encontrados";
			header("Location: ../View/index.php");
		}
		mysqli_close($conn);
	}
}

?>
