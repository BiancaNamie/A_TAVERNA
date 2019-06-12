<?php
include_once("../Model/usuario.php");

// Escape user inputs for security

$Usuario = new Usuario();

$Usuario->__set("apelido",$_POST['apelido']);
$Usuario->__set("nome",$_POST['nome']);
$Usuario->__set("sobrenome",$_POST['sobrenome']);
$Usuario->__set("dataNascimento",$_POST['dataNascimento']);
$Usuario->__set("email",$_POST['email']);
$Usuario->__set("senha",md5($_POST['senha']));

$Usuario->criar();

?>