<?php 
/*
Template Name: Full Width Template
*/
get_header(); ?>
			
			<div id="content" class="clearfix">
			
				<div id="main" class="clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
						
						<header>
							
							<h1><?php the_title(); ?></h1>
							
							<p class="meta linebrk"><?php _e("Posted", 'frantic'); ?> <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time('F jS, Y'); ?></time> <?php _e("by", 'frantic'); ?> <?php the_author_posts_link(); ?>.</p>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix">
							<?php the_content(); ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'frantic' ) . '</span>', 'after' => '</div>' ) ); ?>
					
						</section> <!-- end article section -->
						
						<footer>
			
							<p class="tags"><?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>		
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1><?php _e('Not Found', 'frantic'); ?></h1>
					    </header>
					    <section class="post_content">
					    	<p><?php _e('Sorry, but the requested resource was not found on this site.', 'frantic'); ?></p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
			</div> <!-- end #content -->

<?php get_footer(); ?>