				<div id="sidebar1" class="sidebar col300" role="complementary">
				
					

					<?php if ( is_active_sidebar( 'sidebar1' ) ) : ?>

						<?php dynamic_sidebar( 'sidebar1' ); ?>

					<?php else : ?>

						<!-- This content shows up if there are no widgets defined in the backend. -->
						
					<div id="archives" class="widget">
                        <h4 class="widgettitle"><?php _e( 'Archives', 'frantic' ); ?></h4>		

                        <ul>
                            <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
                        </ul>
                    </div>

					<?php endif; ?>

				</div>