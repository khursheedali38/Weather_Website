<?php
//require("phpsqlajax_dbinfo.php");
require_once('../../../wp-config.php');
function parseToXML($htmlStr)
{
$xmlStr=str_replace('<','&lt;',$htmlStr);
$xmlStr=str_replace('>','&gt;',$xmlStr);
$xmlStr=str_replace('"','&quot;',$xmlStr);
$xmlStr=str_replace("'",'&#39;',$xmlStr);
$xmlStr=str_replace("&",'&amp;',$xmlStr);
return $xmlStr;
}

// Opens a connection to a MySQL server
/*$connection=mysql_connect ('localhost', $username, $password);
if (!$connection) {
  die('Not connected : ' . mysql_error());
}

// Set the active MySQL database
$db_selected = mysql_select_db($database, $connection);
if (!$db_selected) {
  die ('Can\'t use db : ' . mysql_error());
}
*/
// Select all the rows in the markers table
global $wpdb ;
$query = $wpdb->get_results("SELECT * FROM markers WHERE 1;") ;
/*$result = mysql_query($query);
  if (!$result) {
  die('Invalid query: ' . mysql_error());
}*/

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
foreach ($query as $q) 
  {
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML($q->name) . '" ';
  echo 'address="' . parseToXML($q->address) . '" ';
  echo 'lat="' . $q->lat . '" ';
  echo 'lng="' . $q->lng . '" ';
  echo 'type="' . $q->type . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>
