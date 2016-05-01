<?php
include("model.php");

/**
 * Displays the "welcome" content for the API as HTML.
 */
function welcome($teiFile, $url) {
    header('Content-Type: text/html');
	echo ("
		<p>This is the endpoint URL for the $teiFile REST API.</p>
		<p>You can view available API resources <a href='$url/api/v1/resources'>here</a>.</p>
	");
}

/**
 * Displays the "error" content for the API as HTML.
 */
function error($teiFile, $url, $request) {
    header('Content-Type: text/html');
	echo ("
		<p>Could not locate $request in $teiFile.</p>
	");
}

/**
 * Displays the "resources" content for the API using JSON notation.
 */
function resources($url) {
	header('Content-Type: application/json');
	$resourcesList = new stdClass();
	//resources
	$resourcesList->resources = 
		(object) ["response" => "Returns a welcome message and a link to the Resources endpoint.",
			"actions" => array("get"),
			"url" => "$url/api/v1/resources"];
	//xml
	$resourcesList->xml = 
		(object) ["response" => "Returns the TEI-XML view of the TEI-XML file.",
		"actions" => array("get"),
			"url" => "$url/api/v1/xml"];
	//text
	$resourcesList->text = 
		(object) ["response" => "Returns a text only view of the tei-xml file.",
		"actions" => array("get"),
			"url" => "$url/api/v1/text"];
	//markup
	$resourcesList->markup = 
		(object) ["response" => "Returns a markup only (html) view of the tei-xml file.",
		"actions" => array("get"),
			"url" => "$url/api/v1/markup"];
	//elements
	$resourcesList->elements = 
		(object) ["response" => "Returns a listing of all elements contained within the tei-xml file.",
		"actions" => array("get", "index"),
			"url" => "$url/api/v1/elements"];
	//elements/annotations
	$resourcesList->annotations = 
		(object) ["response" => "Returns a listing of all annotation elements contained within the tei-xml file.",
		"actions" => array("get"),
			"url" => "$url/api/v1/elements/annotations"];
	//elements/teiheaders
	$resourcesList->teiheaders = 
		(object) ["response" => "Returns a listing of all teiheader elements contained within the tei-xml file.",
		"actions" => array("get"),
			"url" => "$url/api/v1/elements/teiheaders"];
	
	echo json_encode($resourcesList, JSON_PRETTY_PRINT);
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
 * Displays the TEI elements of an XML file using json notation. 
 * Assumes that the file is well formed, TEI compliant XML.
 */
function element($teiFile) {
	header('Content-Type: application/json');
	print_r(getTEIElements($teiFile));
}

/**
 * Displays the TEI elements of an XML file using json notation. 
 * Assumes that the file is well formed, TEI compliant XML.
 */
function displayElementChildren($teiFile, $url, $endpoint) {
	header('Content-Type: application/json');
	$children = getTEIElementChildren($teiFile, $endpoint);
	// Were any children found? If true display json, if false display error.
	print_r($children);
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
	echo getTeiHeader($teiFile);
}

?>