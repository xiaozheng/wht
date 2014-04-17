<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package duena
 */

get_header(); ?>
<?php if (is_user_logged_in()) {
 if (is_page(array(TimeLine,gallery))) {?>
	<div id="primary"><!--  class="span8 <?php echo esc_attr( of_get_option('blog_sidebar_pos') ) ?>" style="width:100%"-->
<?php }else{?>
<div id="primary" class="span8 <?php echo esc_attr( of_get_option('blog_sidebar_pos') ) ?>" >
<?php }?>
		<div id="content" class="site-content" role="main">
			
			<?php if (is_page(array(about, home, wall,gallery)))
				{
					if(is_page("wall"))
				{
				 if (is_user_logged_in()) 
				if (function_exists('WPWall_Widget')) 
					WPWall_Widget(); 
		
					}else if(is_page("about")){
					 while ( have_posts() ) : the_post(); ?>
					<div class="about_info">
						
						<?php the_content(); ?>		
					</div>
					

				<?php endwhile; // end of the loop. 			
					}else if(is_page("gallery")){
					include('Gallery.php');
				 

 					}else {
					}
				
					}else if (is_page('TimeLine'))
					{
					
					include('TimeLine.php');
				}
				else{?>
				<?php while ( have_posts() ) : the_post(); ?>
					<div class="page_wrap">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php the_content(); ?>		
					</div>
					<?php
						//If comments are open or we have at least one comment, load up the comment template
						//if ( comments_open() || '0' != get_comments_number() )
							//comments_template();
					?>

				<?php endwhile; // end of the loop. ?>
		</div><!-- #content -->
	</div><!-- #primary -->
<?php }?>
<?php } else{?>
<script type="text/javascript">
window.location.href="<?php echo esc_url( home_url( '/' ) ); ?>";
</script>
<?php }?>

<?php get_footer(); ?>

