<?php
	include("../Model/sala.php");
	include("sessionCheker.php");

		
	function criarSala($nome,$descricao){
		$novo_chat = new sala;
		$novo_chat->__set('nome', $nome);
		$novo_chat->__set('descricao', $descricao);
		echo $novo_chat->criar($_SESSION['id']);
	}

	function UpdateSala($id, $nome, $descricao){
		$sala = new sala;
		$sala = $sala->find($id);
		$sala->__set('nome', $nome);
		$sala->__set('descricao', $descricao);
		$result = $sala->alterar();

		echo $result;
	}

	function excluirSala($id){
		$sala = new sala;
		$sala = $sala->find($id);
		echo $sala->excluir();
	}

	switch ($_POST['request']) {
		case 'insereSala':
			criarSala($_POST['nome'],$_POST['descricao']);
			break;
		case 'updateSala':
			UpdateSala($_POST['id'],$_POST['nome'],$_POST['descricao']);
			break;
		case 'excluirSala':
			excluirSala($_POST['id']);
			break;
		default:
			# code...
			break;
	}

?>