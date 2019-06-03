<?php
	session_start();

	include_once("conect.php");

		
	$nome = mysqli_real_escape_string($conn, $_POST["nome"]);
	$senha= mysqli_real_escape_string($conn, $_POST["senha"]);
	$sql = "select * from usuario where apelido Like '$nome' and senha Like '$senha'";
		
	echo $sql;
	$result = mysqli_query($conn, $sql);
	$rows = mysqli_num_rows($result);
	$ln = mysqli_fetch_array($result);
		
		
	if ($rows == 1 ) {
			$id=$ln['id'];
			$_SESSION['usuario']= $nome;
			$_SESSION['id']= $id;
			$_SESSION['sala']= "#";
			$_SESSION['chat']="#";

			header("Location: ../View/principal.php");
			echo "Login realizado";
	}
	else{
		echo "usuario ou senha nao encontrados";
		header("Location: ../View/index.php");
	}
	mysqli_close($conn);
	
?>

