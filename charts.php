<?php 
/**
 * Template Name: Charts
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
											<!DOCTYPE HTML>
											<html>
											<head>
											 <meta charset="utf-8">
											 <title>
											 Create Google Charts
											 </title>
											 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
											 <script type="text/javascript">
											 google.load("visualization", "1", {packages:["corechart"]});
											 google.setOnLoadCallback(drawChart);
											 function drawChart() {

											 var data = google.visualization.arrayToDataTable([
											 ['Temperature', 'City'],
											 <?php 
											 global $wpdb ;
											 $query = $wpdb->get_results("SELECT temp, City_name  FROM `TABLE 18`, `city_india` WHERE `TABLE 18`.`city_id` = `city_india`.`City_id` GROUP BY City_name ;") ;

										
											 foreach ($query as $q) {

													 echo "['".$q->City_name."',".$q->temp."],";
													 }
											 ?>
											 ]);

											
										        var options = {
										          title: 'Temperature Variation',
										          curveType: 'function',
										          legend: { position: 'bottom' }
										        };

											 var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

											 chart.draw(data, options);
											 }
											 </script>
											</head>
											<body>
											 <div id="curve_chart" style="width: 1100px; height: 400px; "></div>
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
    </div><!--layer_wrapper class END-->

<?php get_footer(); ?>
