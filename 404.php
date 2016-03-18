<?php get_header(); ?>
			
    <div id="content" class="clearfix">
    
        <div id="main" class="col620 clearfix" role="main">

			<article id="post-not-found" class="clearfix">
						
                <header>
                    
                    <h1 class="archive-title"><?php _e('Error 404 - Article Not Found', 'frantic'); ?></h1>
                
                </header> <!-- end article header -->
					
				<div class="entry-content post_content">
					<h4><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'framework' ); ?></h4>


					<?php the_widget( 'WP_Widget_Recent_Posts' ); ?>

					<div class="widget">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'framework' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>

					<?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'framework' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$archive_content" );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div>
						
						
			</article> <!-- end article -->
			
        </div> <!-- end #main -->
        
        <?php get_sidebar(); // sidebar 1 ?>

    </div> <!-- end #content -->

<?php get_footer(); ?>