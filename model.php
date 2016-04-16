<?php
include("TEIParser.php");

/**
 * Returns the "textual" content of an XML file.
 */
function getTEIXML($teiFile) {
    $xml = file_get_contents("../$teiFile");
	return $xml;
}

/**
 * Returns the "textual" content of an XML file. Assumes that the file is well 
 * formed, TEI compliant XML.
 */
function getTEIText($teiFile) {
	$xml = file_get_contents("../$teiFile");
	// Get the content between the opening and closing text tags.
	$xml = getTEIElementSection($xml, "<text>", "</text>");
	$text = new TEIParser("textOpenTag", "textCharacterData", 
		"textCloseTag", NULL);
	$text->parse($xml);
	return $text->getData();
}

/**
 * Returns the "markup" content of an XML file. Assumes that the file is well 
 * formed, TEI compliant XML.
 */
function getTEIMarkup($teiFile){
	$xml = file_get_contents("../$teiFile");
	$tagMap = json_decode(file_get_contents("data_markup.json"));
	// Get the content between the opening and closing text tags.
	$xml = getTEIElementSection($xml, "<text>", "</text>");
	$markup = new TEIParser("markupOpenTag", "markupCharacterData", 
		"markupCloseTag", $tagMap);
	$markup->parse($xml);
	return $markup->getData();
}

/**
 * Returns the "annotation" content of an XML file. Assumes that the file is
 * well formed, TEI compliant XML.
 */
function getTEIAnnotation($teiFile){
	$xml = file_get_contents("../$teiFile");
	$tagMap = json_decode(file_get_contents("data_markup.json"));
	// Get the content between the opening and closing text tags.
	$xml = getTEIElementSection($xml, "<text>", "</text>");
	$annotations = new TEIParser("annotationOpenTag",
		"annotationCharacterData", "annotationCloseTag", $tagMap);
	$annotations->parse($xml);
	return json_encode(array_values($annotations->getTagList()), JSON_PRETTY_PRINT);
}

/**
 * Returns the "teiHeader" content of an XML file. Assumes that the file is
 * well formed, TEI compliant XML.
 */
function getTEITeiHeader($teiFile){
	$xml = file_get_contents("../$teiFile");
	$tagMap = json_decode(file_get_contents("data_markup.json"));
	// Get the content between the opening and closing text tags.
	$xml = getTEIElementSection($xml, "<teiHeader>", "</teiHeader>");
	$teiHeader = new TEIParser("annotationOpenTag",
		"annotationCharacterData", "annotationCloseTag", $tagMap);
	$teiHeader->parse($xml);
	return json_encode(array_values($teiHeader->getTagList()), JSON_PRETTY_PRINT);
}

/**
 * Returns a section of the provided String based upon the provided start 
 * and stop strings.
 */
function getTEIElementSection($section, $openTag, $closeTag){
	$sectionStart = 0;
	$sectionEnd = strlen($section);
	$sectionStart = strpos($section, $openTag);
	$sectionEnd = strpos($section, $closeTag);
	$sectionLength = $sectionEnd - $sectionStart;
	$section = substr($section, $sectionStart, $sectionLength);
	return $section;
}

?>