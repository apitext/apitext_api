<?php 
	header('Content-Type: application/json');
?>
{
  "resources": {
    "response": "Returns a welcome message and a link to the Resources endpoint.",
    "url": "<?php echo $url; ?>/api/v1/resources"
  },
  "xml": {
    "response": "Returns the TEI-XML view of the TEI-XML file.",
    "url": "<?php echo $url; ?>/api/v1/xml"
  },
  "text": {
    "response": "Returns a text only view of the tei-xml file.",
    "url": "<?php echo $url; ?>/api/v1/text"
  },
  "markup": {
    "response": "Returns a markup only (html) view of the tei-xml file.",
    "url": "<?php echo $url; ?>/api/v1/markup"
  },
  "annotation": {
    "response": "Returns a listing of all annotation tags contained in the tei-xml.",
    "url": "<?php echo $url; ?>/api/v1/annotation"
  },
  "teiheader": {
    "response": "Returns a listing of all the first level teiHeader tags contained in the tei-xml file.",
    "url": "<?php echo $url; ?>/api/v1/teiheader"
  }
}