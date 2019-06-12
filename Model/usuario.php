<?php

class Usuario{
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
		$a=$this->apelido;
		$n=$this->nome;
		$so=$this->sobrenome;
		$d=$this->dataNascimento;
		$e=$this->email;
		$s=$this->senha;
		
		include_once("../Controller/conect.php");
		$sql="UPDATE usuario SET nome='$n', sobrenome='$so', dataDeNascimento='$d', email='$e', senha='$s' WHERE apelido='$a'";

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
		
		
		
		
		//header("location: ../View/principal.php");
	}
	
	function excluir(){
		$n = $this->apelido;
		include_once("../Controller/conect.php");
		$sql="DELETE FROM pessoas WHERE apelido='$n'";
		$executa= mysqli_query($conn,$sql);
		mysqli_close($conn);
		
		session_start();
		unset($_SESSION['usuario']);
		header("location: ../View/index.php");
	}
	
	
	function consultar(){	// nao usei ate agora
		include_once("../Controller/conect.php");
		$sql="SELECT u.apelido FROM usuario u";
		$executa= mysqli_query($conn,$sql);
		
		while ($reg_pessoas = mysqli_fetch_array($executa)){
			echo "<tr>";
			echo ("<td>".$reg_pessoas['apelido']."</td>");
			echo "<tr>";
		}
		mysqli_close($conn);
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
			$_SESSION['sala']= "#";
			$_SESSION['chat']="#";
			
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
