<?php
	include("../Model/chat.php");
	include("sessionCheker.php");

	function insereChat($idSala,$nome,$descricao,$tipo){

		$novo_chat = new chat;
		$novo_chat->__set('idSala', $idSala);
		$novo_chat->__set('nome', $nome);
		$novo_chat->__set('descricao', $descricao);
		$novo_chat->__set('tipo', $tipo);

		$result = $novo_chat ->criar();

		echo $result;
	}

	function updateChat($id,$nome,$descricao,$tipo){

		$chat = new chat;
		$chat = $chat->find($id);
		$chat->__set('nome', $nome);
		$chat->__set('descricao',$descricao);
		$chat->__set('tipo',$tipo);

		echo $chat->alterar();
	}
	

	switch ($_POST['request']) {
		case 'insereChat':
			insereChat($_POST['idSala'],$_POST['nome'],$_POST['descricao'],$_POST['tipo']);
			break;
		case 'updateChat':
			updateChat($_POST['id'],$_POST['nome'],$_POST['descricao'],$_POST['tipo']);
			break;
		
		default:
			# code...
			break;
	}


?>