<?php

if ( ! function_exists( 'frantic_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
function frantic_setup() {
	/**
	 * Make theme available for translation
	 */
	load_theme_textdomain( 'frantic', get_template_directory() . '/lang' );


	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'frantic' ),
	) );

	add_theme_support('post-thumbnails'); 
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	
	// adding post format support
	add_theme_support( 'post-formats', 
		array( 
			'aside', /* Typically styled without a title. Similar to a Facebook note update */
			'gallery', /* A gallery of images. Post will likely contain a gallery shortcode and will have image attachments */
			'link', /* A link to another site. Themes may wish to use the first <a href=ÓÓ> tag in the post content as the external link for that post. An alternative approach could be if the post consists only of a URL, then that will be the URL and the title (post_title) will be the name attached to the anchor for it */
			'image', /* A single image. The first <img /> tag in the post could be considered the image. Alternatively, if the post consists only of a URL, that will be the image URL and the title of the post (post_title) will be the title attribute for the image */
			'quote', /* A quotation. Probably will contain a blockquote holding the quote content. Alternatively, the quote may be just the content, with the source/author being the title */
			'status', /*A short status update, similar to a Twitter status update */
			'video', /* A single video. The first <video /> tag or object/embed in the post content could be considered the video. Alternatively, if the post consists only of a URL, that will be the video URL. May also contain the video as an attachment to the post, if video support is enabled on the blog (like via a plugin) */
			'audio', /* An audio file. Could be used for Podcasting */
			'chat' /* A chat transcript */
		)
	);
}
endif;

add_action( 'after_setup_theme', 'frantic_setup' );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
function frantic_content_width() {
	global $content_width;
	if (!isset($content_width))
		$content_width = 630; /* pixels */
}
add_action( 'after_setup_theme', 'frantic_content_width' );

/**
 * Title filter 
 */
function frantic_filter_wp_title( $old_title, $sep, $sep_location ) {

	$site_name = get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description' );
	// add padding to the sep
	$ssep = ' ' . $sep . ' ';
	
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		return $site_name . ' | ' . $site_description;
	} else {
		// find the type of index page this is
		if( is_category() ) $insert = $ssep . __( 'Category', 'frantic' );
		elseif( is_tag() ) $insert = $ssep . __( 'Tag', 'frantic' );
		elseif( is_author() ) $insert = $ssep . __( 'Author', 'frantic' );
		elseif( is_year() || is_month() || is_day() ) $insert = $ssep . __( 'Archives', 'frantic' );
		else $insert = NULL;
		 
		// get the page number we're on (index)
		if( get_query_var( 'paged' ) )
		$num = $ssep . __( 'Page ', 'frantic' ) . get_query_var( 'paged' );
		 
		// get the page number we're on (multipage post)
		elseif( get_query_var( 'page' ) )
		$num = $ssep . __( 'Page ', 'frantic' ) . get_query_var( 'page' );
		 
		// else
		else $num = NULL;
		 
		// concoct and return new title
		return $site_name . $insert . $old_title . $num;
		
	}

}

// call our custom wp_title filter, with normal (10) priority, and 3 args
add_filter( 'wp_title', 'frantic_filter_wp_title', 10, 3 );

 
function frantic_main_nav() {
	// display the wp3 menu if available
    wp_nav_menu( 
    	array( 
    		'menu' => '', /* menu name */
    		'theme_location' => 'primary', /* where in the theme it's assigned */
    		'container_class' => 'menu', /* container class */
    		'fallback_cb' => 'frantic_main_nav_fallback' /* menu fallback */
    	)
    );
}

function frantic_main_nav_fallback() { wp_page_menu( 'show_home=Home&menu_class=menu' ); }
	
