
		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/java/FWDGrid.js"></script>
		
		<style type="text/css">
			*{
				margin:0px;
				padding:0px;
				font-weight:bold;
			}
			
			#myDiv{
				margin:auto;
			}
			body {
				padding:0px !important;			
			}
		</style>
		
		<!-- Setup the grid (all settings are explained in detail in the documentation files) -->
		<script type="text/javascript">
			FWDUtils.onReady(function(){
				var gallery = new FWDGrid({		
					//main settings
					divHolderId:"myDiv",
					gridPlayListAndSkinId:"playlist",
					displayType:"fluidwidth",
					scrollBarType:"drag",
					autoScale:"yes",
					width:400,
					height:500,
					thumbnailOverlayType:"text",
					showContextMenu:"yes",
					addMargins:"yes",
					addMouseWheelSupport:"yes",
					scrollBarOffset:0,
					backgroundColor:"#111111",
					scrollbarDisabledColor:"#000000",
					fullScreenButtonPosition:"bottomright",
					fullScreenButtonVerticalMargins:100,
					//thumbnails settings
					thumbnailBaseWidth:278,
					thumbnailBaseHeight:188,
					nrOfThumbsToShowOnSet:37,
					horizontalSpaceBetweenThumbnails:4,
					verticalSpaceBetweenThumbnails:4,
					thumbnailBorderSize:4,
					thumbnailBorderRadius:0,
					thumbnailOverlayOpacity:.85,
					thumbnailOverlayColor:"#000000",
					thumbnailBackgroundColor:"#333333",
					thumbnailBorderNormalColor:"#FFFFFF",
					thumbnailBorderSelectedColor:"#FFFFFF",
					//combobox settings
					startAtCategory:1,
					selectLabel:"SELECT CATEGORIES",
					allCategoriesLabel:"All Categories",
					showAllCategories:"no",
					comboBoxPosition:"topleft",
					selctorBackgroundNormalColor:"#FFFFFF",
					selctorBackgroundSelectedColor:"#000000",
					selctorTextNormalColor:"#000000",
					selctorTextSelectedColor:"#FFFFFF",
					buttonBackgroundNormalColor:"#FFFFFF",
					buttonBackgroundSelectedColor:"#000000",
					buttonTextNormalColor:"#000000",
					buttonTextSelectedColor:"#FFFFFF",
					comboBoxShadowColor:"#000000",
					comboBoxHorizontalMargins:12,
					comboBoxVerticalMargins:12,
					comboBoxCornerRadius:3,
					//fullscreen button settings
					showFullScreenButton:"no",
					fullScreenButtonPosition:"topright",
					//ligtbox settings
					addLightBoxKeyboardSupport:"yes",
					showLightBoxNextAndPrevButtons:"yes",
					showLightBoxZoomButton:"yes",
					showLightBoxInfoButton:"yes",
					showLighBoxSlideShowButton:"yes",
					showLightBoxInfoWindowByDefault:"no",
					slideShowAutoPlay:"no",
					lightBoxVideoAutoPlay:"no",
					lighBoxBackgroundColor:"#000000",
					lightBoxInfoWindowBackgroundColor:"#FFFFFF",
					lightBoxItemBorderColor:"#FFFFFF",
					lightBoxItemBackgroundColor:"#222222",
					lightBoxMainBackgroundOpacity:.8,
					lightBoxInfoWindowBackgroundOpacity:.9,
					lightBoxBorderSize:4,
					lightBoxBorderRadius:4,
					lightBoxSlideShowDelay:4,
					
    
				});
			})
	/*jQuery( window ).resize(function() {
	
	var divHight=parseInt(jQuery("body").next().css("height").replace("px",""));
	var windowHight=jQuery(window).height()-73;
	
	if(divHight < windowHight  )
		{
			
			location.reload();	
			document.location.reload(true);				
		}
	});*/jQuery( document ).ready(function()
		 {
		   jQuery('#top_hight').css('height',(jQuery(window).height()-570)/2+'px');
		   jQuery('#fade').css('height','0px');
   		   jQuery('#bottom_hight').css('height',(jQuery(window).height()-570)/2+10+'px');
		  });
		
		
		</script>
		<div id="top_hight" style=""></div>
	
		<!-- div used as a holder for the grid -->
		<div id="myDiv"></div>
		<div id="bottom_hight" style=""></div>
		<!-- grid data -->
		<ul id="playlist" style="display: none;">

			<!-- skin -->
			<ul data-skin="">
				<li data-preloader-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/rotite-30-29.png"></li>
				<li data-show-more-thumbnails-button-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/showMoreThumbsNormalState.png"></li>
				<li data-show-more-thumbnails-button-selectsed-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/showMoreThumbsSelectedState.png"></li>
				<li data-image-icon-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/photoIcon.png"></li>
				<li data-video-icon-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/videoIcon.png"></li>
				<li data-link-icon-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/linkIcon.png"></li>
				<li data-iframe-icon-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/iframeIcon.png"></li>
				<li data-hand-move-icon-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/handnmove.cur"></li>
				<li data-hand-drag-icon-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/handgrab.cur"></li>
				<li data-fullscreen-button-normal-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/fbnn.png"></li>
				<li data-fullscreen-button-normal-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/fbns.png"></li>
				<li data-fullscreen-button-full-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/fbfn.png"></li>
				<li data-fullscreen-button-full-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/fbfs.png"></li>
				<li data-combobox-down-arrow-icon-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/combobox-down-arrow.png"></li>
				<li data-combobox-down-arrow-icon-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/combobox-down-arrow-rollover.png"></li>
				<li data-combobox-up-arrow-icon-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/combobox-up-arrow.png"></li>
				<li data-combobox-up-arrow-icon-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/combobox-up-arrow-rollover.png"></li>
				<li data-scrollbar-track-background-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/scrollbar-track-background.png"></li>
				<li data-scrollbar-handler-background-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/scrollbar-handler-center-background.png"></li>
				<li data-scrollbar-handler-background-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/scrollbar-handler-center-background-rollover.png"></li>
				<li data-scrollbar-handler-left-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/scrollbar-handler-left.png"></li>
				<li data-scrollbar-handler-left-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/scrollbar-handler-left-rollover.png"></li>
				<li data-scrollbar-handler-right-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/scrollbar-handler-right.png"></li>
				<li data-scrollbar-handler-right-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/scrollbar-handler-right-rollover.png"></li>
				<li data-scrollbar-handler-center-icon-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/scrollbar-handler-center-icon.png"></li>
				<li data-scrollbar-handler-center-icon-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/scrollbar-handler-center-icon-rollover.png"></li>
				<li data-lightbox-slideshow-preloader-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/slideShowPreloader.png"></li>
				<li data-lightbox-close-button-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/galleryCloseButtonNormalState.png"></li>
				<li data-lightbox-close-button-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/galleryCloseButtonSelectedState.png"></li>
				<li data-lightbox-next-button-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/nextIconNormalState.png"></li>
				<li data-lightbox-next-button-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/nextIconSelectedState.png"></li>
				<li data-lightbox-prev-button-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/prevIconNormalState.png"></li>
				<li data-lightbox-prev-button-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/prevIconSelectedState.png"></li>
				<li data-lightbox-play-button-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/playButtonNormalState.png"></li>
				<li data-lightbox-play-button-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/playButtonSelectedState.png"></li>
				<li data-lightbox-pause-button-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/pauseButtonNormalState.png"></li>
				<li data-lightbox-pause-button-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/pauseButtonSelectedState.png"></li>
				<li data-lightbox-maximize-button-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/maximizeButtonNormalState.png"></li>
				<li data-lightbox-maximize-button-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/maximizeButtonSelectedState.png"></li>
				<li data-lightbox-minimize-button-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/minimizeButtonNormalState.png"></li>
				<li data-lightbox-minimize-button-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/minimizeButtonSelectedState.png"></li>
				<li data-lightbox-info-button-open-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/infoButtonOpenNormalState.png"></li>
				<li data-lightbox-info-button-open-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/infoButtonOpenSelectedState.png"></li>
				<li data-lightbox-info-button-close-normal-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/infoButtonCloseNormalPath.png"></li>
				<li data-lightbox-info-button-close-selected-path="<?php echo get_template_directory_uri(); ?>/load/skin_minimal_dark_square/infoButtonCloseSelectedPath.png"></li>
			</ul> <ul data-cat="Category one">
			
