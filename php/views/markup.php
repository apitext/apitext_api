<?php 
	include("./model.php");
	header('Content-Type: text/html');
	echo getTEIMarkup($teiFile);
?>