<!-- WP Wall -->
<?php 	
	echo $before_widget; 
	echo $before_title . $wall_title. $after_title;
?>


<div id="wp_wall">
		
	<div id="wallcomments">
			<?php echo WPWall_ShowComments(); ?>
	</div> 
	<!--  it will show navigation-->
	<div class="wallnav" align="center">
					<img alt="Previous" title="Previous" id="img_left" src="<?php echo $wp_wall_plugin_url; ?>/i/left.png" />
					<img alt="Next" title="Next" id="img_right" src="<?php echo $wp_wall_plugin_url; ?>/i/right.png" />
					<?php if ( $show_all ) : ?>
					<a  href="<?php echo get_permalink($pageId) ?>">All</a>
					<?php endif; ?>
  		</div> 
	
	<?php if (  $rss_feed ) : ?>
	
		<p><a href="<?php echo get_post_comments_feed_link($pageId); ?>" id="wall_rss"><img src="<?php echo $wp_wall_plugin_url; ?>/i/feed.png" /> <?php echo $wall_title; ?> RSS Feed</a></p>			
	
	<?php endif; ?>
	
	<?php if ( ! $disable_new ) : ?>
		<?php if (  $only_registered && !$user_ID) : ?>
		
			<p><a href="wp-login.php">Log in to post a comment.</a></p>	
					
		
		<?php else : ?>
		
			<p><a id="wall_post_toggle"> &raquo; <?php echo $wall_reply; ?></a></p>	
		
		<?php endif; ?>
	<?php endif; ?>
	
	

	<div id="wall_post">
		<form action="<?php echo $wp_wall_plugin_url.'/wp-wall-ajax.php'; ?>" method="post" id="wallform">
		
			<?php if ( $user_ID ) : ?>
			
			<p>Logged in as <a href="<?php echo get_bloginfo('wpurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>.</p>
			
			<?php else : ?>
			
			<p>
			<label for="wpwall_author"><small>Name</small></label><br/>
			<input type="text" name="wpwall_author" id="wpwall_author" value=""  tabindex="11"  />
			</p>
			
			<?php if ( $show_email ) : ?>
			<p>
			<label for="wpwall_email"><small>Email</small></label><br/>
			<input type="text" name="wpwall_email" id="wpwall_email" value=""  tabindex="12"  />
			</p>
			<?php endif; ?>
			
			<?php endif; ?>
			
			<p>
			<label for="wpwall_comment"><small>Comment</small></label><!--<br/>-->
			<input type="text" id="wpwall_heading" name="commentwpheading" class="wpwall_heading" placeholder="Wall heading"><br/>
			<textarea name="wpwall_comment" id="wpwall_comment" rows="3" cols="" tabindex="13" ></textarea>
			</p>
					
			<p><input name="submit_wall_post" type="submit" id="submit_wall_post" tabindex="14" value="Submit" /></p>
			
		</form> 								
	</div>
	
	<div id="wallresponse"></div>
	
</div>
<br />
<?php

	echo $after_widget; 
	

?>
