<?php
	include_once("conect.php");
	$select = "SELECT * FROM sala";
	$consulta = mysqli_query($conn, $select);
	while($ln = mysqli_fetch_array($consulta)){
		$nome = $ln['nome'];
		$id = $ln['id'];
		$sala = "sala$id";
		$chats = $sala.'chats';

		$html= "<div id='sala$id'>".
					'<br/>#'.
					"<a href='#' onclick =".'"submenu(\''."$chats".'\')">'.
					"$nome".
					'</a>'.
					"<div id= '$chats'>".
					"</div>".
				"</div>";
		echo $html;
		echo "<script type='text/javascript'>getChat('$sala');</script>";
	}
?>