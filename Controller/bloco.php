<?php
	include_once("conect.php");
?>

<html>
		<?php
			$select = "SELECT * from mensagem";
			$consulta = mysqli_query($conn, $select);
			while($ln = mysqli_fetch_array($consulta)){
			$usuario = $ln['usuario'];
			$mensagem = $ln['mensagem'];
			echo"<br/>$usuario: $mensagem";
			}
		?>
</html>