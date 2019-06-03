<?php
	include_once("conect.php");
	include_once("sessionCheker.php");

	$nome = mysqli_real_escape_string($conn, $_POST['nome']);
	//$tipo = mysqli_real_escape_string($conn, $_POST['tipo']);
	$descricao =  mysqli_real_escape_string($conn, $_POST['descricao']);
	$idUsuario = mysqli_real_escape_string($conn, $_SESSION['id']);



	$insertSala = "INSERT INTO Sala VALUES (DEFAULT, '$nome','$descricao')";
	$generatedId = "SELECT LAST_INSERT_ID()";

	

	if(isset($_POST['nome'])){
		$r1 = mysqli_query($conn, $insertSala);

		if($r1 == true){
			echo "deu bom 1 ";
		}
		else{
			echo "deu ruim 1 : ".$conn->error;
		}

		$r2 = mysqli_query($conn, $generatedId);

		if($r2 == true){
			echo "deu bom 2 ";
		}
		else{
			echo "deu ruim 2 : ".$conn->error;
		}


		$ln = mysqli_fetch_array($r2);

		$lastId = $ln[0];

		echo " valor gerado $lastId";

		$insertParticipa = "INSERT INTO Participa VALUES ( $idUsuario, $lastId, 'ADM')";


		$r3 = mysqli_query($conn, $insertParticipa);

		if($r3 == true){
			echo "deu bom 3 ";
		}
		else{
			echo "deu ruim 3 : ".$conn->error;
		}

		$insertChat = "INSERT INTO Chat VALUES (DEFAULT, '$lastId','Chat principal','NRM', 'Chat padrão de boas vindas')";

		$r4 = mysqli_query($conn, $insertChat);

		if($r4 == true){
			echo "deu bom 4 ";
		}
		else{
			echo "deu ruim 4 : ".$conn->error;
		}


	}
	mysqli_close($conn);	
?>