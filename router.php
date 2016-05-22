<?php
/**
 * router.php processes all URI requests for the API.
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
 
include("view.php");

// Import configuration settings.
$config = json_decode(file_get_contents("config.json"));
$teiFolder = $config->teiFolder;
$teiFile = $config->teiFile;

// Retrieve the URI and convert it into a endpoint.
$uri = $_SERVER['REQUEST_URI'];
$uri = trim($uri);
$uri = rtrim($uri, '/');
$uri = explode("/", $uri);
$children = array_slice($uri, array_search("v1", $uri) + 1);
$parent = array_shift($children);

// Convert the current file path into a well formed URL.
$url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
$url = str_replace("/apitext_api/router.php", "", $url);

// Route the request to the appropriate view.
switch ($parent) {
    case "resources":
		resources($url);
        break;
    case "xml":
		xml($teiFile);
        break;
	case "text":
		text($teiFile);
        break;
	case "markup":
		markup($teiFile);
        break;
	case "elements":
		// Is there more data in the URI request?
		if(!empty($children)){
			// Is the URI request have too many slashes?
			if(count($children) > 1){
				$request = implode("/", array_slice($children, 0));
				error($teiFile, $url, $request);
			}else{
				switch ($children[0]){
					case "annotations":
						annotation($teiFile);
						break;
					case "teiheaders":
						teiHeader($teiFile);
						break;
					default:
						displayElementChildren($teiFile, $url, $children[0]);
						break;
				}
			}
		}else{
			element($teiFile);
		}
        break;
    default:
		welcome($teiFile, $url);
        break;
}

?>