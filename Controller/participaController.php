<?php
	include_once('../Controller/sessionCheker.php');
	include('../Model/participa.php');
	include('../Model/associado.php');
	include('../Model/notificacao.php');
	include('../Model/sala.php');

	function pedido($idSala){
		include('consultas.php');
		$nova_notificacao = new notificacao;
		
		$apelido_usuario_origem = $_SESSION['apelido'];
		$usuario_origem = $_SESSION['id'];
		
		$sala = new sala;
		$sala = $sala->find($idSala);
		$nome_sala = $sala->__get('nome');

		$nova_notificacao->__set('mensagem', $apelido_usuario_origem." quer ser entrar na sua sala ".$nome_sala);
		$nova_notificacao->__set('usuarioOrigem', $usuario_origem);
		$nova_notificacao->__set('tipo', 'PIS');
		$nova_notificacao->__set('idSala', $idSala);

		$nova_notificacao->criar();

		$consulta = new getContent;

		$result = $consulta->getUsuarioFromSalaWhere($idSala,'AND p.tipo ="ADM"');

		while ($ln = mysqli_fetch_array($result)) {
			$novo_associado = new associado;
			$novo_associado->__set('idUsuario', $ln['id']);
			$novo_associado-> __set('idNotificacao', $nova_notificacao->__get('id'));
			$novo_associado->criar();
		}
	}

	function confirmaIngresso($idn){
		$notificacao = new notificacao;
		$notificacao = $notificacao->find($idn);
		$notificacao->excluir();
		$novo_participa = new participa;
		$novo_participa->__set('idUsuario', $notificacao->__get('usuarioOrigem'));
		$novo_participa->__set('idSala', $notificacao->__get('idSala'));
		$novo_participa->__set('tipo', 'NRM');

		echo $novo_participa->criar();

	}

	function altera($id, $idSala, $tipo){
		$participa = new participa;
		$participa = $participa->find($id, $idSala);
		$participa->__set('tipo', $tipo);

		echo $participa->alterar();

	}

	function excluir($id, $idSala){
		$participa = new participa;
		$participa = $participa->find($id, $idSala);
		echo $participa->excluir();
	}

	switch($_POST['request']){
		case 'pedido':
			pedido($_POST['idSala']);
			break;
		case 'confirmaIngresso':
			confirmaIngresso($_POST['idn']);
			break;
		case 'altera':
			altera($_POST['id'], $_POST['idSala'], $_POST['tipo']);
			break;
		case 'excluir':
			excluir($_POST['id'], $_POST['idSala']);
			break;
		default:
			break;
	}

?>