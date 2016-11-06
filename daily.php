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
    <!-- Latest compiled and minified CSS -->
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>

<?php 
/**
 * Template Name: Daily
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
                                                   
                                            if(isset($_POST['submit'])) /* i.e. the PHP code is executed only when someone presses Submit button in the below given HTML Form */
                                            {
                                            $var = $_POST['any_name'];   // Here $var is the input taken from user.
                                            global $wpdb ;
                                                $weather = $wpdb->get_results("SELECT * FROM `TABLE 48`, `city_india`, `weather_pics` WHERE `TABLE 48`.`city_id` = `city_india`.`City_id` AND `weather_pics`.`pic_name` = `TABLE 48`.`conditions` AND `city_india`.`City_name` = '$var' ;" ) ;
                                                echo "<h2>".$var."</h2>" ;
                                                echo '<div class = "row">';
                                                foreach($weather as $w){
                                                    //echo '<div class = "row">';
                                                    echo '<div class = "col-md-4">' ;
                                                    echo "<h3>".date('Y-m-d h:i:s',$w->date_time)."</h3>"; 
                                                    echo '<h6 style = "float:right">'."Pressure - ".$w->pressure."</h6>" ;
                                                    echo "<h5>"."Day - ".$w->temp_day."</h5>" ;
                                                    echo "<h5>"."Night - ".$w->temp_night."</h5>" ;
                                                    echo "<h5>"."Evening - ".$w->temp_eve."</h5>" ;
                                                    echo '<h6 style = "float:right">'."Humidity - ".$w->humidity."</h6>" ;
                                                    echo "<h6>"."Min - ".$w->temp_min."</h6>" ;
                                                    echo "<h6>"."Max - ".$w->temp_max."</h6>" ;
                                                    echo "<h4>".$w->description."</h4>" ;
                                                    echo "</div>" ;
                                                    echo '<div class = "col-md-2">' ;
                                                    echo "<p>".'<img style ="float:right; width:200px; height:200px" src="data:image/png;base64,' . base64_encode( $w->pic ) . '" />'."</p>";
                                                    echo "</div>" ;
                                                    //echo "</div>";
                                                }
                                                echo "</div>" ;
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
