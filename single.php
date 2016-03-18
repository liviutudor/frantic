<?php get_header(); ?>
			
			<div id="content" class="clearfix">
			
				<div id="main" class="col620 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
						
						<header>
							
							<h1><?php the_title(); ?></h1>
							
							<p class="meta linebrk"><?php _e("Posted", 'frantic'); ?> <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php the_time('F jS, Y'); ?></time> <?php _e("by", 'frantic'); ?> <?php the_author_posts_link(); ?> <span class="amp">&</span> <?php _e("filed under", 'frantic'); ?> <?php the_category(', '); ?>.</p>
                            
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix">
							<?php the_content(); ?>
                            <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'frantic' ) . '</span>', 'after' => '</div>' ) ); ?>
							
					
						</section> <!-- end article section -->
						
						<footer>
			
							<p class="tags"><?php the_tags('<span class="tags-title">Tags:</span> ', ', ', ''); ?></p>

							
						</footer> <!-- end article footer -->
                        
                             <nav class="wp-prev-next">
                                <ul class="clearfix">
                                    <li class="prev-link"><?php previous_post_link('&laquo; %link', 'Previous Post'); ?></li>
                                    <li class="next-link"><?php next_post_link('%link &raquo;', 'Next Post'); ?></li>
                                </ul>
                            </nav>
					
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
    
				<?php get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>