<?php $www_root = esc_url( home_url( '/' ) ).wp_gallery_portfolio;
echo $www_root ;
    $dir = ABSPATH.wp_gallery_portfolio;
    $file_display = array('jpg', 'jpeg', 'png', 'gif');

    if ( file_exists( $dir ) == false ) {
       echo 'Directory \'', $dir, '\' not found!';
    } else {
       $dir_contents = scandir( $dir );
	$find = array("-","_");
        foreach ( $dir_contents as $file ) {
 $file_type = strtolower( end( explode('.', $file ) ) );
           if ( ($file !== '.') && ($file !== '..') && (in_array( $file_type, $file_display)) ) {
             $image_root=$www_root.'/'.$file;
	     $image_option=getimagesize($image_root);

 

          ?>

<ul>
					<li data-type="media" data-url="<?php echo  $image_root ;?>" data-target="_blank" 
					data-target="_blank" data-width="<?php echo $image_option[0];?>" 
					data-height="<?php echo $image_option[1];?>"></li>
					<li data-thumbnail-path="<?php echo   $image_root;?>"></li>
					<li data-thumbnail-text="">
						<p class="largeLabel" style="text-align: center;color:#808080"><?php echo str_replace($find," ",preg_replace("/\\.[^.\\s]{3,4}$/", "", $file));?></p>
						<p class="smallLabel"></p>
					</li>
					
				</ul>
			
				<?php   
}?>
			
<?php
        }
    }
?>
	</ul>
			<!------------ end  ------------->

		</ul>		
<style>
#top_hight,#bottom_hight{
background-color: rgb(17, 17, 17);opacity: 0.5;
}
</style>


