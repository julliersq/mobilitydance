        <?php
        $currentPage = get_queried_object();

        $pageID = $currentPage->ID;

        $j2dk_custom_theme_options = get_option('j2dk_custom_theme_options');
        ?>

        <!-- Footer Wrapper -->
        <div id="footer-wrapper">
            <footer id="footer" class="container">
                <div class="row">
                    <?php
                    /*
                    <div class="3u">

                        <!-- Links -->
                        <section>
                            <h2>Filler Links</h2>
                            <ul class="divided">
                                <li><a href="#">Quam turpis feugiat dolor</a></li>
                                <li><a href="#">Amet ornare in hendrerit </a></li>
                                <li><a href="#">Semper mod quisturpis nisi</a></li>
                                <li><a href="#">Consequat etiam phasellus</a></li>
                                <li><a href="#">Amet turpis, feugiat et</a></li>
                                <li><a href="#">Ornare hendrerit lectus</a></li>
                                <li><a href="#">Semper mod quis et dolore</a></li>
                                <li><a href="#">Amet ornare in hendrerit</a></li>
                                <li><a href="#">Consequat lorem phasellus</a></li>
                                <li><a href="#">Amet turpis, feugiat amet</a></li>
                                <li><a href="#">Semper mod quisturpis</a></li>
                            </ul>
                        </section>

                    </div>
                    <div class="3u">

                        <!-- Links -->
                        <section>
                            <h2>More Filler</h2>
                            <ul class="divided">
                                <li><a href="#">Quam turpis feugiat dolor</a></li>
                                <li><a href="#">Amet ornare in in lectus</a></li>
                                <li><a href="#">Semper mod sed tempus nisi</a></li>
                                <li><a href="#">Consequat etiam phasellus</a></li>
                            </ul>
                        </section>

                        <!-- Links -->
                        <section>
                            <h2>Even More Filler</h2>
                            <ul class="divided">
                                <li><a href="#">Quam turpis feugiat dolor</a></li>
                                <li><a href="#">Amet ornare hendrerit lectus</a></li>
                                <li><a href="#">Semper quisturpis nisi</a></li>
                                <li><a href="#">Consequat lorem phasellus</a></li>
                            </ul>
                        </section>

                    </div>
                     * 
                     */
                    ?>
                    <div class="3u">

                        <!-- About -->
                        <section>
                            <h2><strong><?php echo get_bloginfo( 'name' ); ?></strong></h2>
                            <p><?php echo $j2dk_custom_theme_options ['about_excerpt']; ?></p>
                            <a href="/?p=9" class="button alt icon fa-arrow-circle-right">Learn More</a>
                        </section>
                    </div>
                    <div class="9u">
                        <!-- Contact -->
                        <section>
                            <h2>Get in touch</h2>
                            <div>
                                <div class="row">
                                    <div class="8u">
                                        <dl class="contact">
                                            <?php
                                            if( isset($j2dk_custom_theme_options ['email']) && trim($j2dk_custom_theme_options ['email']) != '' ){
                                            ?>                                            
                                            <dt>Email</dt>
                                            <dd><a href="mailto:<?php echo $j2dk_custom_theme_options ['email']; ?>"><?php echo $j2dk_custom_theme_options ['email']; ?></a></dd>
                                            <?php
                                            }                                                  
                                            if( isset($j2dk_custom_theme_options ['twitter_link']) && trim($j2dk_custom_theme_options ['twitter_link']) != '' ){
                                            ?>
                                            <dt>Twitter</dt>
                                            <dd><a href="<?php echo $j2dk_custom_theme_options ['twitter_link']; ?>"><?php echo $j2dk_custom_theme_options ['twitter_link']; ?></a></dd>
                                            <?php
                                            }
                                            if( isset($j2dk_custom_theme_options ['facebook_link']) && trim($j2dk_custom_theme_options ['facebook_link']) != '' ){
                                            ?>
                                            <dt>Facebook</dt>
                                            <dd><a href="<?php echo $j2dk_custom_theme_options ['facebook_link']; ?>"><?php echo $j2dk_custom_theme_options ['facebook_link']; ?></a></dd>
                                            <?php
                                            }
                                            if( isset($j2dk_custom_theme_options ['linkedin_link']) && trim($j2dk_custom_theme_options ['linkedin_link']) != '' ){
                                            ?>
                                            <dt>LinkedIn</dt>
                                            <dd><a href="<?php echo $j2dk_custom_theme_options ['linkedin_link']; ?>"><?php echo $j2dk_custom_theme_options ['linkedin_link']; ?></a></dd>
                                            <?php
                                            }
                                            if( isset($j2dk_custom_theme_options ['youtube_link']) && trim($j2dk_custom_theme_options ['youtube_link']) != '' ){
                                            ?>
                                            <dt>YouTube</dt>
                                            <dd><a href="<?php echo $j2dk_custom_theme_options ['youtube_link']; ?>"><?php echo $j2dk_custom_theme_options ['youtube_link']; ?></a></dd>
                                            <?php
                                            }
                                            if( isset($j2dk_custom_theme_options ['instagram_link']) && trim($j2dk_custom_theme_options ['instagram_link']) != '' ){
                                            ?>
                                            <dt>Instagram</dt>
                                            <dd><a href="<?php echo $j2dk_custom_theme_options ['instagram_link']; ?>"><?php echo $j2dk_custom_theme_options ['instagram_link']; ?></a></dd>
                                            <?php
                                            }
                                            ?>
                                        </dl>
                                    </div>
                                    <div class="4u">
                                        <dl class="contact">
                                            <?php                                            
                                            if( isset($j2dk_custom_theme_options ['address']) && trim($j2dk_custom_theme_options ['address']) != '' ||
                                                isset($j2dk_custom_theme_options ['city']) && trim($j2dk_custom_theme_options ['city']) != '' 
                                               ){
                                            ?>                                            
                                            <dt>Address</dt>
                                            <dd>
                                                <?php 
                                                if( isset($j2dk_custom_theme_options ['address']) && trim($j2dk_custom_theme_options ['address']) != '' ){
                                                    echo $j2dk_custom_theme_options ['address'].'<br />'; 
                                                }
                                                ?>
                                                <?php                                                 
                                                echo $j2dk_custom_theme_options ['city'];
                                                if( isset($j2dk_custom_theme_options ['city']) && trim($j2dk_custom_theme_options ['city']) != '' && 
                                                    isset($j2dk_custom_theme_options ['province']) && trim($j2dk_custom_theme_options ['province']) != '' ){
                                                    
                                                    echo ', '.$j2dk_custom_theme_options ['province'];
                                                }
                                                elseif( isset($j2dk_custom_theme_options ['province']) && trim($j2dk_custom_theme_options ['province']) != '' ){
                                                    echo $j2dk_custom_theme_options ['province'];
                                                }
                                                if( isset($j2dk_custom_theme_options ['postal_code']) && trim($j2dk_custom_theme_options ['postal_code']) != '' ){
                                                    echo ' '.$j2dk_custom_theme_options ['postal_code']; 
                                                }                                                                                                
                                                ?>                                                
                                            </dd>
                                            <?php
                                            }
                                            if( isset($j2dk_custom_theme_options ['phone']) && trim($j2dk_custom_theme_options ['phone']) != '' ){
                                            ?>                                            
                                            <dt>Phone</dt>
                                            <dd><?php echo $j2dk_custom_theme_options ['phone']; ?></dd>
                                            <?php
                                            }
                                            if( isset($j2dk_custom_theme_options ['fax']) && trim($j2dk_custom_theme_options ['fax']) != '' ){
                                            ?>                                            
                                            <dt>Fax</dt>
                                            <dd><?php echo $j2dk_custom_theme_options ['fax']; ?></dd>
                                            <?php
                                            }                                      
                                            ?>
                                        </dl>
                                    </div>
                                </div>
                            </div>
                        </section>

                    </div>
                </div>
                <div class="row">
                    <div class="12u">
                        <div id="copyright">
                            <ul class="menu">
                                <li>&copy; <?php echo get_bloginfo( 'name' ); ?>. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <?php
        wp_footer();
        ?>      
    </body>
</html>