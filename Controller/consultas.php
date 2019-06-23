<?php

	
	class getContent{


		function getSalasFromUsuario($Usuarioid){

			include("conect.php");

			$select = "SELECT * FROM sala s JOIN participa p ON s.id = p.idSala WHERE p.idUsuario = $Usuarioid";
			$consulta = mysqli_query($conn, $select);
			mysqli_close($conn);

			return $consulta;


		}

		function getSalasFromBusca($string){

			include("conect.php");
			$id = $_SESSION['id'];
			$select = " SELECT * FROM sala s WHERE NOT EXISTS(SELECT * FROM participa p WHERE s.id = p.idSala AND p.idUsuario = $id) AND s.nome LIKE '%$string%' AND NOT EXISTS(SELECT * FROM notificacao n JOIN associado ass ON n.id = ass.idNotificacao WHERE n.IdUsuarioOrigem = $id AND n.tipo = 'PIS' AND n.IdSala = s.id)" ;
			$consulta = mysqli_query($conn, $select);
			mysqli_close($conn);

			return $consulta;


		}

		function getChatsFromSala($idSala){

			include("conect.php");

			$select = "SELECT c.id, c.nome FROM chat c JOIN sala s on c.idSala = s.id where s.id = $idSala";
			$consulta = mysqli_query($conn, $select);
			mysqli_close($conn);
			
			return $consulta;


		}

		function getMensagensFromChat($idChat){
			include("conect.php");

			$select = "SELECT * from mensagem m WHERE m.Idchat = '$idChat' ";
			$consulta = mysqli_query($conn, $select);
			mysqli_close($conn);
			
			return $consulta;


		}

		function getArquivosFromSala($idSala){

			include("conect.php");
		
			$select = "SELECT * FROM arquivo where idSala = $idSala ";
			$consulta = mysqli_query($conn, $select);
			mysqli_close($conn);
			
			return $consulta;							
		}

		function getNotificacoes($Usuarioid){
			include("conect.php");

			$select = "SELECT * FROM notificacao n JOIN associado a on n.id = a.idNotificacao where a.idUsuario = $Usuarioid";
			$consulta = mysqli_query($conn, $select);

			mysqli_close($conn);

			return $consulta;


		}

		function getAmigosFromBusca($string){
			include("conect.php");
			$id = $_SESSION['id'];

			$select = "SELECT id, apelido FROM usuario u where NOT EXISTS (SELECT * FROM amizade a WHERE a.idUsuario1 = u.id OR a.idUsuario2 = u.id) AND apelido LIKE '%$string%' AND u.id != $id AND NOT EXISTS(SELECT * FROM notificacao n JOIN associado ass ON n.id = ass.idNotificacao WHERE n.IdUsuarioOrigem = $id AND n.tipo = 'PDA' AND ass.IdUsuario = u.id)";
			$consulta = mysqli_query($conn, $select);

			mysqli_close($conn);

			return $consulta;


		}

		function getSalasFromMinhasSalas(){
			include("conect.php");

			$id = $_SESSION['id'];

			$select = "SELECT s.id, s.nome FROM sala s join participa p on s.id = p.idSala where p.idUsuario = '$id' and p.tipo ='ADM' ";
			$consulta = mysqli_query($conn, $select);

			mysqli_close($conn);

			return $consulta;

		}

		function getAmigosfromAmigos(){
			include("conect.php");

			$id = $_SESSION['id'];

			$select = "SELECT apelido FROM amizade a JOIN usuario u ON a.idUsuario2 = u.id WHERE idUsuario1 = $id UNION SELECT apelido FROM amizade a JOIN usuario u ON a.idUsuario1 = u.id WHERE idUsuario2 = $id";
			
			$consulta = mysqli_query($conn, $select);

			mysqli_close($conn);

			return $consulta;
			

		}

		function getUsuarioFromSalaWhere($idSala, $where){
			include("conect.php");

			$select = "SELECT u.* from usuario u JOIN participa p ON u.id = p.idUsuario WHERE p.idSala = $idSala ".$where;
			
			$consulta = mysqli_query($conn, $select);

			if($consulta){
				echo 'consulta realizada'.$select;
			}
			else{
				echo 'Erro interno sql: '.$select." erro: ".$conn->error;	
			}

			return $consulta;
			
		}


	}


?>