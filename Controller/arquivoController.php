<?php

	include('../Model/arquivo.php');
	include ("sessionCheker.php");

	function enviaArquivo($sala){
		if($_FILES['arquivo']['error']== UPLOAD_ERR_OK){

			$nome = $_FILES['arquivo']['name'];
			$tipo = $_FILES['arquivo']['type'];
			$arquivo = file_get_contents($_FILES["arquivo"]["tmp_name"]);

			$novo_arquivo = new arquivo;

			$novo_arquivo->__set('nome', $nome);
			$novo_arquivo->__set('tipo', $tipo);
			$novo_arquivo->__set('idSala', $sala);
			$novo_arquivo->__set('arquivo', $arquivo);

			echo $novo_arquivo->criar();
			echo $sala;
		}
		else{
			switch ($_FILES['arquivo']['error']) {
				case UPLOAD_ERR_INI_SIZE:
					echo 'UPLOAD_ERR_INI_SIZE';
					break;
				case UPLOAD_ERR_FORM_SIZE:
					echo 'UPLOAD_ERR_FORM_SIZE';
					break;
				default:
					echo("deu ruim desconhecido");
					break;
			}
		}
	}

	function excluiArquivo($id){
		$arquivo = new arquivo;
		$arquivo= $arquivo->find($id);
		$arquivo->excluir();
	}

	switch ($_POST['request']) {
		case 'enviaArquivo':
			enviaArquivo($_POST['idSala']);
			break;
		case 'excluiArquivo':
			excluiArquivo($_POST['id']);
			break;
		default:
			# code...
			break;
	}

?>