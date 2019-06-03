<?php
include_once("sessionCheker.php");
include_once("conect.php");

$usuario = mysqli_real_escape_string($conn, $_SESSION['usuario']);
$mensagem =  mysqli_real_escape_string($conn, $_POST['mensagem']);
$chat = $_SESSION['chat'];


$sql = "INSERT INTO mensagem  VALUES (DEFAULT, '$chat', '$usuario', '$mensagem')";

if(isset($_POST['mensagem'])){

	if (mysqli_query($conn, $sql) ) {
		  echo "New record created successfully";
	} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}
mysqli_close($conn);
?>