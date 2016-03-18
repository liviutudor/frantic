<!doctype html>  
<html <?php language_attributes(); ?>>
	
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>" />
        <meta name="viewport" content="width=device-width" />
        <title><?php wp_title('|', true, 'left'); ?></title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		
		<!-- wordpress head functions -->
		<?php wp_head(); ?>
		<!-- end of wordpress head -->
		
		
	</head>
	
	<body <?php body_class(); ?>>
	
		<div id="container">
			
			<header role="banner">
			
				<div id="inner-header" class="clearfix">
				
					<h1 id="logo"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></h1>
					<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
                    <?php get_search_form(); ?>
                    
					<nav role="navigation">
						<?php frantic_main_nav(); // Adjust using Menus in Wordpress Admin ?>
					</nav>
				
				</div> <!-- end #inner-header -->
			
			</header> <!-- end header -->
            
            <div id="content-wrap">
