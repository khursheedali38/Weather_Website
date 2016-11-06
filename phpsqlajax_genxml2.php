
<?php 
/**
 * 
 *
 * Displays the Pages.
 *
 * @package Optimizer
 * 
 * @since Optimizer 1.0
 */
global $optimizer;?>
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
         /* $connection=mysql_connect ('localhost', $username, $password);
          if (!$connection) {
            die('Not connected : ' . mysql_error());
          }

          // Set the active MySQL database
          $db_selected = mysql_select_db($database, $connection);
          if (!$db_selected) {
            die ('Can\'t use db : ' . mysql_error());
          }*/

          // Select all the rows in the markers table
          global $wpdb ;
          $query = $wpdb->get_results("SELECT * FROM `markers` ;") ;
              /*echo "<table>";
              
              foreach($query as $q){
              echo "<tr>";
              //echo "<td>".date('Y-m-d h:i:s',$w->time)."</td>"; to convert unix epoch time to ist
              echo "<td>".$q->name."</td>";
              echo "<td>".$q->address."</td>";
              echo "<td>".$q->type."</td>";
              echo "</tr>";
              }
              echo "</table>";*/

          /*$result = mysql_query($query);
          if (!$result) {
            die('Invalid query: ' . mysql_error());
          }*/

          header("Content-type: text/xml");

          // Start XML file, echo parent node
          $data= '<markers> ';

           while ($row = @mysql_fetch_assoc($query)){

           $data1 = '<marker ' . 'name="' . parseToXML($row['name']) . '" ' .
              'address="' . parseToXML($row['address']) . '" ' . 'lat="' . $row['lat'] . '" ' .
              'lng="' . $row['lng'] . '" ' . 'type="' . $row['type'] . '" ' . '/>';

           }

          $data2 = '</markers>';

          $xmlData = $data. $data1 . $data2;
          file_put_contents("xmldata1.xml", $xmlData);


?>
