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
			if($usuario == $_SESSION['usuario']){
				$float = 'right';
				$from ="";
			}
			else{
				$float = 'left';
				$from = $usuario.'<br/>';
			}

			echo"
				<div id='msgSpacing'>
					<div class ='balao' style= 'float: $float; text-align: left;'>
						$from $mensagem
					</div>
				</div>";


	}


?>
