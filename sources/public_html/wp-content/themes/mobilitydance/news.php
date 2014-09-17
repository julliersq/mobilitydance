<?php
/*
  Template Name: News Page
 */

get_header();
?>
        <!-- Main Wrapper -->
        <div id="main-wrapper">
            <div class="wrapper style2">
                <div class="inner">
                    <div class="container">
                        <div class="row">
                            <div class="12u skel-cell-important">
                                <div id="content">

                                    <!-- Content -->

                                    
                                        <div id="page-content">
                                            <?php
                                            $args = array(
                                                'posts_per_page'   => 10,                
                                                'category'         => '4');
                                                $news = get_posts( $args );
                                            ?>
                                            
                    <div class="container">                        
                        <div class="row">   
                            <?php
                            if( count($news) > 0 ){
                            ?>                            
                            <div class="12u">

                                <!-- Article list -->
                                <section class="box article-list">
                                    <h2 class="icon fa-file-text-o">News</h2>
                                    <?php
                                    foreach($news as $currentNews){
                                    ?>
                                    <!-- Excerpt -->
                                    <article class="box excerpt">
                                        <a href="/?p=<?php echo $currentNews->ID; ?>" class="image left"><?php echo get_the_post_thumbnail( $currentNews->ID, 'footer-post-feature', $attr ); ?></a>
                                        <div>
                                            <header>
                                                <span class="date"><?php echo date("F j, Y", strtotime($currentNews->post_date)); ?></span>
                                                <h3><a href="/?p=<?php echo $currentNews->ID; ?>"><?php echo $currentNews->post_title; ?></a></h3>
                                            </header>
                                            <p><?php echo j2dk_format_string($currentNews->post_content, false, true, 200); ?></p>
                                        </div>
                                    </article>
                                    <?php
                                    }
                                    ?>
                                </section>
                            </div>
                            <?php
                            }
                            if( count($spotlight) > 0 ){
                                $currentSpotlight = $spotlight[0];
                            ?>
                            <div class="<?php echo $rightColClass; ?>">

                                <!-- Spotlight -->
                                <section class="box spotlight">
                                    <h2 class="icon fa-file-text-o">Spotlight</h2>
                                    <article>
                                        <a href="/?p=<?php echo $currentSpotlight->ID; ?>" class="image featured"><?php echo get_the_post_thumbnail( $currentNews->ID, 'footer-spotlight-feature', $attr ); ?></a>
                                        <header>
                                            <h3><a href="/?p=<?php echo $currentSpotlight->ID; ?>"><?php echo $currentSpotlight->post_title; ?></a></h3>
                                            <?php
                                            //<p>The pros and cons. Mostly cons.</p>
                                            ?>
                                        </header>
                                        <p><?php echo j2dk_format_string($currentSpotlight->post_content, false, true, 200); ?></p>                                        
                                        <footer>
                                            <a href="/?p=<?php echo $currentSpotlight->ID; ?>" class="button alt icon fa-file-o">Continue Reading</a>
                                        </footer>
                                    </article>
                                </section>

                            </div>
                            <?php
                            }
                            ?>
                            
                        </div>
                    </div>                                            
                                        </div>                                    

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
get_footer();
?>