<?php
include_once("sessionCheker.php");
include_once("conect.php");

$usuario = mysqli_real_escape_string($conn, $_POST['idUsuario']);
$sala =  mysqli_real_escape_string($conn, $_POST['idSala']);
$tipo =  mysqli_real_escape_string($conn, $_POST['tipo']);

$insert ="INSERT into participa VALUES ($usuario, $sala,'$tipo')";

$result = mysqli_query($conn, $insert);


?>