<?php
include("model.php");

/**
 * Displays the "welcome" content for the API as HTML.
 */
function welcome($teiFile, $url) {
    header('Content-Type: text/html');
	include_once "views/welcome.php";
}

/**
 * Displays the "resources" content for the API using json notation.
 */
function resources($url) {
	header('Content-Type: application/json');
    include_once "views/resources.php";
}

/**
 * Displays the "xml" content of an XML file as plain text. Assumes that 
 * the file is well formed, TEI compliant XML.
 */
function xml($teiFile) {
    header('Content-Type: text/plain');
	echo getTEIXML($teiFile);
}

/**
 * Displays the "text" content of an XML file as plain text. Assumes that 
 * the file is well formed, TEI compliant XML.
 */
function text($teiFile) {
	header('Content-Type: text/plain');
	echo getTEIText($teiFile);
}

/**
 * Displays the "markup" content of an XML file as HTML. Assumes that the 
 * file is well formed, TEI compliant XML.
 */
function markup($teiFile) {
	header('Content-Type: text/html');
	echo getTEIMarkup($teiFile);
}

/**
 * Displays the "annotation" content of an XML file using json notation. 
 * Assumes that the file is well formed, TEI compliant XML.
 */
function annotation($teiFile) {
	header('Content-Type: application/json');
	print_r(getTEIAnnotation($teiFile));
}

/**
 * Displays the "teiHeader" content of an XML file using json notation. 
 * Assumes that the file is well formed, TEI compliant XML.
 */
function teiHeader($teiFile) {
	header('Content-Type: application/json');
	echo getTEITeiHeader($teiFile);
}

?>