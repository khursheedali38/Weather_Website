<!--<table>
    <thead>
    <tr>
        <th>Username</th>
        <th>Email</th>
        <th>First Name</th>
        <th>Middle Name</th>
        <th>Last Name</th>
        <th>Status</th>
        <th>Photo</th>
        <th>Date</th>
        <th>Option</th>
     </tr>
    </thead>
    <tbody>-->
<?php 
/**
 * Template Name: hourly
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
                                                                                                       
                                                      
                                          <?php
                                                /*global $wpdb;
                                                $weather = $wpdb->get_results("SELECT * FROM weather_data_hourly  JOIN weather_pics WHERE Conditions = pic_name ;");
                                                echo "<table>";
												foreach($weather as $w){
												echo "<tr>";
												echo "<td>".$w->TimeIST."</td>";
												echo "<td>".$w->TemperatureC."</td>";
												echo "<td>".$w->Dew_PointC."</td>";
												echo "<td>".$w->Humidity."</td>";
												echo "<td>".$w->Sea_Level_PressurehPa."</td>";
												echo "<td>".$w->VisisbilityKm."</td>";
												echo "<td>".$w->Wind_Speed_Kmh."</td>";*/
                                                /*echo "<td>".date('Y-m-d h:i:s',$w->Wind_Direction)."</td>";*/
												/*echo "<td>".$w->GustSpeedKmh."</td>";
												echo "<td>".$w->Precipitationmm."</td>";
												echo "<td>".$w->Conditions."</td>";
												echo "<td>".'<img src="data:image/png;base64,' . base64_encode( $w->pic ) . '" />'."</td>";
												echo "</tr>";
												}
												echo "</table>";*/

												/*global $wpdb ;
												$weather = $wpdb->get_results("SELECT * FROM `TABLE 18`, `city_india`,`weather_pics` WHERE `TABLE 18`.`city_id` = `city_india`.`City_id` AND `weather_pics`.`pic_name` = `TABLE 18`.`conditions` AND `city_india`.`City_name` = 'Mangalore'
													UNION
													SELECT * FROM `TABLE 18`, `city_india`,`weather_pics` WHERE `TABLE 18`.`city_id` = `city_india`.`City_id` AND `weather_pics`.`pic_name` = `TABLE 18`.`conditions` AND `city_india`.`City_name` = 'Mysore'
													UNION
													SELECT * FROM `TABLE 18`, `city_india`,`weather_pics` WHERE `TABLE 18`.`city_id` = `city_india`.`City_id` AND `weather_pics`.`pic_name` = `TABLE 18`.`conditions` AND `city_india`.`City_name` = 'Mumbai'
													UNION
													SELECT * FROM `TABLE 18`, `city_india`,`weather_pics` WHERE `TABLE 18`.`city_id` = `city_india`.`City_id` AND `weather_pics`.`pic_name` = `TABLE 18`.`conditions` AND `city_india`.`City_name` = 'Hyderabad'
													UNION
													SELECT * FROM `TABLE 18`, `city_india`,`weather_pics` WHERE `TABLE 18`.`city_id` = `city_india`.`City_id` AND `weather_pics`.`pic_name` = `TABLE 18`.`conditions` AND `city_india`.`City_name` = 'Jammu'
													UNION
													SELECT * FROM `TABLE 18`, `city_india`,`weather_pics` WHERE `TABLE 18`.`city_id` = `city_india`.`City_id` AND `weather_pics`.`pic_name` = `TABLE 18`.`conditions` AND `city_india`.`City_name` = 'Ahmadabad';" );
												echo "<table>";
												foreach($weather as $w){
												echo "<tr>";
                                                echo "<td>".date('Y-m-d h:i:s',$w->time)."</td>";
												echo "<td>".$w->City_name."</td>";
												echo "<td>".$w->temp."</td>";

												echo "<td>".$w->conditions."</td>";
												echo "<td>".'<img src="data:image/png;base64,' . base64_encode( $w->pic ) . '" />'."</td>";
												echo "</tr>";
												}
												echo "</table>";*/

                                                //HOURLY starts
                                            if(isset($_POST['submit'])) /* i.e. the PHP code is executed only when someone presses Submit button in the below given HTML Form */
                                            {
                                            $var = $_POST['any_name'];   // Here $var is the input taken from user.
                                            global $wpdb ;
                                                $weather = $wpdb->get_results("SELECT * FROM `hourly`, `city_india`,`weather_pics` WHERE `hourly`.`city_id` = `city_india`.`City_id` AND `weather_pics`.`pic_name` = `hourly`.`events` AND `city_india`.`City_name` = '$var' ;" ) ;
                                                echo "<table>";
                                                
                                                foreach($weather as $w){
                                                echo "<tr>";
                                                //echo "<td>".date('Y-m-d h:i:s',$w->time)."</td>"; to convert unix epoch time to ist
                                                echo "<td>".$w->time."</td>";
                                                echo "<td>".$w->City_name."</td>";
                                                echo "<td>".$w->temp."</td>";
                                                echo "<td>".$w->conditions."</td>";
                                                echo "<td>".'<img src="data:image/png;base64,' . base64_encode( $w->pic ) . '" />'."</td>";
                                                echo "</tr>";
                                                }
                                                echo "</table>";

                                            }
                                           ?>
                                            <hr/>
                                            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                                            <input type="text" name="any_name">
                                            <input type="submit" name="submit">
                                            </form>
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
