<?php
	include_once("sessionCheker.php");
	include_once("consultas.php");

	function mensagens(){
		$id = $_GET['id'];
		$_SESSION['chat'] = $id;

		$content = new getContent;
		$consulta  = $content->getMensagensFromChat($id);

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
	}

	function salasBarraLateral(){

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
	}

	function salasPesquisa(){
		$str = $_GET['string'];
		$content = new getContent;
		$consulta = $content->getSalasFromBusca($str);


		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			$id = $ln['id'];
			$sala = "sala$id";

			$html= "<br/>
					<div id='sala$id' style= 'width: 100%;''>
						<a href='#''>$nome <a/><button>Solicitar entrada</button>
					</div>";
			echo $html;
		}
	}

	function chatsBarraChats(){
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
	}

	function arquivosBarraArquivos(){
		$sala = $_SESSION['sala'];

		$content= new getContent;
		$consulta = $content->getArquivosFromSala($sala);

		
		while($ln = mysqli_fetch_array($consulta)){
			$nome = $ln['nome'];
			echo "<br/> <a target = '_blank' href = ../Controller/visualizador.php?id='$ln[id]'>$nome<a/>";
		}

	}



	if(isset($_GET['request'])){
		$request = $_GET['request'];

		switch ($request) {
			case 'mensagens':
				mensagens();
				break;
			case 'salasBarraLateral':
				salasBarraLateral();
				break;
			case 'salasPesquisa':
				salasPesquisa();
				break;
			case 'chatsBarraChats':
				chatsBarraChats();
				break;
			case 'arquivosBarraArquivos':
				arquivosBarraArquivos();
				break;
			
			default:
				# code...
				break;
		}
	}

  ?>