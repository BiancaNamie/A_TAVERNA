<?php
include_once("conect.php");

if(isset($_FILES['arquivo'])){
	$nome = $_FILES["arquivo"]["name"];
	$tipo = $_FILES["arquivo"]["type"];
	$arquivo = mysqli_real_escape_string($conn, file_get_contents($_FILES["arquivo"]["tmp_name"]));
	$sql = "insert into arquivo values (1,1,'$nome', '$tipo','$arquivo')";

	if (mysqli_query($conn, $sql) ) {
		  echo "New record created successfully";
	} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}

	mysqli_close($conn);

}

?>