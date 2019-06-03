<?php
	session_start();
	include_once("conect.php");


	$idUsuario = $_SESSION['id'];
	$select = "SELECT * FROM sala s JOIN participa p ON s.id = p.idSala WHERE p.idUsuario = $idUsuario";
	$consulta = mysqli_query($conn, $select);


	while($ln = mysqli_fetch_array($consulta)){
		$nome = $ln['nome'];
		$id = $ln['id'];
		$sala = "sala$id";
		$chats = $sala.'chats';

		if($ln['tipo'] = "ADM"){
			$edit= '<a href="#" onclick="editarSala('.$id.')">edit<a/>';
		}
		else{
			$edit = '';
		}

		$html= "<br/>
				<div id='sala$id'>".
					'<a href="#" onclick = "getChat('.$id.');">'."$nome <a/>"
					.$edit.

				"</div>";
		echo $html;
	}
?>