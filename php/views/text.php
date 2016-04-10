<?php 
	include("./model.php");
	header('Content-Type: text/plain');
	echo getTEIText($teiFile);
?>