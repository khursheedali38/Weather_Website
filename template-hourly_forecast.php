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
                                            //Taking user input via forms
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
