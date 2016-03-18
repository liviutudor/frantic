			</div>
        
            <footer role="contentinfo">
			
				<div id="inner-footer" class="clearfix">
			
					<?php echo __('&copy; ', 'frantic') . esc_attr( get_bloginfo( 'name', 'display' ) );  ?>
					<?php if ( is_front_page() && ! is_paged() ) : ?>
                    <?php _e('- Powered by ', 'frantic'); ?><a href="<?php echo esc_url( __( 'http://wordpress.org/', 'frantic' ) ); ?>" title="<?php esc_attr_e( 'Semantic Personal Publishing Platform', 'frantic' ); ?>"><?php _e('Wordpress' ,'frantic'); ?></a>
                    <?php _e(' and ', 'frantic'); ?><a href="<?php echo esc_url( __( 'http://wpthemes.co.nz/', 'frantic' ) ); ?>"><?php _e('WPThemes.co.nz', 'frantic'); ?></a>
                    <?php endif; ?>
				
				</div> <!-- end #inner-footer -->
				
			</footer> <!-- end footer -->
		
		</div> <!-- end #container -->

		
		<?php wp_footer(); // js scripts are inserted using this function ?>
		
		<!-- Insert Analytics -->
		
		<!-- End Analytics -->

	</body>

</html>