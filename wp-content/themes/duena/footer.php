<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package duena
 */
?>
</div>
</div>
</div>		


      <div id="lost_password" class="modal disply_effect">
           <span >Get new password on your registered email-id</span><button class='close_button' id="forgot_password_close">x</button><br/><br/>
	    <div id="lostPassw_error" ></div>
           <form name="lostpasswordform" id="lostpasswordform" action="<?php echo home_url()?>/wp-login.php?action=lostpassword" method="post">
              <input type="text" name="user_login" id="lost_user_login" class="input" value="" size="20" placeholder="username or email-id">

              <input type="hidden" name="redirect_to" value="<?php echo home_url();?>">
		<br/>
              <input type="submit" name="wp-submit" id="wp-submit" value="Get New Password">
          </form>
          
    </div>


	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
		
			<div class="site-info">
				<div class="footer-text">
					<?php 
					$jqfooter_text = esc_attr(of_get_option('footer_text'));
					if ('' != $jqfooter_text) {
						echo stripslashes(htmlspecialchars_decode($jqfooter_text));
					} else { ?>
						<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'duena' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'duena' ), 'WordPress' ); ?></a>
					<?php } ?>
				</div>
				<?php if ('true' == of_get_option('footer_menu')) {
					wp_nav_menu( array( 
						'container'       => 'ul', 
		                'menu_class'      => 'footer-menu', 
		                'menu_id'         => 'footer-nav',
		                'depth'           => 0,
		                'theme_location' => 'footer' 
					) ); 
				}
				?>
				<div class="clear"></div>
				<div id="toTop"><i class="icon-chevron-up"></i></div>
			</div>
		</div>
<div id="3ddata"></div>
	</footer>

<!-- .page-wrapper -->
<div id="contact_form" class="contact_form popup_gradient">
<div class="inside_div">
	<h2><strong style="font-family: helvetica;">Contact</strong></h2>
</div><div style="padding-top: 10px;"><div style="text-align:center"><span id="contact_error"></span></div>
<form action="#" name="gcf" id="gcf">
		  <div class="gcf_title"> <span id="gcf_alertmessage"></span> </div>
		  <!--<div class="gcf_title"> Your name </div>-->
		  <div class="gcf_title gcf_title1">
			<input name="gcf_name" class="gcftextbox" type="text" id="gcf_name" maxlength="120" placeholder="Your name">
		  </div>
		  <!--<div class="gcf_title"> Your email </div>-->
		  <div class="gcf_title gcf_title1">
			<input name="gcf_email" class="gcftextbox" type="text" id="gcf_email" maxlength="120" placeholder='Your email'>
		  </div>
		 <!-- <div class="gcf_title"> Enter your message </div>-->
		  <div class="gcf_title ">
			<textarea name="gcf_message" class="gcftextarea" rows="3" id="gcf_message" placeholder='Enter your message'></textarea>
		  </div>
		 
		  <div class="gcf_title " style="float:right;">
			<input type="button" class="button_a" name="button" value="Submit" onclick="javascript:gcf_submit(this.parentNode,'<?php echo get_option('siteurl'); ?>/wp-content/plugins/simple-contact-form/');">
		  </div>
          <div class="gcf_title"></div>
		</form>
</div>
</div>

<?php wp_footer(); ?>
<script type="text/javascript">

(function ($jq) {
$jq('#topnav a').click(function(e){
		var select_div=$jq(this).attr('href');
		
		if(select_div =="#Logout")
		{
		
		$jq(this).attr('href',$jq('#logout_link a').attr('href'));	
		
		}else{		
		$jq('#Register').hide();	
		$jq('#contact_form').hide();
		$jq('#LoginForm').hide();
		if(select_div ==='#contact_form' &&   e.pageX < 801){
		$jq(select_div).css('left',e.pageX-50);
		}		
		$jq(select_div).slideDown('300');
		
		}
		});
	$jq('<button></button>',{
				'text':'x',
				'class':'close_button'
		}).appendTo('#contact_form h2')
		  .click(function(){
			$jq('#contact_form').slideUp('300');
						
			});
	
        $jq('#user_login').attr('required','required');
	$jq('#user_pass').attr('required','required');
	
	
	$jq('#user_login').attr( 'placeholder', 'Username' );
	$jq('#user_pass').attr( 'placeholder', 'Password' );
	$jq('.login-remember').hide();
	$jq("#menu-item-15").html('<?php wp_loginout( esc_url( home_url( '/' ) )); ?>');//logout
	$jq('<button></button>',{
				'text':'x',
				'class':'close_button'
		}).appendTo('#sign_in h2')
		  .click(function(){
                	$jq('#LoginForm').slideUp('300');				
			});

	$jq('<button></button>',{
				'text':'x',
				'class':'close_button'
		}).appendTo('#sign_up h2')
		  .click(function(){
                	$jq('#Register').slideUp('300');				
			});
	
	
	$jq('#lostpasswordform').submit(function(){
		$lostPassw_error=$jq('#lostPassw_error')
		_e=document.getElementById("lost_user_login");	
		if(_e.value == "" )
		{
		$lostPassw_error.html("Enter EmailId");
		_e.focus();
		return false;
		}
		 if(_e.value !="" && (_e.value.indexOf("@",0)==-1 || _e.value.indexOf(".",0)==-1))
		{
		$lostPassw_error.html("Enter Valid  EmailId");
		_e.focus();
		_e.select();
		return false;
		} 
		
	
	});
	
	if("<?php echo $_REQUEST['login']?>".indexOf("failed") != -1){
			$jq('#LoginForm').show();
			$jq('#login_error').html("Enter correct details");	
			}
	var registration_form=0;
	var $register_error=$jq('#register_error');
	if("<?php echo $_REQUEST['email_exists']?>"=="1")
	{
		$jq('#Register').show();
		$register_error.html("Email exists<br>");
	}
	if("<?php echo $_REQUEST['username_exists']?>"=="1")
	{
		$jq('#Register').show();
		$register_error.html($register_error.html()+"username exists<br>");
	}
	if("<?php echo $_REQUEST['invalid_email']?>"=="1")
	{
		$jq('#Register').show();
		$register_error.html($register_error.html()+"invalid email<br>");
	}
	$jq('#forgot_password_close').click(function(){
		$jq('#lost_password').fadeOut('300');
		});
	//if user made wrong registration and in same time try to login
	var location=window.location.href;
	if(location.split("?").length > 2){
	if(location.indexOf("login=failed") != -1){
	$jq('#LoginForm').show();
	$jq('#login_error').html("Enter correct details");
	}
	}
	})(jQuery);



</script>

</body>
</html>
