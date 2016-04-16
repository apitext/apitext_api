<?php
include("view.php");

// Import configuration settings.
$teiFolder = "sample_tei_project";
$teiFile = "TEI-XML_test_file.xml";

// Retrieve the URI and convert it into a endpoint.
$uri = $_SERVER['REQUEST_URI'];
$uri = trim($uri);
$uri = rtrim($uri, '/');
$endpoint = substr($uri, strpos($uri, $teiFolder) + strlen($teiFolder));

// Retrieve the URI and convert it into a well formed URL.
$url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['PHP_SELF'];
$url = str_replace("/apitext_api/router.php", "", $url);

// Route the request to the appropriate view.
switch ($endpoint) {
    case "/api/v1/resources":
		resources($url);
        break;
    case "/api/v1/xml":
		xml($teiFile);
        break;
	case "/api/v1/text":
		text($teiFile);
        break;
	case "/api/v1/markup":
		markup($teiFile);
        break;
	case "/api/v1/annotation":
        annotation($teiFile);
        break;
	case "/api/v1/teiheader":
        teiHeader($teiFile);
        break;
    default:
		welcome($teiFile, $url);
        break;
}

?>