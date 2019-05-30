<?php
	include_once("conect.php");
	$id = $_GET['id'];
	$select = "select * from arquivo where id = $id";
	$result = mysqli_query($conn,$select);
	$ln = mysqli_fetch_array($result);
	header("Content-Type:".$ln["tipo"]);
	echo $ln["arquivo"];



?>