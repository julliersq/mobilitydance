<?php
$currentPage = get_queried_object();
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title><?php echo get_bloginfo( 'name' ); ?> | <?php echo $currentPage->post_title;?></title>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <!--[if lte IE 8]><script src="<?php echo get_template_directory_uri(); ?>/css/ie/html5shiv.js"></script><![endif]-->
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/jquery.dropotron.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/skel.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/skel-layers.min.js"></script>
        <script src="<?php echo get_template_directory_uri(); ?>/js/init.js"></script>
        <noscript>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/skel.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style.css" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/style-desktop.css" />
        </noscript>
        <!--[if lte IE 8]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie/v8.css" /><![endif]-->
        <!--[if lte IE 9]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/ie/v9.css" /><![endif]-->
        <script type="text/javascript">
            $(function(){
                $('img').removeAttr('width');
                $('img').removeAttr('height');
            });
        </script>
        <?php
        $mobile = mobile_device_detect();
        if (is_array($mobile)) {
        ?>
        <style>
            #page-featured-image img{
                max-height: 450px;
                width: 100%;
            }            
        </style>
        <?php
        }
        wp_head();
        ?>        
    </head>
    <body class="no-sidebar">

        <!-- Header Wrapper -->
        <div id="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="12u">

                        <!-- Header -->
                        <header id="header">
                            
                            <div class="inner">
                                <?php                                
                                if (is_array($mobile)) {
                                ?>
                                <!-- Logo -->
                                <h1><a href="index.html" id="logo">Mobility Dance</a></h1>
                                <?php
                                }    
                                else{
                                ?>
                                <!-- Logo -->
                                <a href="index.html" id="logo"><img src="/wp-content/uploads/2014/08/mobility-logo.png"></a>                                
                                <?php
                                }
                                ?>


                                <!-- Nav -->
                                <nav id="nav">
                                <?php wp_nav_menu( array( 'theme_location' => 'header-menu' , 'container' => false ) ); ?>
                                </nav>

                            </div>
                        </header>

                    </div>
                </div>
            </div>
        </div>
