<?php
include("TEIMarkupParser.php");

/**
 * Returns the "XML" of the a TEI-XML file with the provided name. Assumes
 * that the file content is well formed TEI compliant XML.
 */
function getTEIXML($teiFile) {
    $xml = file_get_contents("../$teiFile");
	return $xml;
}

/**
 * Returns the "textual" content of a TEI-XML file with the provided name.
 * If no text is found, an appropriate message is returned that reflects
 * that outcome. Assumes that the file content is well formed
 * TEI compliant XML.
 */
function getTEIText($teiFile) {
	$text = "No text found.";
	$xml = new XMLReader();
	$xml->open("../$teiFile");
	while($xml->read()) {
		if($xml->name == "text"){
			$temp = $xml->readString();
			if(!empty($temp)){
				$text = preg_replace('/\s+/S', " ", $temp);
			}
		}
	}
	return trim($text);
}

/**
 * Returns the "markup" content of a TEI-XML file with the provided name.
 * Assumes that the file content is well formed TEI compliant XML.
 */
function getTEIMarkup($teiFile){
	$xml = file_get_contents("../$teiFile");
	$tagMap = json_decode(file_get_contents("data_markup.json"));
	// Get the content between the opening and closing text tags.
	$xml = getTEIElementSection($xml, "<text>", "</text>");
	$markup = new TEIMarkupParser("markupOpenTag", "markupCharacterData", 
		"markupCloseTag", $tagMap);
	$markup->parse($xml);
	return $markup->getData();
}

/**
 * Returns a JSON listing of all "elements" that exist within the TEI-XML 
 * file with the provided name. Assumes that the file content is well formed
 * TEI compliant XML.
 */
function getTEIElements($teiFile){
	$elementList = array();
	$xml = new XMLReader();
	$xml->open("../$teiFile");
	while($xml->read()) {
		array_push($elementList, $xml->name);
	}
	// Were any elements found?
	if(empty($elementList)){
		array_push($elementList, "No elements found.");
	}
	return json_encode(array_values(array_unique($elementList)), 
		JSON_PRETTY_PRINT);
}

/**
 * Returns a JSON listing of all "children" of the provided element within the
 * TEI-XML file with the provided name. If the element does not exist, an
 * array is passed back with a message reflecting that outcome. Assumes that
 * the file content is well formed TEI compliant XML.
 */
function getTEIElementChildren($teiFile, $element){
	$childList = array();
	$xml = new XMLReader();
	$xml->open("../$teiFile");
	while($xml->read()) {
		if($xml->name == $element){
			$temp = $xml->readString();
			if(!empty($temp)){
				array_push($childList, $xml->readString());
			}
		}
	}
	// Were any child elements found?
	if(empty($childList)){
		array_push($childList, "No children of $element found.");
	}
	return json_encode(array_values(array_unique($childList)), 
		JSON_PRETTY_PRINT);
}

/**
 * Returns a JSON listing of all "annotation" elements that exist within the TEI-XML 
 * file with the provided name. Assumes that the file content is well formed
 * TEI compliant XML.
 */
function getTEIAnnotation($teiFile){
	$annotationMap = json_decode(file_get_contents("data_annotation.json"));
	$annotationList = array();
	$xml = new XMLReader();
	$xml->open("../$teiFile");
	while($xml->read()) {
		$tempElement = $xml->name;
		// Is this a annotation tag
		if(isset($annotationMap->$tempElement)){
			array_push($annotationList, $tempElement);
		}
	}
	// Were any annotation elements found?
	if(empty($annotationList)){
		array_push($annotationList, "No annotation elements found.");
	}
	return json_encode(array_values(array_unique($annotationList)), 
		JSON_PRETTY_PRINT);
}

/**
 * Returns a JSON listing of all "teiHeader" elements that exist within the TEI-XML 
 * file with the provided name. Assumes that the file content is well formed
 * TEI compliant XML.
 */
function getTeiHeader($teiFile){
	$teiHeaderMap = json_decode(file_get_contents("data_metadata.json"));
	$teiHeaderList = array();
	$xml = new XMLReader();
	$xml->open("../$teiFile");
	while($xml->read()) {
		$tempElement = $xml->name;
		// Is this a annotation tag
		if(isset($teiHeaderMap->$tempElement)){
			array_push($teiHeaderList, $tempElement);
		}
	}
	// Were any teiHeader elements found?
	if(empty($teiHeaderList)){
		array_push($teiHeaderList, "No teiHeader elements found.");
	}
	return json_encode(array_values(array_unique($teiHeaderList)), 
		JSON_PRETTY_PRINT);
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