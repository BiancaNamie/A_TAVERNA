<?php
include_once("conect.php");
include_once("sessionCheker.php");


if($_FILES['arquivo']['error']== UPLOAD_ERR_OK){

	$nome = $_FILES['arquivo']['name'];
	$tipo = $_FILES['arquivo']['type'];
	$sala = $_SESSION['sala'];
	$arquivo = mysqli_real_escape_string($conn, file_get_contents($_FILES["arquivo"]["tmp_name"]));
	$sql = "insert into arquivo values (default,$sala,'$nome', '$tipo','$arquivo')";

	if (mysqli_query($conn, $sql) ) {
		  echo "New record created successfully";
	} else {
		  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	mysqli_close($conn);

}
else{
	switch ($_FILES['arquivo']['error']) {
		case UPLOAD_ERR_INI_SIZE:
			echo 'UPLOAD_ERR_INI_SIZE';
			break;
		case UPLOAD_ERR_FORM_SIZE:
			echo 'UPLOAD_ERR_FORM_SIZE';
			break;
		default:
			echo("deu ruim");
			break;
	}
}

?>