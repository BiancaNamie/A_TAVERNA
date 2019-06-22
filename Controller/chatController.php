<?php
	include("../Model/chat.php");

	class chatController{
		
		function insereChat(){

			$idSala = $_POST['idSala'];
			$nome =$_POST['nome'];
			$descricao = $_POST['descricao'];
			$tipo =  $_POST['tipo'];

			$novo_chat = new chat;
			$novo_chat->__set('idSala', $idSala);
			$novo_chat->__set('nome', $nome);
			$novo_chat->__set('descricao', $descricao);
			$novo_chat->__set('tipo', $tipo);

			$result = $novo_chat ->criar();

			echo $result;
		}
	}

	$controlador = new chatController;
	$controlador->insereChat();


?>