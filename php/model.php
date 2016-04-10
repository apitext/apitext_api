<?php

function getTEIXML($teiFile) {
    $xml = file_get_contents("../../$teiFile");
	return $xml;
}

function getTEIText($teiFile) {
    $teiText = "Returns a text only view of the tei-xml file";
	return $teiText;
}

function getTEIMarkup($teiFile) {
	// Temporary data for illustration purposes
	$markup = file_get_contents("../../$teiFile");
	$textStart = strpos($markup,"<text>") + 6;
	$textEnd = strpos($markup,"</text>");
	$textLength = $textEnd - $textStart;
	$markup = substr($markup, $textStart, $textLength);
	return $markup;
}

function getTEIAnnotation($teiFile) {
    $teiText = "Returns a listing of all annotation tags contained in the tei-xml.";
	return $teiText;
}

function getTEIHeader($teiFile) {
    $teiText = "Returns a listing of all the first level teiHeader tags contained in the tei-xml file.";
	return $teiText;
}

?>