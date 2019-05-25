<?php

include_once("conect.php");

// Escape user inputs for security

$apelido = $conn->real_escape_string($_POST['usuario']);
$nome = $conn->real_escape_string($_POST['nome']);
$sobrenome = $conn->real_escape_string($_POST['sobrenome']);
$DataNascimento = $conn->real_escape_string($_POST['dataNascimento']);
$email = $conn->real_escape_string($_POST['email']);
$senha = $conn->real_escape_string($_POST['senha']);
 
// Attempt insert query execution
$sql = "INSERT INTO usuario VALUES ( '$nome', '$sobrenome', '$DataNascimento', '$email','$apelido', '$senha')";
if($conn->query($sql) === true){
    echo "Records inserted successfully.";
	echo '<script language="javascript">';
	echo 'alert("Cadastro realizado com sucesso")';
	echo '</script>';
	header("location: ../View/index.php");
} else{
    echo "ERROR: Could not able to execute $sql. " . $conn->error;
}

mysqli_close($conn);

?>