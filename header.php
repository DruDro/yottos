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
<div class="subscription">
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" id="subscriptionDrop"><i class="material-icons">mail</i><span class="subscr-text">Подписаться</span></button>
    <form action="" id="subscriptionForm">			
								<h3 class="text-center">Подписаться на рассылку</h3>	
        <div class="input-field">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label for="name" class="mdl-textfield__label">Ваше имя</label>
                <input type="text" class="mdl-textfield__input" name="name">
            </div>
        </div>
        <div class="input-field">
            <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                <label for="email" class="mdl-textfield__label">Ваш email</label>
                <input type="text" class="mdl-textfield__input" name="email">
            </div>
        </div>
        <div class="form-action">
            <input type="reset" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--default" value="Я уже">
            <input type="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" value="Отправить">
        </div>
    </form>
    			
    <div id="thanksSubscription" class="popup">									
								<h3 class="text-center">Спасибо, что подписались</h3>									
								<p class="text-center"><i class="material-icons" style="font-size: 48px; color:#3a5edc">&#xE86C;</i></p>
								<p>Lorem Ipsum - это текст-"рыба", часто используемый в печати и вэб-дизайне. Lorem Ipsum является стандартной "рыбой" для текстов на латинице с начала XVI века. </p>
								<div class="actions-block">
									<a href="#" id="closeSubscription" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect">Закрыть</a>
								</div>
							</div>
</div>
    <div class="page-wrapper">
        <header class="yo-header">
            <div class="container">
                <nav>
                    <a class="navbar-brand" href="http://yottos.com">
                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/yottos-logo.svg" alt="yottos">
                    </a>
                    <a href="<?php echo get_home_url(); ?>" class="breadcrumb">Блог</a>
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
                        'container_id'      => 'topMenu',
                        'container_class'   => 'menu',
                        'menu_id'           => '',
                        'menu_class'        => 'menu-list'
                    ) 
                ); 
                ?>               
            </div>
        </div>
