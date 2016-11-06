<?php 
/**
 * Template Name: Heat Map
 *
 * Displays the Pages.
 *
 * @package Optimizer
 * 
 * @since Optimizer 1.0
 */
global $optimizer;?>

<?php get_header(); ?>
   <div class="page_wrap layer_wrapper">

        <!--CUSTOM PAGE HEADER STARTS-->
            <?php get_template_part('framework/core','pageheader'); ?>
        <!--CUSTOM PAGE HEADER ENDS-->
    
        <div id="content">
            <div class="center">
                <div class="single_wrap<?php if ( !is_active_sidebar( 'sidebar' ) ) { ?> no_sidebar<?php } ?>">
                    <div class="single_post">
                        <?php if(have_posts()): ?><?php while(have_posts()): ?><?php the_post(); ?>
                        <div <?php post_class(); ?> id="post-<?php the_ID(); ?>">  
                                    
                        <!--EDIT BUTTON START-->
                            <?php if ( is_user_logged_in() || is_admin() ) { ?>
                                    <div class="edit_wrap">
                                  <a href="<?php echo get_edit_post_link(); ?>">
                                    <?php _e('Edit','optimizer'); ?>
                                    </a>
                                </div>
                            <?php } ?>
                        <!--EDIT BUTTON END-->
                        
                        <!--PAGE CONTENT START-->   
                        <div class="single_post_content">
                        
                                <!--THE CONTENT START-->
                                    <div class="thn_post_wrap">
                                        <?php the_content(); ?>

<!DOCTYPE html>
<html>
 <style>
      
      #floating-panel {
        position: absolute;
        top: 10px;
        left: 25%;
        z-index: 5;
        background-color: #fff;
        padding: 5px;
        border: 1px solid #999;
        text-align: center;
        font-family: 'Roboto','sans-serif';
        line-height: 30px;
        padding-left: 10px;
      }
      #floating-panel {
        background-color: #fff;
        border: 1px solid #999;
        left: 35%;
        padding: 5px;
        position: absolute;
        top: 100px;
        z-index: 5;
      }
    </style>
<head>
<title>HeatMap</title>
<script>
 var heatMapData=[];//empty array to store objects
 var heatmap;
 var pointArray;

    function initialize() {
    var mapOptions = {
      zoom: 5,
      center: new google.maps.LatLng(22.5697, 88.3697),
      mapTypeId: google.maps.MapTypeId.SATELLITE
    };
    var map = new google.maps.Map(document.getElementById("map_canvas"),
        mapOptions);

         function downloadUrl(url, callback) {
  var request = window.ActiveXObject ?
      new ActiveXObject('Microsoft.XMLHTTP') :
      new XMLHttpRequest;

  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      request.onreadystatechange = doNothing;
      callback(request, request.status);
    }
  };

  request.open('GET', url, true);
  request.send(null);
 }
 function doNothing() {}

 downloadUrl("http://localhost/website/wordpress/wp-content/themes/optimizer/phpsqlajax_genxmlheat.php", function(data) {
       var xml = data.responseXML;
       var markers = xml.documentElement.getElementsByTagName("marker");
 for (var i = 0; i<markers.length; i++) { //loop through nodes getting info
    var point = new google.maps.LatLng(
    parseFloat(markers[i].getAttribute("lat")),
    parseFloat(markers[i].getAttribute("lng")));
    var intensity = markers[i].getAttribute("temp");
    var hObj =  { //create object
    location: point,
    weight : intensity
    };

 heatMapData.push(point); //push object onto array

          } 
 });
   pointArray = new google.maps.MVCArray(heatMapData); //convert array to MVC array
   heatmap = new google.maps.visualization.HeatmapLayer({
      data: heatMapData
    }); //create heat map object

    heatmap.setMap(map); //display heat map on map
}


  function changeGradient() {
    var gradient = [
      'rgba(0, 255, 255, 0)',
      'rgba(0, 255, 255, 1)',
      'rgba(0, 191, 255, 1)',
      'rgba(0, 127, 255, 1)',
      'rgba(0, 63, 255, 1)',
      'rgba(0, 0, 255, 1)',
      'rgba(0, 0, 223, 1)',
      'rgba(0, 0, 191, 1)',
      'rgba(0, 0, 159, 1)',
      'rgba(0, 0, 127, 1)',
      'rgba(63, 0, 91, 1)',
      'rgba(127, 0, 63, 1)',
      'rgba(191, 0, 31, 1)',
      'rgba(255, 0, 0, 1)'
    ]
    heatmap.setOptions({
      gradient: heatmap.get('gradient') ? null : gradient
    });
  }

  function changeRadius() {
    heatmap.setOptions({radius: heatmap.get('radius') ? null : 20});
  }

  function changeOpacity() {
    heatmap.setOptions({opacity: heatmap.get('opacity') ? null : 0.2});
  }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8YtC3hhJkvzhNHl7ichNCiU9FM31KR4M&libraries=visualization">
    </script>
</head>
<body onload="initialize()">
<div id="map_canvas" style="height: 900px; width: 1000px;">
</div>
<div id="floating-panel">
<button onclick="changeGradient()">Change gradient</button>
<button onclick="changeRadius()">Change radius</button>
<button onclick="changeOpacity()">Change opacity</button>
</div>
</body>
</html>
</html>
          </div>
                                        <div style="clear:both"></div>
                                    <div class="thn_post_wrap wp_link_pages">
                                        <?php wp_link_pages('<p class="pages"><strong>'.__('Pages:', 'optimizer').'</strong> ', '</p>', 'number'); ?>
                                    </div>
                                <!--THE CONTENT END-->
                        </div>
                        <!--PAGE CONTENT END--> 
                                    
                                    
                        </div>
                   
                   <?php endwhile ?> 
                    </div>
                    
                    
                  <!--COMMENT START: Calling the Comment Section. If you want to hide comments from your posts, remove the line below-->     
                  <?php if (!empty ($optimizer['post_comments_id'])) { ?>
                      <div class="comments_template">
                          <?php comments_template('',true); ?>
                      </div>
                  <?php }?> 
                  <!--COMMENT END-->
                  
                  <?php endif ?>
                
                    </div>
               
                <!--PAGE END-->
            
            
                <!--SIDEBAR START--> 
                   <!-- <?php get_sidebar(); ?>-->
                <!--SIDEBAR END--> 
            
                    </div>
            </div>
    </div><!--layer_wrapper class END-->


<?php get_footer(); ?>
