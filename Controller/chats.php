<?php
	include_once("conect.php");
	$select = "SELECT * FROM chat";
	$consulta = mysqli_query($conn, $select);
	while($ln = mysqli_fetch_array($consulta)){
		$nome = $ln['nome'];
		echo"</br>$nome";
	}
?>