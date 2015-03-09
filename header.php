<!doctype html>
<html <?php language_attributes(); ?>>
<head>

    <meta charset="<?php bloginfo('charset'); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title><?php wp_title('|', true, 'right'); ?></title>

    <meta id="vp" name="viewport" content="width=device-width,initial-scale=1.0,min-scale=1.0">
    <script>
    if (screen.width >= 768) {
        var mvp = document.getElementById('vp');
        mvp.setAttribute('content','width=1000');
    }
    </script>

    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">

    <script>(function(w,d,u){w.readyQ=[];w.bindReadyQ=[];function p(x,y){if(x=="ready"){w.bindReadyQ.push(y);}else{w.readyQ.push(x);}};var a={ready:p,bind:p};w.$=w.jQuery=function(f){if(f===d||f===u){return a}else{p(f)}}})(window,document)</script>

    <?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
    <header class="head">
        <div class="wrap cf">
            <h1>
                <a class="site-title org" title="<?php bloginfo('name') ?>" href="<?php echo site_url() ?>/">
                    <img class="logo-image" src="<?php echo get_template_directory_uri(); ?>/images/logo.svg" alt="<?php bloginfo('name'); ?>" />
                </a>
            </h1>
            <a href="#" class="menu-activator">
            <div>
                Toggle menu
            </div>
            </a>
            <div class="nav-wrapper">

                <nav class="main-nav cf">
                    <?php
                    $args = array(
                        'theme_location'  => 'primary',
                        'container'       => false,
                        'menu_class'      => false,
                        'echo'            => true,
                        'depth'           => 0
                        );
                    wp_nav_menu($args);
                    ?>
                    
                    <div class='mega-menu'>
                    
                    	<div class='column'>
                        
                        	<h4 class='blue'>Indoor <span>3-7yrs</span></h4>
                            
                            <ul>
                            <?php

$args = array(
    'number'     => 1000,
    'orderby'    => 'parent',
    'order'      => 'asc',
    'hide_empty' => false,
	'parent' => 24
);

$parents = array();

$product_categories = get_terms( 'product_cat', $args ); foreach($product_categories as $product_category):?>
                            	<li><a href='<?php bloginfo('home');?>/product-category/<?php echo $product_category->slug;?>'><?php echo $product_category->name;?></a></li>
                                
                                <?php endforeach;?>
                            
                            </ul>
                        
                        </div><!-- END COLUMN -->
                        
                        <div class='column'>
                        
                        	<h4 class='red'>Indoor Enhancements <span>3-7yrs</span></h4>
                            
                            <ul>
                            
                            	 <?php

$args = array(
    'number'     => 1000,
    'orderby'    => 'parent',
    'order'      => 'asc',
    'hide_empty' => false,
	'parent' => 29
);

$parents = array();

$product_categories = get_terms( 'product_cat', $args ); foreach($product_categories as $product_category):?>
                            	<li><a href='<?php bloginfo('home');?>/product-category/<?php echo $product_category->slug;?>'><?php echo $product_category->name;?></a></li>
                                
                                <?php endforeach;?>
                            
                            </ul>
                        
                        </div><!-- END COLUMN -->
                        
                        <div class='column'>
                        
                        	<h4 class='green'>Outdoor <span>3-7yrs</span></h4>
                            
                            <ul>
                            
                            	 <?php

$args = array(
    'number'     => 1000,
    'orderby'    => 'parent',
    'order'      => 'asc',
    'hide_empty' => false,
	'parent' => 34
);

$parents = array();

$product_categories = get_terms( 'product_cat', $args ); foreach($product_categories as $product_category):?>
                            	<li><a href='<?php bloginfo('home');?>/product-category/<?php echo $product_category->slug;?>'><?php echo $product_category->name;?></a></li>
                                
                                <?php endforeach;?>
                            
                            </ul>
                        
                        </div><!-- END COLUMN -->
                        
                        <div class='column'>
                        
                        	<h4 class='grey'>Under 3's</h4>
                            
                            <ul>
                            
                            	 <?php

$args = array(
    'number'     => 1000,
    'orderby'    => 'parent',
    'order'      => 'asc',
    'hide_empty' => false,
	'parent' => 39
);

$parents = array();

$product_categories = get_terms( 'product_cat', $args ); foreach($product_categories as $product_category):?>
                            	<li><a href='<?php bloginfo('home');?>/product-category/<?php echo $product_category->slug;?>'><?php echo $product_category->name;?></a></li>
                                
                                <?php endforeach;?>
                            
                            </ul>
                        
                        </div><!-- END COLUMN -->
                        
                        <div class='c'></div>
                    
                    
                    </div><!-- END MEGA MENU -->
                </nav>

                <nav class="head-nav cf">
                    <?php
                    $args = array(
                        'theme_location'  => 'header',
                        'container'       => false,
                        'menu_class'      => false,
                        'echo'            => true,
                        'depth'           => 0
                        );
                    wp_nav_menu($args);
                    ?>
                    <ul>
                        <?php if(is_user_logged_in()):?>
                        <li><a class="btn" href="<?php echo site_url('/my-account/'); ?>">My Account</a></li>
                        <li><a class='btn' href='<?php echo wp_logout_url( get_bloginfo('home') ); ?> '>Log Out</a></li>
                        <?php endif;?>
                        <?php if(!is_user_logged_in()):?>
                        <li><a class="btn" href="<?php echo wp_registration_url(); ?>">Register</a></li>
                        <li><a class='btn' href='<?php bloginfo('home');?>/login'>Log In</a></li>
                        <?php endif;?>
                    </ul>
                    <ul>
                        <li><a class="btn" href="<?php bloginfo('home');?>/cart">Basket (<?php global $woocommerce; echo sprintf(_n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'woothemes'), $woocommerce->cart->cart_contents_count);?>)</a></li>
                        <li><a class="btn" href="<?php bloginfo('home');?>/checkout">Checkout</a></li>
                    </ul>

                    <?php get_search_form(true); ?>
                </nav>

            </div>
        </div>

    </header>
    <div class="main">
        <div class="wrap cf">