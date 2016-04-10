<?php
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
$url = str_replace("/apitext_api/php/router.php", "", $url);

// Route the request to the appropriate view.
switch ($endpoint) {
    case "/api/v1/resources":
		include_once "views/resources.php";
        break;
    case "/api/v1/xml":
		include_once "views/xml.php";
        break;
	case "/api/v1/text":
		include_once "views/text.php";
        break;
	case "/api/v1/markup":
		include_once "views/markup.php";
        break;
	case "/api/v1/annotation":
        include_once "views/annotation.php";
        break;
	case "/api/v1/teiheader":
        include_once "views/teiheader.php";
        break;
    default:
		include_once "views/welcome.php";
}

?>