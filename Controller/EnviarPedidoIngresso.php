<?php

include_once("sessionCheker.php");
include_once("conect.php");

$usuarioOrigem = mysqli_real_escape_string($conn, $_SESSION['id']);
$sala =  mysqli_real_escape_string($conn, $_POST['idSala']);

$select ="SELECT u.id from usuario u join participa p on u.id = p.idUsuario where p.idSala = $sala and p.tipo = 'ADM'";

$result = mysqli_query($conn, $select);


while ($ln = mysqli_fetch_array($result)) {
	$usuarioDestino= mysqli_real_escape_string($conn, $ln[0]);
	$insert = "INSERT INTO notificacao  VALUES (DEFAULT,$usuarioDestino,$usuarioOrigem, 'alguem deseja fazer parte da sua sala', 'PIS', $sala)";
	mysqli_query($conn, $insert);
}

mysqli_close($conn);


?>