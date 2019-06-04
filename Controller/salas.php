<?php
	include_once("sessionCheker.php");
	include ("consultas.php");

	$content = new getContent;

	$consulta = $content->getSalasFromUsuario($_SESSION['id']);

	while($ln = mysqli_fetch_array($consulta)){
		$nome = $ln['nome'];
		$id = $ln['id'];
		$sala = "sala$id";
		$chats = $sala.'chats';

		$html= "<br/>
				<div id='sala$id'>".
					'<a href="#" onclick = "getChat('.$id.');">'."$nome <a/>".
				"</div>";
		echo $html;
	}
?>