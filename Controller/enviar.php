<?php
session_start();

include_once("conect.php");

$usuario = mysqli_real_escape_string($conn, $_SESSION['usuario']);
$mensagem =  mysqli_real_escape_string($conn, $_POST['mensagem']);
$sql = "insert into mensagem (usuario, mensagem,chat) values('$usuario', '$mensagem', 1)";

if(isset($_POST['mensagem'])){

	if (mysqli_query($conn, $sql) ) {
		  echo "New record created successfully";
	} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
mysqli_close($conn);
?>