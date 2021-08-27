<?php


get_header(); ?>



<div class="text">
              <h2><?php echo get_option('time_title'); ?></h2>
              </div><!--end text-->
                  
              <div class="counter">
              <h3><?php echo get_option('time_before'); ?></h3>
              <div id="defaultCountdown"> 
       
    </div>

         </div><!--end counter-->
                 
         <div class="details">
              <!--slider prev button-->    
            <a class="prev" href="#"><img src="<?php bloginfo("template_url"); ?>/images/prev.png" alt="" /> 
            </a>

                  <div id="sliderwrap">
                  		<div id="slidertext"><!-- The slider -->
                            
                                <ul>
                                   
                            
                                	 <li>
                                        <h3><?php echo get_option('email_text'); ?></h3>
                                       
                                       
                                    <form id="subscribeform" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_option('feedburner_id'); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
                                    <p>
                                    <div id="email_input"><input type="text" size="30" id="email" name="email" value="Enter Your E-mail" onfocus="if(this.value=='Enter Your E-mail'){this.value=''};" 	onblur="if(this.value==''){this.value='Enter Your E-mail'};" />
                                    <input type="hidden" value="<?php echo get_option('feedburner_id'); ?>" name="uri"/>
                                    <input type="hidden" name="loc" value="en_US"/>
                                    
                                    <input type="submit" id="submit" value="Submit" size="80"/></div>
                                    </p>
                                    </form>                                 
                                 	</li><!-- Slider item -->
                                 
                                 
                                   <li>
                                         <h3><?php echo get_option('social_text'); ?></h3>
                                         <div class="social">
                                         <a href="http://www.twitter.com/<?php echo get_option('twitter_account'); ?>" class="twitter"></a>
                                         <a href="http://www.flickr.com/photos/<?php echo get_option('flickr_account'); ?>/" class="flickr"></a>
                                         <a href="http://www.facebook.com/people/<?php echo get_option('facebook_account'); ?>" class="facebook"></a>
                                         <a href="#" class="youtube"></a>
                                         </div>
                                     </li><!-- Slider item -->
                                 
                                 	<li>
                                         <h3><?php echo get_option('about_us_title'); ?></h3>
                                         <p><?php echo get_option('about_us_text'); ?></p>
                                        
                                 
                                	 </li><!-- Slider item -->
                            
                                </ul>
                            
             	 </div><!-- End of slidertext -->
    
              </div><!-- End of sliderwrap -->

					<!--slider next button-->
             	<a class="next" href="#"><img src="<?php bloginfo("template_url"); ?>/images/next.png" alt=""/></a>

                  
                  </div><!--end details-->  
              




<?php get_footer(); ?>