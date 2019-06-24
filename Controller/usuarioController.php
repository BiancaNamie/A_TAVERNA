<?php
	function login(){
		include_once("../Model/usuario.php");
		$Usuario = new Usuario();

		$Usuario->__set("apelido",$_POST['nome']);
		$Usuario->__set("senha",md5($_POST['senha']));

		$Usuario->realizarLogin();

	}

	function logout(){
		session_start();
		session_destroy();
		header("Location: ../View/index.php");
		exit();
	}

	function insereCadastro(){
		include_once("../Model/usuario.php");

		$Usuario = new Usuario();

		$Usuario->__set("apelido",$_POST['apelido']);
		$Usuario->__set("nome",$_POST['nome']);
		$Usuario->__set("sobrenome",$_POST['sobrenome']);
		$Usuario->__set("dataNascimento",$_POST['dataNascimento']);
		$Usuario->__set("email",$_POST['email']);
		$Usuario->__set("senha",md5($_POST['senha']));

		$Usuario->criar();
	}

	function editarCadastro(){
		include_once("../Model/usuario.php");
		session_start();

		echo "isso é um fucking teste!"; 
		$Usuario = new Usuario();

		$Usuario->__set("apelido",$_SESSION['apelido']);
		$Usuario->__set("nome",$_POST['nome']);
		$Usuario->__set("sobrenome",$_POST['sobrenome']);
		$Usuario->__set("dataNascimento",$_POST['dataNascimento']);
		$Usuario->__set("email",$_POST['email']);
		$Usuario->__set("senha",md5($_POST['senha']));

		$Usuario->alterar();	
	}

	function excluirPerfil(){
		include_once("../Model/usuario.php");
		session_start();

		$Usuario = new Usuario();

		$Usuario->__set("apelido",$_SESSION['usuario']);

		$Usuario->excluir();

		header("location: ../Controller/logout.php");
	}

	switch ($_POST['request']) {
		case 'login':
			login();
			break;
		case 'logout':
			logout();
			break;
		case 'insereCadastro':
			insereCadastro();
			break;
		case 'editarCadastro':
			editarCadastro();
			break;
		case 'excluirPerfil':
			excluirPerfil();
			break;
		default:
			# code...
			break;
	}
?>