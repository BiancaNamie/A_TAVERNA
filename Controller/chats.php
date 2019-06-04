<?php
	include_once("conect.php");
	include_once("sessionCheker.php");
	
	$sala = $_GET['id'];
	$_SESSION['sala'] = $sala;

	$select = "SELECT c.id, c.nome FROM chat c JOIN sala s on c.idSala = s.id where s.id = $sala";
	$consulta = mysqli_query($conn, $select);
	if($consulta){
		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			$id = $ln['id'];

			echo"<br/>
				<div id='$nome' style='position: fixed;'>".
					'<a href="#" onclick = exibeChat('.$id.');>'."$nome <a/>
				</div>";
		}
	}
	else{
		echo "deu ruim".mysqli_error($conn);
	}
	mysqli_close($conn);
?>