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
		include_once("../Controller/conect.php");
		
		//valida apelido
		$sql = "SELECT apelido FROM usuario WHERE apelido='$a' ";
		$executa = mysqli_query($conn,$sql);
		$row = mysqli_num_rows($executa);
		if ($row > 0){
			mysqli_close($conn);
			?>
			<script language="javascript">;
			alert("Esse apelido já está em uso.");
			history.go(-1);
			</script>;
			<?php
		}
		
		//validaEmail
		$sql = "SELECT email FROM usuario WHERE email='$e' ";
		$executa = mysqli_query($conn,$sql);
		$row = mysqli_num_rows($executa);
		if ($row > 0){
			mysqli_close($conn);
			?>
			<script language="javascript">;
			alert("Esse email já possui cadastro.");

			history.go(-1);
			</script>;
			<?php
		}

		
		$sql = "INSERT INTO usuario VALUES ( default, '$n', '$so','$d','$a','$e','$s')";		
		
		if(mysqli_query($conn,$sql)){
			?>
				<script language="javascript">;
				alert("Cadastro realizado com sucesso");
				window.location.href = "../View/index.php"
				</script>
			<?php
		} else{
			echo "ERROR: Could not able to execute $sql. " . $conn->error;
		}
		
		mysqli_close($conn);
	}
	
	function alterar($confere){
		$id=$this->id;
		$a=$this->apelido;
		$n=$this->nome;
		$so=$this->sobrenome;
		$d=$this->dataNascimento;
		$e=$this->email;
		$s=$this->senha;
		
		include_once("../Controller/conect.php");
		
		//verifica se a senha está correta
		$sql = "select * from usuario where id Like '$id' and senha Like '$s'";
		
		$result = mysqli_query($conn, $sql);
		$rows = mysqli_num_rows($result);
		
		if ($rows == 0){
			mysqli_close($conn);
			?>
			<script language="javascript">;
				alert("Senha Incorreta");
				history.go(-1);
				</script>;
			<?php
		}
		
		if ($rows == 1){
		
			if (!empty($confere)){
				$s = $confere;
			}
			
			//verifica se o apelido esta em uso
			if ($a != $_SESSION['apelido']){
				$sql = "SELECT apelido FROM usuario WHERE apelido='$a' ";
				$executa = mysqli_query($conn,$sql);
				$row = mysqli_num_rows($executa);
				if ($row > 0){
					mysqli_close($conn);
					?>
						<script language="javascript">;
						alert("Esse apelido já está em uso.");
						history.go(-1);
						</script>;
					<?php
				}
			}
			
			//verifica se a data de nasc mudou
			if ($d != $_SESSION['dataNascimento']){
				$dataNasc = explode("-",$_POST["dataNascimento"]);
				if ( !checkdate( $dataNasc[1] , $dataNasc[2] , $dataNasc[0] )                   // se a data for inválida
						|| $dataNasc[0] < 1800                                     // ou o ano menor que 1900
						|| mktime( 0, 0, 0,  $dataNasc[1] , $dataNasc[2] , $dataNasc[0] ) > time() )  // ou a data passar de hoje
				{
					mysqli_close($conn);
					?>
						<script language="javascript">;
						alert("Data de nascimento inválida.");
						history.go(-1);
						</script>;
					<?php
				}else{
					$hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
					$nascimento = mktime( 0, 0, 0,  $dataNasc[1] , $dataNasc[2] , $dataNasc[0] );
					$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
					if ($idade >= 18){
						$d = $_POST["dataNascimento"];
					}else{
						mysqli_close($conn);
					?>
						<script language="javascript">;
						alert("Voce não pode ter menos de 18 anos.");
						history.go(-1);
						</script>;
					<?php
			}
				}
			}
			
			//verifica se o email mudou
			if ($e != $_SESSION['email']){
				$sql = "SELECT email FROM usuario WHERE email='$e' ";
				$executa = mysqli_query($conn,$sql);
				$row = mysqli_num_rows($executa);
				if ($row > 0){
					mysqli_close($conn);
					?>
					<script language="javascript">;
					alert("Esse email já está em uso");
					history.go(-1);
					</script>;
					<?php
				}
			}
			
			$sql="UPDATE usuario SET apelido = '$a', nome='$n', sobrenome='$so', dataDeNascimento='$d', email='$e', senha='$s' WHERE id='$id'";

			if(mysqli_query($conn,$sql)){
				/*echo "Atualizado com sucesso.";
				echo $confere;*/
				$_SESSION['usuario']= $a;
				$_SESSION['apelido']= $a;
				$_SESSION['nome']= $n;
				$_SESSION['sobrenome']= $so;
				$_SESSION['dataNascimento']= $d;
				$_SESSION['email']= $e;
				
				//header("location: ../View/principal.php");
			} else{
				echo "ERROR: Could not able to execute $sql. " . $conn->error;
			}
			
			
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
			header("Location: ../View/index.php?msg=Usuário e/ou Senha inválidos");
		}
		mysqli_close($conn);
	}
}

?>
