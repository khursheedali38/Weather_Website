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
 $query = $wpdb->get_results("SELECT * FROM `TABLE 18`, `city_india`, `weather_pics` WHERE `TABLE 18`.`city_id` = `city_india`.`City_id` AND `weather_pics`.`pic_name` = `TABLE 18`.`conditions`;") ;
 /*echo "<table>";             
  foreach($query as $q){
  echo "<tr>";
  //echo "<td>".date('Y-m-d h:i:s',$w->time)."</td>"; to convert unix epoch time to ist
  echo "<td>".$q->City_name."</td>";
  echo "<td>".$q->temp."</td>";
  echo "<td>".'<img src="data:image/png;base64,' . base64_encode( $q->pic ) . '" />'."</td>";
  //echo "<td>".$q->type."</td>";
  echo "</tr>";
  }
  echo "</table>";*/

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
foreach ($query as $q) 
  {
  // ADD TO XML DOCUMENT NODE
  echo '<marker ';
  echo 'name="' . parseToXML($q->City_name) . '" ';
  echo 'description="' . parseToXML($q->description_weather) . '" ';
  echo 'lat="' . $q->lattitude . '" ';
  echo 'lng="' . $q->longitude . '" ';
  //echo 'type="' . $q->type . '" ';
  echo 'temp="'. $q->temp . '" ';
  echo 'pic="' . base64_encode( $q->pic )  . '" ';
  //echo 'pic="' . '<img src="data:image/png;base64,' . base64_encode( $q->pic ) . '" />' . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';

?>