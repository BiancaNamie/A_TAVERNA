<?php
	include_once("../Model/usuario.php");

	// Escape user inputs for security

	$Usuario = new Usuario();

	$Usuario->__set("apelido",$_POST['nome']);
	$Usuario->__set("senha",md5($_POST['senha']));

	$Usuario->realizarLogin();

?>

