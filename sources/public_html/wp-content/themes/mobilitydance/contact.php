<?php
/*
  Template Name: Contact Page
 */


$currentPage = get_queried_object();

$pageID = $currentPage->ID;

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

                                    <article>
                                        <header class="major">
                                            <h2><?php echo $currentPage->post_title; ?></h2>
                                            <?php
                                            //<p>Sidebars are not welcome here</p>
                                            ?>
                                        </header>
                                        <div id="page-featured-image">
                                            <span class="image featured">
                                                <?php echo get_the_post_thumbnail( $pageID, 'full', $attr ); ?>
                                            </span>
                                        </div>
                                        <div id="page-content">
                                            <div style="width: 40%; float: left;">
                                            <?php echo do_shortcode('[contact-form-7 id="77" title="Contact form 1"]'); ?>  
                                            </div>
                                            <div style="width: 50%; float: right; margin: 0 0 0 10px;">
                                                <?php echo $currentPage->post_content; ?>
                                            </div>
                                        </div>
                                    </article>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $j2dk_custom_theme_options = get_option('j2dk_custom_theme_options');
            
            
            $args = array(
                'posts_per_page'   => 3,                
                'category'         => '4',
                'exclude' => array($pageID));
            $news = get_posts( $args );

            $args = array(
                'posts_per_page'   => 1,                
                'category'         => '3',
                'exclude' => array($pageID));
            $spotlight = get_posts( $args );
            
            if( count($news) > 0 || count($spotlight) > 0 ){
                if( count($news) > 0 && count($spotlight) > 0 ){
                    $leftColClass = '8u';
                    $rightColClass = '4u';
                }
                else if( count($news) > 0 && count($spotlight) == 0 ){
                    $leftColClass = '12u';
                    $rightColClass = '';
                }
                else if( count($news) == 0 && count($spotlight) > 0 ){
                    $leftColClass = '';
                    $rightColClass = '12u';
                }
            ?>
            <div class="wrapper style3">
                <div class="inner">
                    <div class="container">                        
                        <div class="row">   
                            <?php
                            if( count($news) > 0 ){
                            ?>                            
                            <div class="<?php echo $leftColClass; ?>">

                                <!-- Article list -->
                                <section class="box article-list">
                                    <h2 class="icon fa-file-text-o">Recent Posts</h2>
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
            <?php
            }
            ?>
        </div>            
<?php
get_footer();
?>