<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package duena
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>

<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<meta content="utf-8" http-equiv="encoding" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="format-detection" content="telephone=no" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if( '' != of_get_option('favicon') ){ ?>
<link rel="icon" href="<?php echo esc_url( of_get_option('favicon', "" ) ); ?>" type="image/x-icon" />
<?php } ?>
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/reset.css" type="text/css">




<!-- UNCOMMENT FOR CHECKBOX-STYLE LEGEND ITEMS 
<link rel="stylesheet" href="css/tg_legend_checkboxes.css" type="text/css" media="screen" charset="utf-8">
-->

<!-- <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/timegrid/timeglider/timeglider.datepicker.css" type="text/css" media="screen" charset="utf-8">-->


<style type='text/css'>
.inside_div
{
    width:220px;
     border-radius: 0 0 200px 200px;
     -moz-border-radius: 0 0 200px 200px;
     -webkit-border-radius: 0 0 200px 200px;
     background:#363434;
  
}
.popup_gradient {  

    background: #000000; /* Old browsers */
    background: -moz-linear-gradient(top, #363434 0%, #363434 3%, #000000 3%, #000000 100%); /* FF3.6+ */
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#363434), color-stop(3%,#363434), color-stop(3%,#000000), color-stop(100%,#000000)); /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #363434 0%,#363434 3%,#000000 3%,#000000 100%); /* Chrome10+,Safari5.1+ */
    background: -o-linear-gradient(top, #363434 0%,#363434 3%,#000000 3%,#000000 100%); /* Opera11.10+ */
    background: -ms-linear-gradient(top, #363434 0%,#363434 3%,#000000 3%,#000000 100%); /* IE10+ */
    background: linear-gradient(top,#363434 0%,#363434 3%,#000000 3%,#000000 100%); /* W3C */
}
		body {
			font-family:"franklin-gothic-urw-cond", Helvetica, Arial, sans-serif;
		}
		
		.clearfix:after {
			content: ".";
			display: block;
			clear: both;
			visibility: hidden;
			line-height: 0;
			height: 0;
		}
		 
		.clearfix {
			display: inline-block;
		}
		 
		html[xmlns] .clearfix {
			display: block;
		}
		 
		* html .clearfix {
			height: 1%;
		}

		.header {
			margin:32px;
		}
		
		h1 {
			font-size:18px;
			color:#333;
		}
		#p1 {
			margin:32px;
			margin-bottom:0;
			height:400px;
		}
		
		.method {
			padding:8px;
			background-color:#F0F0F0;
			margin:8px 32px;
			border:1px solid #CCC;
			
		}
		
		.method h4 {
			font-family:Monaco, Courier, monospace;
			color:#9b3c01;
			font-size:20px;
			font-weight:normal;
			margin:0 0 8px 0;
			padding:0;
			width:50%;
			float:left;
		}
	
		
		.method ul {
			list-style:none;
			padding:0;
			margin:0;
			clear:both;
			margin-left:64px;
			margin-top:8px;
		}
		
		.method p {
			margin:4px 32px;
			font-size:14px;
			color:#444;
			clear:both;
		}
		
		.method ul li {
			display:inline;
			cursor:pointer;
			font-size:14px;
			margin-right:8px;
			background-color:#70bece;
			padding:2px 6px;
			-webkit-border-radius: 4px;
			-moz-border-radius: 4px;
			border-radius: 4px;
		}
		
		.method ul li:hover {
			background-color:#d78c5c;
		}
		
	
		#map_modal_map2 {
			border:4px solid black;
			height:400px;
			width:400px;
		}
		
				
		
		.timeglider-legend {
			width:180px;
		}
		
		
		*.no-select {
		-moz-user-select: -moz-none;
		-khtml-user-select: none;
		-webkit-user-select: none;
		user-select: none;
		}
		
		
		.timeglider-timeline-event.ongoing .timeglider-event-title {
			color:green;
		}


		pre {
			margin-left:64px;
			background:white;
			color:black;
			padding:8px;
			clear:both;
		}
		
		.bod {
			
		}
		
		.dragger {
			float:right;
			width:40%;
			text-align:right;
			margin-right:8px;
			font-size:18px;
			color:green;
			font-size:12px;
			cursor:pointer;	
		}
		
		.method p.scope-view {
			margin-left:64px;
			color:red;
		
		}
		</style>
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<!--[if (gt IE 9)|!(IE)]>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.mobile.customized.min.js" type="text/javascript"></script>
<![endif]-->
<?php wp_head(); ?>

</head>
<body></body>
<body  <?php body_class(); ?>>
<div style="display:none">
<input type="text" name="Homeurl" id="HomeUrl" value="<?php echo esc_url( home_url( '/' ) ); ?>">
<input type="text" name="Temp_Url" id="Temp_Url" value="<?php echo get_template_directory_uri(); ?>">

</div>
<div class="page-wrapper ">
	<?php do_action( 'before' ); ?>
	<header id="header" role="banner">
		<div class="container clearfix" style="width:100%">
		
			
			<nav id="site-navigation" class="main-nav" role="navigation" >
				<div class="logo">
			<?php if (( of_get_option('logo_type') == 'image_logo') && ( of_get_option('logo_url') != '')) { ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo esc_url( of_get_option('logo_url') ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
			<?php } else { ?>
				<?php if ( is_front_page() || is_home() || is_404() ) { ?>
					<h1 class="text-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php } else { ?>
					<h2 class="text-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
				<?php } ?>
			<?php } ?>
							</div>
			      
				<div class="navbar_inner">
				<?php 
					wp_nav_menu( array( 
				'container'       => 'ul', 
		                'menu_class'      => 'sf-menu', 
		                'menu_id'         => 'topnav',
		                'depth'           => 0,
		                'theme_location' => 'primary' 
					) ); 
				?>
				</div>
			</nav><!-- #site-navigation -->
		</div>

	</header><!-- #masthead -->
	<?php if( (is_front_page()) && (of_get_option('sl_show') != 'no') ) { ?>
	<!--<section id="slider-wrapper">
		<div class="container">
	    	<?php get_template_part( 'slider' ); ?>
		</div>
	</section>#slider--> 
  	<?php } ?>
	<div id="main" class="site-main ">
		<div class="container">
			<!--<?php if ( of_get_option('g_breadcrumbs_id') != 'no') { ?>
				<?php duena_breadcrumb(); ?>
			<?php } ?>-->
		<?php if (is_page('TimeLine') || is_page('gallery')){?>
			<div  class='gallery_f'>
		<?php }else{?>
			<div class="row" style="margin-bottom:36px;">
			<?php }?>
