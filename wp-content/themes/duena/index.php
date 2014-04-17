<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package duena
 */

get_header(); ?>




<div id="primary" class="span8 <?php echo esc_attr( of_get_option('blog_sidebar_pos') ) ?>" style="height:100%">
		<!--<div id='p1'></div>
		<div id="content" class="site-content" role="main">
		
		</div> #content -->
	</div><!-- #primary -->
      
<!-- get_sidebar()-->
<div class="LoginForm popup_gradient" id="LoginForm">

     <div id="sign_in"><div class="inside_div">
        <h2><strong>Login</strong></h2>
</div><div style="padding-top: 10px; text-align:center"><span id="login_error"></span></div>
        <?php $args = array( 
              'echo'           => true,
              'redirect'       => esc_url( home_url( '/' ) ),
              'form_id'        => 'loginform',
              'label_username' => __( '' ),
              'label_password' => __( '' ),
              /*'label_remember' => __( 'Remember Me' ),*/
              'label_log_in'   => __( 'Sign In' ),
              'id_username'    => 'user_login',
              'id_password'    => 'user_pass',
              /*'id_remember'    => 'rememberme',*/
              'id_submit'      => 'wp-submit',
             /* 'remember'       => true,*/
              'value_username' => NULL,
              /*'value_remember' => true */);

        wp_login_form( $args );?>
<div class="clear"></div>
       <p class="forgot_password_link" style=""><a href="#lost_password"  onclick="return forgot_password();">Forgot your password?</a></p>
	<!--<p>Don't have an account? <a href="#sign_up" >Sign up</a>!</p>-->

</div>
</div>
</div>
</div>

<div class="Register popup_gradient" id="Register">
      <div id="sign_up" ><div class="inside_div">
          <h2><strong>Register</strong></h2>
</div><div style="text-align: center;padding-top: 10px;"><span id=register_error></span>
          <form action="<?php echo site_url('wp-login.php?action=register', 'login_post') ?>" class="user_new" id="user_new" method="post">
		<div class=" gcf_title1">                 
		<input id="user_login" name="user_login"  type="text" placeholder="Select a username" required=required></div>
		<div class=" gcf_title1">      
                 <input id="user_email" name="user_email"  type="text" placeholder="Email address" required=required></div>
		 <div class=" gcf_title1">      <input id="first_name" name="first_name"  type="text" placeholder="First name" required=required></div>
		 <div class=" gcf_title1">      <input id="last_name" name="last_name"  type="text" placeholder="Last name" required=required></div>
                 <?php do_action('register_form'); ?>
		
                <input id="register" type="submit" value="Sign up">
		<div class="clear"></div>
	<p>A password will be E-mailed to you</p><br>
	  <p><input type="checkbox" name="agrrement" required=required id="check_box_pos"  >
	     <span  id="terms_condition" >I agree to terms & conditions</span></p>
</div>
          </form>
          
        <!--  <p>Already a user? <a href="#sign_in" class="fancybox">Sign in</a>!</p>-->
      </div>

</div>


<div class="terms_condition" id="terms_condition_content">
<span id="terms_condition_close">x</span>
<div class="clear"></div>
<div class="terms_condition_content">
	<?php 
$my_postid=terms_condition_post_id;/*its in config file*/
$content_post = get_post($my_postid);
$content = $content_post->post_content;
$content = apply_filters('the_content', $content);
$content = str_replace(']]>', ']]&gt;', $content);

?><?php echo $content;?>
</div>
</div>

<script type="text/javascript">

function forgot_password()
{
jQuery('#LoginForm').fadeOut('300');
jQuery('#lost_password').fadeIn('300');

}
jQuery("#terms_condition").click(function(){
jQuery('#terms_condition_content').fadeToggle( "slow", "linear" );

})
jQuery('#terms_condition_close').click(function(){

jQuery('#terms_condition_content').hide();
});

</script>
<?php get_footer(); ?>
