<?php

	
	class getContent{


		function getSalasFromUsuario($Usuarioid){

			include("conect.php");

			$select = "SELECT * FROM sala s JOIN participa p ON s.id = p.idSala WHERE p.idUsuario = $Usuarioid";
			$consulta = mysqli_query($conn, $select);

			return $consulta;
			mysqli_close($conn);

		}

		function getSalasFromBusca($string){

			include("conect.php");

			$select = "SELECT * FROM sala where nome LIKE '%$string%' ";
			$consulta = mysqli_query($conn, $select);

			return $consulta;
			mysqli_close($conn);

		}

		function getChatsFromSala($idSala){

			include("conect.php");

			$select = "SELECT c.id, c.nome FROM chat c JOIN sala s on c.idSala = s.id where s.id = $idSala";
			$consulta = mysqli_query($conn, $select);
			
			return $consulta;
			mysqli_close($conn);

		}

		function getMensagensFromChat($idChat){
			include("conect.php");

			$select = "SELECT * from mensagem m WHERE m.Idchat = '$idChat' ";
			$consulta = mysqli_query($conn, $select);
			
			return $consulta;
			mysqli_close($conn);

		}

		function getArquivosFromSala($idSala){

			include("conect.php");
		
			$select = "SELECT * FROM arquivo where idSala = $idSala ";
			$consulta = mysqli_query($conn, $select);
			
			return $consulta;
			mysqli_close($conn);
							
		}

		function getNotificacoes($Usuarioid){
			include("conect.php");

			$select = "SELECT * FROM notificacao n JOIN associado a on n.id = a.idNotificacao where a.idUsuario = $Usuarioid";
			$consulta = mysqli_query($conn, $select);

			return $consulta;
			mysqli_close($conn);

		}


	}


?>