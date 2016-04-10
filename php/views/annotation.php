<?php 
	include("./model.php");
	header('Content-Type: application/json');
	echo getTEIAnnotation($teiFile);
?>