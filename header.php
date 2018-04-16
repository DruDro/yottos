<!doctype html>
<html>
<head>
	<meta http-equiv="Content-type" content="text/html; charset=<?php bloginfo('charset'); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php wp_title('«', true, 'right'); ?> <?php bloginfo('name'); ?></title>
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <div class="page-wrapper">
        <header class="yo-header">
            <div class="container">
                <nav>
                    <a class="navbar-brand" href="<?php echo get_home_url(); ?>">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/yottos-logo.svg" alt="yottos">
                    </a>
                    <span class="breadcrumb">Блог</span>
                    <div class="dropdown navbar-right">
                        <button class="round-button mdl-button mdl-button--fab mdl-js-button mdl-js-ripple-effect dropdown-toggle menu-btn" type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-menu-btn"></span></button>
                        <?php
                            wp_nav_menu( array( 
                                    'theme_location'    => 'top_dropdown', 
                                    'container'         => false,
                                    'menu_class'        =>  'dropdown-menu nav-menu'
                                ) 
                            ); 
                        ?>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">
            <div class="static-header">
                <div class="search"><?php get_search_form();?></div>
                <?php wp_nav_menu( array(
                        'theme_location'    => 'main_nav',
                        'container_id'      => 'top-menu',
                        'container_class'   => 'menu',
                        'menu_id'           => '',
                        'menu_class'        => ''
                    ) 
                ); 
                ?>               
            </div>
        </div>
