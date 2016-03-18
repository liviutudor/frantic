<?php if ( post_password_required() ) { ?>
  	<div class="help">
    	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'frantic'); ?></p>
  	</div>
  <?php
    return;
  }
?>

<!-- You can start editing here. -->

<?php if ( have_comments() ) : ?>
	
	<h3 id="comments" class="h2 linebrk"><?php comments_number('<span>No</span> Responses', '<span>One</span> Response', '<span>%</span> Responses' );?> to &#8220;<?php the_title(); ?>&#8221;</h3>

	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link() ?></li>
	  		<li><?php next_comments_link() ?></li>
	 	</ul>
	</nav>
	
	<ol class="commentlist">
		<?php wp_list_comments('type=comment&callback=frantic_comments'); ?>
	</ol>
	
	<nav id="comment-nav">
		<ul class="clearfix">
	  		<li><?php previous_comments_link() ?></li>
	  		<li><?php next_comments_link() ?></li>
		</ul>
	</nav>


<?php endif; ?>


<?php if ( comments_open() ) : ?>

<section id="respond-form">

	<?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
  	<div class="help">
  		<p><?php _e('You must be logged in to post a comment. ', 'frantic'); ?> <a href="<?php echo wp_login_url( get_permalink() ); ?>"><?php _e('Log in', 'frantic'); ?></a></p>
  	</div>
	<?php else : ?>

	<?php comment_form(); ?> 
	
	<?php endif; // If registration required and not logged in ?>
</section>

<?php endif; // if you delete this the sky will fall on your head ?>
