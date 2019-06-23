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

	function jogarDados($idChat, $mensagem){
		$nova_mensagem = new mensagem;
		$nova_mensagem->idChat = $idChat;
		$nova_mensagem->usuario = $_SESSION['apelido']." -Rolagem de dados ";
		$nova_mensagem->mensagem = $mensagem;

		echo $nova_mensagem->criar();

	}

	switch ($_POST['request']) {
		case 'enviar':
			enviarMensagem($_POST['idChat'], $_POST['mensagem']);
			break;
		case 'jogarDados':
			jogarDados($_POST['idChat'], $_POST['mensagem']);
			break;
		default:
			# code...
			break;
	}
?>