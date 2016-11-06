<?php


function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}
require_once('../../../wp-config.php');
// Select all the rows in the markers table
 global $wpdb ;
 $query = $wpdb->get_results("SELECT lattitude, longitude, temp FROM `TABLE 18`;") ;

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
foreach ($query as $q) 
  {
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'lat="' . $q->lattitude . '" ';
  echo 'lng="' . $q->longitude . '" ';
  echo 'temp="' . $q->temp . '" ';

  echo '/>';
}

// End XML file
echo '</markers>';

?>