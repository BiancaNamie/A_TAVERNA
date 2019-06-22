<?php
	include("../Model/sala.php");

		
	function CriarSala(){
		$nome =$_POST['nome'];
		$descricao =  $_POST['descricao'];
		$novo_chat = new sala;
		$novo_chat->__set('nome', $nome);
		$novo_chat->__set('descricao', $descricao);
		$result = $novo_chat ->criar();

		echo $result;
	}

	function UpdateSala($id, $nome, $descricao){
		$sala = new sala;
		$sala = $sala->find($id);
		$sala->__set('nome', $nome);
		$sala->__set('descricao', $descricao);
		$result = $sala->alterar();

		echo $result;
	}

	switch ($_POST['request']) {
		case 'criarSala':
			criarSala();
			break;
		case 'updateSala':
			UpdateSala($_POST['id'],$_POST['nome'],$_POST['descricao']);
			break;
		default:
			# code...
			break;
	}

?>