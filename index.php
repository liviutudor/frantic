<?php get_header(); ?>
			
			<div id="content" class="clearfix">
			
				<div id="main" class="col620 clearfix" role="main">

					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
						
						<?php if ( has_post_format( 'gallery' ) ) : ?>
							<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
							if ( $images ) :
								$image = array_shift( $images );
								$image_img_tag = wp_get_attachment_image( $image->ID, array(150, 125) );
						?>
							<div class="imgthumb">
							<a href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a>
							</div><!-- .gallery-thumb -->
                            <?php endif; ?>
 
                            <?php elseif ( has_post_thumbnail()) : ?>
                            
                            <div class="imgthumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_post_thumbnail( array(150, 125) ); ?></a></div>
                            
                            <?php else : ?>
                            
                            <?php $postimgs =& get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC' ) );
							if ( !empty($postimgs) ) :
								$firstimg = array_shift( $postimgs );
								$my_image = wp_get_attachment_image( $firstimg->ID, array(150, 125) );
							?>
                            
                            <div class="imgthumb"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php echo $my_image; ?></a></div>
                        
                        	<?php endif; ?>
                         <?php endif; ?>
                            

						<header>
                        
							<?php if ( has_post_format( 'aside' ) || has_post_format( 'gallery' ) || has_post_format( 'video' ) || has_post_format( 'link' ) ) : ?>
                            <h5 class="format-heading"><?php _e(get_post_format(), 'frantic'); ?></h5>
                            <?php elseif ( is_sticky() ) : ?>
                            <h5 class="format-heading"><?php _e('featured', 'frantic'); ?></h5>
                            <?php endif; ?>
                            
							<h1 class="h2"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
							
							<p class="meta"><?php _e("Posted", 'frantic'); ?> <a href="<?php the_permalink() ?>" rel="bookmark"><time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php printf(__(get_the_date('F jS, Y'), 'frantic')); ?></time></a> <?php _e("by", 'frantic'); ?> <?php the_author_posts_link(); ?> <span class="amp">&amp;</span> <?php _e("filed under", 'frantic'); ?> <?php the_category(', '); ?>.</p>
						
						</header> <!-- end article header -->
					
						<section class="post_content clearfix">
                        
                        
                        
						<?php if ( has_post_format( 'gallery' ) ) : ?>
							<?php $images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
							if ( $images ) :
								$total_images = count( $images );
								$image = array_shift( $images );
								$image_img_tag = wp_get_attachment_image( $image->ID, array(150, 125) );
						?>
								
						<p><em><?php printf( _n( 'This gallery contains <a %1$s>%2$s photo</a>.', 'This gallery contains <a %1$s>%2$s photos</a>.', $total_images, 'frantic' ),
								'href="' . esc_url( get_permalink() ) . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'frantic' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								number_format_i18n( $total_images )
							); ?></em></p><?php endif; ?>

                            
                            
                            <?php else : ?>
                            
                           		<?php the_excerpt(); ?>
                                <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'frantic' ) . '</span>', 'after' => '</div>' ) ); ?>
                                <div class="read-more"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php _e('Read More', 'frantic'); ?></a></div>
                            
                            <?php endif; ?>
                            
						</section> <!-- end article section -->

					
					</article> <!-- end article -->
					
					<?php comments_template(); ?>
					
					<?php endwhile; ?>	
					
					<?php if (function_exists('page_navi')) { // if expirimental feature is active ?>
						
						<?php page_navi(); // use the page navi function ?>
						
					<?php } else { // if it is disabled, display regular wp prev & next links ?>
						<nav class="wp-prev-next">
							<ul class="clearfix">
								<li class="prev-link"><?php next_posts_link(__('&larr; Older Entries', 'frantic')) ?></li>
								<li class="next-link"><?php previous_posts_link(__('Newer Entries &rarr;', 'frantic')) ?></li>
							</ul>
						</nav>
					<?php } ?>		
					
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