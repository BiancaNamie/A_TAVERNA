<?php
	include_once('../Model/associado.php');
	include_once('../Model/notificacao.php');
	include_once('../Controller/sessionCheker.php');
	include_once('../Model/amizade.php');

	function pedidoAmizade($id){
		$nova_notificacao = new notificacao;
		$apelido_usuario_origem = $_SESSION['apelido'];
		$usuario_origem = $_SESSION['id'];

		$nova_notificacao->__set('mensagem', "O usuario ".$apelido_usuario_origem." quer ser seu amigo");
		$nova_notificacao->__set('usuarioOrigem', $usuario_origem);
		$nova_notificacao->__set('tipo', 'PDA');
		$nova_notificacao->__set('idSala', 'NULL');

		$nova_notificacao->criar();

		$novo_associado = new associado;
		$novo_associado->__set('idUsuario', $id);
		$novo_associado-> __set('idNotificacao', $nova_notificacao->__get('id'));

		$novo_associado->criar();

	}

	function confirmaPedidoAmizade($idn){
		$notificacao = new notificacao;
		$notificacao = $notificacao->find($idn);
		$notificacao->excluir();
		$amizade = new amizade;
		$amizade-> __set('idUsuario1', $_SESSION['id']);
		$amizade-> __set('idUsuario2', $notificacao->__get('usuarioOrigem'));
		$amizade->criar();

	}

	switch ($_POST['request']) {
		case 'pedidoAmizade':
			pedidoAmizade($_POST['id']);
			break;
		case 'confirmaPedidoAmizade':
			confirmaPedidoAmizade($_POST['id']);
			break;
		
		default:
			# code...
			break;
	}

?>