// Related Posts Function (call using frantic_related_posts(); )
function frantic_related_posts() {
	echo '<ul id="frantic-related-posts">';
        global $post;
        $tags = wp_get_post_tags($post->ID);
        if($tags) {
        	foreach($tags as $tag) { $tag_arr .= $tag->slug . ','; }
            	$args = array(
            	'tag' => $tag_arr,
            	'numberposts' => 5,
            	'post__not_in' => array($post->ID)
           		);
           	$related_posts = get_posts($args);
           		if($related_posts) {
           			foreach ($related_posts as $post) : setup_postdata($post); ?>
           		<li class="related_post"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
         <?php endforeach; } else { ?>
                <li class="no_related_post">No Related Posts Yet!</li>
         <?php   }
	}
	wp_reset_query();
	echo '</ul>';
}

// Sidebars & Widgetizes Areas
function frantic_register_sidebars() {
    register_sidebar(array(
    	'id' => 'sidebar1',
    	'name' => 'Sidebar 1',
    	'description' => 'The first (primary) sidebar.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    
    register_sidebar(array(
    	'id' => 'sidebar_footer_left',
    	'name' => 'Footer left',
    	'description' => 'First column (sidebar) in the footer on the left.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
    	'id' => 'sidebar_footer_middle',
    	'name' => 'Footer middle',
    	'description' => 'Second column (sidebar) in the footer in the middle.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));

    register_sidebar(array(
    	'id' => 'sidebar_footer_right',
    	'name' => 'Footer right',
    	'description' => 'Third column (sidebar) in the footer on the right.',
    	'before_widget' => '<div id="%1$s" class="widget %2$s">',
    	'after_widget' => '</div>',
    	'before_title' => '<h4 class="widgettitle">',
    	'after_title' => '</h4>',
    ));
    /* 
    to add more sidebars or widgetized areas, just copy
    and edit the above sidebar code. In order to call 
    your new sidebar just use the following code:
    
    Just change the name to whatever your new
    sidebar's id is.
    */
}

// adding sidebars to Wordpress
add_action( 'widgets_init', 'frantic_register_sidebars' );
		
// Comment Layout
function frantic_comments($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
    	<header class="comment-author vcard">
				<?php echo get_avatar($comment,$size='46',$default='<path_to_url>' ); ?>
				<?php printf(__('<cite class="fn">%s</cite>', 'frantic'), get_comment_author_link()) ?>
				<time><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(__('%1$s', 'frantic'), get_comment_date(),  get_comment_time()) ?></a></time>
				<?php edit_comment_link(__('(Edit)', 'frantic'),'  ','') ?>
		</header>
		<article id="comment-<?php comment_ID(); ?>">
			

			<?php if ($comment->comment_approved == '0') : ?>
       			<div class="help">
          			<p><?php _e('Your comment is awaiting moderation.', 'frantic') ?></p>
          		</div>
          		
			<?php endif; ?>
			
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>

			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			
		</article>
    <!-- </li> is added by wordpress automatically -->
<?php
}


function frantic_enqueue_comment_reply() {
        if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
                wp_enqueue_script( 'comment-reply' );
        }
 }
add_action( 'wp_enqueue_scripts', 'frantic_enqueue_comment_reply' );


function frantic_rel_tag( $text ) {
	$text = str_replace('rel="category tag"', 'rel="tag"', $text);
	return $text;
}
add_filter( 'the_category', 'frantic_rel_tag' );


function frantic_modernizr_addclass($output) {
    return $output . ' class="no-js"';
}
add_filter('language_attributes', 'frantic_modernizr_addclass');


function frantic_scripts_modernizr() {
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/library/js/modernizr-2.6.1.min.js', false, '2.6.1');
}    
add_action('wp_enqueue_scripts', 'frantic_scripts_modernizr');


function frantic_scripts_custom() {
     wp_enqueue_script( 'frantic_custom_js', get_template_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '1.0.0');
	 wp_enqueue_style('frantic_style', get_stylesheet_uri() );
}    
add_action('wp_enqueue_scripts', 'frantic_scripts_custom');
?>