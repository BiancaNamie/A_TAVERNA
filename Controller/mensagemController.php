<?php
	include_once ('../Model/mensagem.php');
	include_once('sessionCheker.php');

	function enviarMensagem($idChat, $mensagem){
		$nova_mensagem = new mensagem;
		$nova_mensagem->idChat = $idChat;
		$nova_mensagem->usuario = $_SESSION['apelido'];
		$nova_mensagem->mensagem = $mensagem;

		echo $nova_mensagem->criar();

	}

	function jogarDados(){

	}

	switch ($_POST['request']) {
		case 'enviar':
			enviarMensagem($_POST['idChat'], $_POST['mensagem']);
			break;
		case 'jogardados':
			jogarDados();
			break;
		default:
			# code...
			break;
	}
?>