<?php
	include_once("conect.php");
	include_once("sessionCheker.php");
	include("consultas.php");
	
	$sala = $_GET['id'];
	$_SESSION['sala'] = $sala;

	$content= new getContent;
	$consulta = $content->getChatsFromSala($sala);

	
	while($ln = mysqli_fetch_array($consulta)){
		$nome = $ln['nome'];
		$id = $ln['id'];

		echo"<br/>
			<div id='$nome' style='position: fixed;'>".
				'<a href="#" onclick = exibeChat('.$id.');>'."$nome <a/>
			</div>";
	}
	
	mysqli_close($conn);
?>