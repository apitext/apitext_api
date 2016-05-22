<?php
/**
 * TEIParser.php allows a user to extract text content from a XML String.
 * Copyright (C) 2016 Chris Sumption, Michael Andrea, Guiyan Bai
 *	
 * This file is part of the Apitext API.
 *
 * The the Apitext API is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * The the Apitext API is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
 */
 
class TEIMarkupParser{
	private $parser; // The XML Parser
	private $data; // The concatenated String of parsed XML
	private $openTag; // The name of callback function for open tags
	private $characterData; // The name of callback function for tagged content
	private $closeTag; // The name of callback function for closing tags
	private $tagMap; // A map for TEI tag searches and / or conversions
	
	/**
	 * Initializes a new TEIParser using the provided XML Parser callback
	 * function names.
	 */
	public function TEIMarkupParser($openTag, $characterData, $closeTag, $tagMap) {
	  $this->parser = NULL;
	  $this->data = "";
	  $this->openTag = $openTag;
	  $this->characterData = $characterData;
	  $this->closeTag = $closeTag;
	  $this->tagMap = $tagMap;
	}
	
	/**
	 * A callback function for XML Parser which checks to see if the current
	 * opening tag is listed in this TEI parser's tag mapping. If true it adds
	 * the associated value to this TEI parser's collected text data. 
	 * If false it adds a single space.
	 */
	private function markupOpenTag($parser, $name, $attrs) {
		if(isset($this->tagMap->$name)){
			$this->data .= $this->tagMap->$name->open_tag;
		}else{
			$this->data .= " ";
		}
	}
	
	/**
	 * A callback function for XML Parser which processes the whitespace 
	 * surrounding the provided character data then adds the result to this
	 * TEI parser's collected text data.
	 */
	private function markupCharacterData($parser, $data) {
		$this->data .= trim($data);
	}
	
	/**
	 * A callback function for XML Parser which checks to see if the current
	 * closing tag is listed in this TEI parser's tag mapping. If true it adds
	 * the associated value to this TEI parser's collected text data. 
	 * If false it adds a single space.
	 */
	private function markupCloseTag($parser, $name) {
		if(isset($this->tagMap->$name)){
			$this->data .= $this->tagMap->$name->close_tag;
		}else{
			$this->data .= " ";
		}
	}
	
	/**
	 * Creates an XML Parser that is aligned to this TEI Parser, then parses 
	 * the provided XML data using this parser's designated event handler
	 * functions.
	 */
	public function parse($XMLdata) {
		$this->parser = xml_parser_create();
		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser,
			array(&$this, $this->openTag),
			array(&$this, $this->closeTag));
		xml_set_character_data_handler($this->parser,
			array(&$this, $this->characterData));
		xml_parser_set_option($this->parser, XML_OPTION_CASE_FOLDING , 0);
		xml_parse($this->parser, $XMLdata);
		xml_parser_free($this->parser);
	}

	/**
	 * Returns this TEI Parsers collected text data.
	 */	
	public function getData(){
		return $this->data;
	}
}

?>