<?php
	include_once("conect.php");
	include_once("sessionCheker.php");

	$id = $_GET['id'];
	$_SESSION['chat'] = $id;

	$select = "SELECT * from mensagem m WHERE m.Idchat = '$id' ";

	$consulta = mysqli_query($conn, $select);
	while($ln = mysqli_fetch_array($consulta)){
		$usuario = $ln['usuario'];
			$mensagem = $ln['mensagem'];
			echo"<br/>$usuario: $mensagem";
	}


?>
