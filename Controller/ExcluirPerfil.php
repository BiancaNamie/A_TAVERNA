<?php
include_once("../Model/usuario.php");
session_start();

$Usuario = new Usuario();

$Usuario->__set("apelido",$_SESSION['usuario']);

$Usuario->excluir();

header("location: ../Controller/logout.php");

?>