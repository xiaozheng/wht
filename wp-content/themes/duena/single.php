<?php
/**
 * The Template for displaying all single posts.
 *
 * @package duena
 */

get_header(); ?>
	<?php if (!is_user_logged_in()) {?>
<script type="text/javascript">

window.location.href="<?php echo esc_url( home_url( '/' ) ); ?>";

</script>

<?php }?>

<style>
 #wraper ul li.active {
background: #333333;
color:white;
}
#wraper ul li a {
color: rgb(51, 51, 51);
font-family: 'Lucida Sans','Tahoma';
text-transform: uppercase;
font-weight: bold;
}
#wraper ul li {
width: auto !important;
float: left;
vertical-align: middle;
text-align: center;
padding-top:10px;
line-height: 40px;
padding-bottom:0px;
}
#wraper ul{
padding:0px;
}

.site-footer{
bottom:26px;
}
.my_post_create{
height:40px;
font-size:30px;
}
select, textarea, input[type="text"], input[type="password"], input[type="datetime"], input[type="datetime-local"], input[type="date"], input[type="month"], input[type="time"], input[type="week"], input[type="number"], input[type="email"], input[type="url"], input[type="search"], input[type="tel"], input[type="color"], .uneditable-input {
height:30px;
}
</style>
	<div id="primary" class="span8 <?php echo esc_attr( of_get_option('blog_sidebar_pos') ) ?>">
	
		<div id="content" class="site-content" role="main">
			<?php if (current_user_can('edit_post',$main_post->ID)){?>
<div id="wraper" class="postbyuser" style="background:white;color:Black;border-bottom:solid 2px #333333">
        
<ul>
<li class="my_post_create"><a href="<?php echo esc_url( home_url( '/' ) ); ?>create-post/">My posts</a></li><!-- create-post/?task=new!>
<li class="my_post_create" style="float:left"><a href="<?php echo esc_url( home_url( '/' ) ); ?>adding_new_post" >

Add new post</a></li>
</ul>
</div>

<?php }?>
		<?php while (have_posts()) : the_post(); 			

				// The following determines what the post format is and shows the correct file accordingly
				$format = get_post_format();
				get_template_part( 'post-formats/'.$format );					
				if($format == '')
				get_template_part( 'post-formats/standard' );
				//get_template_part( 'post-formats/post-nav' );
				//get_template_part( 'post-formats/related-posts' );			
				//comments_template('', true);
			endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
