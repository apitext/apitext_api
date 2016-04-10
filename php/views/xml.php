<?php 
	include("./model.php");
	header('Content-Type: text/plain');
	echo getTEIXML($teiFile);
?>