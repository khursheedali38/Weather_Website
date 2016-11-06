<?php
/**
 * Template Name: Google Maps API Table 18
 *
 * This template is used to demonstrate how to use Google Maps
 * in conjunction with a WordPress theme.
 *
 * @package Optimizer
 * 
 * @since Optimizer 1.0
 */
?>

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

                                              <!DOCTYPE html >
                                                <head>
                                                  <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
                                                  <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
                                                  <title>PHP/MySQL & Google Maps Example</title>
                                                  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC8YtC3hhJkvzhNHl7ichNCiU9FM31KR4M"
                                                          type="text/javascript"></script>
                                                  
                                                  <script type="text/javascript">
                                                  //<![CDATA[

                                                  var customIcons = {
                                                    restaurant: {
                                                      icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png'
                                                    },
                                                    bar: {
                                                      icon: 'http://labs.google.com/ridefinder/images/mm_20_red.png'
                                                    }
                                                  };

                                                  function load() {
                                                    var map = new google.maps.Map(document.getElementById("map"), {
                                                      center: new google.maps.LatLng(17.385044, 78.486671),
                                                      zoom: 4,
                                                      mapTypeId: 'roadmap'
                                                    });
                                                    var infoWindow = new google.maps.InfoWindow;

                                                    //jQuery.get("http://localhost/website/wordpress/wp-content/themes/optimizer/phpsqlajax_genxml2.php");

                                                    // Change this depending on the name of your PHP file
                                                    downloadUrl("http://localhost/website/wordpress/wp-content/themes/optimizer/phpsqlajax_genxml_table18.php", function(data) {
                                                      var xml = data.responseXML;
                                                      
                                                      var markers = xml.documentElement.getElementsByTagName("marker");
                                                      for (var i = 0; i < markers.length; i++) {
                                                        var name = markers[i].getAttribute("name");
                                                        var temp = markers[i].getAttribute("temp");
                                                        var description = markers[i].getAttribute("description");
                                                        var pic = markers[i].getAttribute("pic") ;
                                                        var point = new google.maps.LatLng(
                                                            parseFloat(markers[i].getAttribute("lat")),
                                                            parseFloat(markers[i].getAttribute("lng")));
                                                        //var crosshair = "data:image/png;base64, pic" ;
                                                        var html = "<b>" + name + "</b> <br/>" + description + "</b> <br/>" + temp + "</b> <br/>" + '<img src="data:image/png;base64,'+ pic + '"/>' ;
                                                        //var icon = customIcons[type] || {};
                                                        var marker = new google.maps.Marker({
                                                          map: map,
                                                          position: point,
                                                          //animation: google.maps.Animation.DROP
                                                         // icon: icon.icon
                                                        });
                                                        bindInfoWindow(marker, map, infoWindow, html);
                                                      }
                                                    }); 
                                                  }

                                                  function bindInfoWindow(marker, map, infoWindow, html) {
                                                    google.maps.event.addListener(marker, 'mouseover', function() {
                                                      infoWindow.setContent(html);
                                                      infoWindow.open(map, marker);
                                                      if (marker.getAnimation() !== null) {
                                                        marker.setAnimation(null);
                                                      } else {
                                                        marker.setAnimation(google.maps.Animation.BOUNCE);
                                                      }
                                                    });

                                                    google.maps.event.addListener(marker, 'mouseout', function() {
                                                      infoWindow.close();
                                                    });
                                                  }

                                                  function downloadUrl(url, callback) {
                                                    var request = window.ActiveXObject ?
                                                        new ActiveXObject('Microsoft.XMLHTTP') :
                                                        new XMLHttpRequest;

                                                    request.onreadystatechange = function() {
                                                      if (request.readyState == 4) {
                                                      	console.log(request.readyState) ;
                                                        request.onreadystatechange = doNothing;
                                                        callback(request, request.status);
                                                      }
                                                    };

                                                    request.open('GET', url, true);
                                                    request.send(null);
                                                  }

                                                  function doNothing() {}

                                                  //]]>

                                                </script>

                                                </head>

                                                <body onload="load()">
                                                  <div id="map" style="width: 1200px; height: 600px"></div>
                                                </body>

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



<?php get_footer(); ?>