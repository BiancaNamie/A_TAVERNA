<?php

include_once("sessionCheker.php");
include_once("conect.php");

$usuarioOrigem = mysqli_real_escape_string($conn, $_SESSION['id']);
$sala =  mysqli_real_escape_string($conn, $_POST['idSala']);

$select ="SELECT u.id from usuario u join participa p on u.id = p.idUsuario where p.idSala = $sala and p.tipo = 'ADM'";

$result = mysqli_query($conn, $select);

$insert = "INSERT INTO notificacao  VALUES (DEFAULT,$usuarioOrigem, 'alguem deseja fazer parte da sua sala', 'PIS', $sala)";

$generatedId = "SELECT LAST_INSERT_ID()";

mysqli_query($conn, $insert);

$r2=  mysqli_query($conn, $generatedId);

$lid = mysqli_fetch_array($r2);

$lastId = $lid[0];


while ($ln = mysqli_fetch_array($result)) {
	$usuarioDestino= mysqli_real_escape_string($conn, $ln[0]);
	$insert = "INSERT INTO associado VALUES ($usuarioDestino, $lastId)";
	mysqli_query($conn, $insert);
}

mysqli_close($conn);


?>