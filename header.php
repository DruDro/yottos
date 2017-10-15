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
<?php include 'login-form.php'; ?>
<?php include 'signup-form.php'; ?>
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
                        <ul class="dropdown-menu nav-menu">
                            <li class="list-item"><a href="advertisers.html">Для рекламодателей</a></li>
                            <li class="list-item"><a href="webmasters.html">Для вебмастеров</a></li>
                            <li class="list-item"><a href="#">Для интернет-пользователей</a></li>
                            <li class="list-item"><a href="about.html">О YOTTOS</a></li>
                            <li class="list-item"><a href="about.html#join">Хочу стать YO маркетологом</a></li>
                            <li class="list-item"><a href="#">Блог Yottos</a></li>
                            <li class="divider"></li>
                            <li class="dropdown dropdown-submenu language-switcher">
                                    
                                    Language <span class="mdl-button mdl-js-button mdl-js-ripple-effect dropdown-toggle" data-toggle="dropdown">RU <span class="caret"></span></span>
                                    <ul class="dropdown-menu language-list">
                                        <li><a href="javascript:void(0);">RU</a></li>
                                        <li><a href="javascript:void(0);">EN</a></li>
                                    </ul>
                            </li>
                        </ul>
                        <a class="login-link navbar-link mdl-button mdl-js-button mdl-js-ripple-effect popup-link" href="#loginForm">Вход</a>
                    </div>
                </nav>
            </div>
        </header>
        <div class="container">
            <div class="static-header">
                <div class="search"><?php get_search_form();?></div>
                <?php wp_nav_menu( array(
                    'theme_location' => 'top',
                    'menu_id'        => 'top-menu',
                ) ); ?>               
            </div>
        </div>
