
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/3dblog/latest.css" type="text/css" media="screen">
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/3dblog/user-controls1.css" type="text/css" media="screen">
<!--[if IE 6]><link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/3dblog/3d_related_files/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/3dblog/3d_related_files/css/ie7.css" /><![endif]-->
<!--[if IE 8]><link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/3dblog/3d_related_files/css/ie8.css" /><![endif]-->
<!--[if IE 9]><link type="text/css" rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/3dblog/3d_related_files/css/ie9.css" /><![endif]-->
<!--[if IE]><script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/3dblog/3d_related_files/excanvas.compiled.js"></script><![endif]-->

<script style="color: rgb(0, 0, 0);" type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/3dblog/user-controls1.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/3dblog/support.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/3dblog/latest.js"></script>
<script type="text/javascrip" src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.11.0.min.js"></script>
		

<style>
.site-footer{
bottom:28px;
}
</style>		
		<script type="text/javascript">$("body").removeClass("tl-non-js-styles");</script>
			
		
		<div id="console"></div>
		<div style="background-color: rgb(0, 0, 0);" class="browser-type-firefox" id="tl-container">
			
			<div id="tl-image-preloader">
				<img src="<?php echo get_template_directory_uri(); ?>/3dblog/black-opacity-95.png" alt="">

				
			</div>
			
			<div class="tl-timeline-info">
				
				<p class="tl-ah-about-text"></p>
				
						</div>
			
			<div style="background-color: rgb(26, 26, 26); height: 578px;" id="tl-stage-holder" class="tl-font tl-page-size-normal-height"><!--<img style="width: 1626.25px; height: 1016.25px; top: -219px; left: 0px;" src="<?php echo get_template_directory_uri(); ?>/3dblog/3d_related_files/background.jpg" alt="" id="tl-stage-image">
				<img src="/assets/ui/empty-image2.gif" alt="" id="tl-stage-image" />
				<div id="tl-stage-main-photo-credit">Photo credit: <a href="http://www.dubbelklikdesign.nl/">G Schouten de 					Jel</a></div>			
				scale-month-small-day.pngbackground: url(/assets/ui/stage/scale-month-small-day.png) left bottom repeat-x;-->
				
				<div id="tl-stage-scale-blackener"></div>
<div style="width: 17766.4px; left: -12605.5px; display: none;" class="tl-stage tl-stage-view-standard tl-stage-month-small-day">
<div>
</div>

</div>
				
				<canvas style="display: none; width: 1301px; height: 578px;" id="tl-3d-view-canvas" width="1301" height="578"></canvas>

				<div style="display: block;" id="tl-stage-date-displayer"></div>
				<div class="tl-stage-border-top"></div>
				<div class="tl-stage-border-bottom"></div>
				
				
				
		
				
<div id="tl-uc-controls" >

	<div style="opacity: 0; display: none;" id="tl-uc-panel">
		<div class="tl-ucp-top-right">
			<div class="tl-ucp-top-left">
				<div class="tl-ucp-content">
				
					<div class="fp-carousel">
						<div class="fp-stage">
							<div id="tl-uc-search-block" class="fp-block fp-block-0">
								<h3 id="uc-text-search">Search</h3>
								<div class="ft-p1-input-holder">
									<input id="ft-fch-sp-input" value="Enter search term" type="text">
									<a id="ft-fch-sp-button" href="#">Go</a>
								</div>
								<div id="ft-p1-filter-text">
									<h5 id="uc-text-displaying">Displaying:</h5> <span style="display: inline;" id="ft-fch-sp-everyone-message">All stories</span><span  id="ft-fch-sp-filter-message"><span id="ft-fch-sp-num-stories">X1 stories</span> <span id="uc-text-matching">matching</span> '<strong id="ft-fch-sp-filter"></strong>' (<a id="ft-fch-sp-clear" href="#">clear</a>)</span>
								</div>
								<a href="#" class="close-panel">Close</a>
							</div>
							<div id="tl-uc-view-filter-block" class="fp-block fp-block-1 ajk-content-scroller">
								<h3 id="uc-text-category-filter">Categories</h3>
								<div class="ajk-cs-carousel">
									<div class="ajk-cs-carousel-stage">
										<ul class="tl-colour-checkbox-list"></ul>
									</div>
									<div class="ajk-cs-carousel-scroll-holder">
										<a href="#" class="ajk-cs-up-arrow"></a>
										<a href="#" class="ajk-cs-down-arrow"></a>
										<div class="ajk-cs-scroll-bar">
											<span></span>
										</div>
									</div>
								</div>
								<a href="#" class="close-panel">Close</a>
							</div>
							<div  id="tl-uc-view-type-block" class="fp-block fp-block-2">
								<h3 id="uc-text-view-type">View Type</h3>
								<ul class="tl-image-select-list">
									<li class="tl-isl-standard selected" view="0">
										<div class="image-holder"><span></span></div>
										<p>Standard</p>
									</li>
									<li class="tl-isl-category" view="1">
										<div class="image-holder"><span></span></div>
										<p>Category Bands</p>
									</li>
									<li class="tl-isl-coloured" view="2">
										<div class="image-holder"><span></span></div>
										<p>Coloured Stories</p>
									</li>
									<li class="tl-isl-duration" view="3">
										<div class="image-holder"><span></span></div>
										<p>Duration</p>
									</li>
								</ul>
								<a href="#" class="close-panel">Close</a>
							</div>
							<div  id="tl-uc-spacing-block" class="fp-block fp-block-3">
								<h3 id="uc-text-story-spacing">Story Spacing</h3>
								
								<select>
									
									<option value="0">Standard</option>
									<option value="1" >Equal Spacing 1</option>
									<option value="2">Equal Spacing 2</option>
									<option value="3">Top to Bottom - 3 rows</option>
									<option value="4">Top to Bottom - 4 rows</option>
									<option value="5">Top to Bottom - 5 rows</option>
									<option value="6">Top to Bottom - 6 rows</option>
									<option value="7">Top to Bottom - 7 rows</option>
									<option value="8">Top to Bottom - 8 rows</option>
									<option value="9">Top to Bottom - 9 rows</option>
									<option value="10">Top to Bottom - 10 rows</option>
								</select>							
								<a href="#" class="close-panel">Close</a>
							</div>
							<div id="tl-uc-zoom-block" class="fp-block fp-block-4">
								<h3 id="uc-text-zoom">Zoom</h3>
								<select>
									<option></option>
								</select>
								<div class="zoom-buttons">
									<a href="#" class="zoom-in">+</a>
									<a href="#" class="zoom-out">-</a>
								</div>
								<a href="#" class="close-panel">Close</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<div class="tl-ucp-bottom-right">
			<div class="tl-ucp-bottom-left"></div>
		</div>
	</div>

	<div class="menu-holder">
		<ul>
			<li fppos="0"><a href="#">Search</a></li>
			<li fppos="1" ><a href="#">Categories</a></li>
			<li fppos="2" style="display:none !important;"><a href="#">View Type</a></li>
			<li  fppos="3"><a href="#">Spacing</a></li>
			<li fppos="4"><a href="#">Zoom</a></li>
		</ul>
	</div>
	<a href="#" class="launch">Launch</a>
</div>

				
				<a style="display: block;" href="#" id="tl-timeline-3d-launch">2d</a>
				<a id="create_post" href="<?php echo esc_url( home_url( '/' ) ); ?><?php echo myposts;?>/">My Posts</a>
				
			
			</div>
			<div  id="tl-slider-holder" class="tl-font">
				<div id="tl-slider-scale-holder">
					<div  id="tl-slider-scale">
						<canvas style="background-color: rgb(0, 0, 0); width: 1951.5px;" class="tl-scale-canvas"></canvas>
					
					<div id="tl-slider-scale-times-holder"></div>	
				<div id="tl-slider-markers-holder">
						<div></div></div>
					</div>
				</div>
				<div style="width: 172px; left: 0px;" id="tl-slider-dragger">
					<div style="width: 148px; border-color: rgb(128, 128, 128);" class="tlsd-inner">
						<div class="tlsd-inner-inner">
							<div style="background-color: rgb(128, 128, 128);" class="tlsd-corner tlsd-c-tl"></div>
							<div style="background-color: rgb(128, 128, 128);" class="tlsd-corner tlsd-c-tr"></div>
							<div style="background-color: rgb(128, 128, 128);" class="tlsd-corner tlsd-c-bl"></div>
							<div style="background-color: rgb(128, 128, 128);" class="tlsd-corner tlsd-c-br"></div>
						</div>				
					</div>
				</div>
				<div id="tl-slider-interaction-preventer"></div>
			</div>
			<div id="tl-footer"></div>

		
				<div id="tl-content-holder" class="tl-main-content-block-holder tl-font">
				<div class="tl-mc-fade"></div>
				<div class="tl-mc-coloured-border"></div>
				<div class="tl-main-content-block">
			<div class="tl-mc-top-right">
			<div class="tl-mc-top-left">
			<div class="tl-mc-carousel">
			<div class="tl-mc-carousel-stage">
			<div class="tl-mc-content">
		<div class="tl-mc-content-images-and-text">
		<div class="tl-ch-top-content">
		<ul class="tl-ch-media-list">
		<li rel="images" class="tl-ch-selected"><a href="#"><em>Images</em> (<span>0</span>)</a></li>
		<li rel="videos"><a href="#"><em>Videos</em> (<span>0</span>)</a></li>
		<li rel="audio" ><a href="#"><em>Audio</em> (<span>0</span>)</a></li>
		
		</ul>
		<a class="tl-ch-close-content" href="#"><!-- Close--></a>
		<h5 class="tl-ch-panel-date-display"></h5>
		<!--<a  id="edit_post" class='edit_post1' target="_blank" style="position: absolute;right: 25px;top: 5px;">Edit</a>-->
		</div>
		<div class="tl-ch-content-block tl-ch-gallery-block">
		<div class="tl-gallery ak-gallery">
		<div class="tl-g-main-content ak-gallery-stage-holder">
		<div class="ak-gallery-image-storage"></div>
		<div class="tl-g-main-stage ak-gallery-stage">
		</div>
		<div class="tl-g-content-mask">
			<div class="tl-g-content-mask-inner"></div>
			<div class="tl-g-gallery-controls">
			<a class="tl-g-gallery-control-left" href="#"></a>
			<a class="tl-g-gallery-control-right" href="#"></a>
			</div>
			</div>
			</div>
			<div class="tl-g-thumb-holder">
			<div class="tl-g-thumb-stage">
			</div>
			<a class="tl-g-thumb-control-left" href="#"></a>
			<a class="tl-g-thumb-control-right" href="#"></a>
			</div>
			</div> <!-- /tl-gallery -->
			</div>
			<div class="tl-ch-content-block tl-ch-content-block-text">
			<div class="tl-ch-content-block-inner ajk-content-scroller">
			<div class="tl-ch-content-intro-block ajk-cs-carousel">
			<div class="ajk-cs-carousel-stage">
			<h3 class="tl-font-head"></h3>
			<p class="tl-ch-standfirst tl-font-body"></p>
			<p class="tl-ch-author"></p>
			<div class="tl-ch-extra-info-text tl-font-body"></div>
			<a href="#" class="tl-ch-full-story-link rt-button-medium rt-button-medium-long" target="_top">Read full story</a>
			</div>
			<div class="ajk-cs-carousel-scroll-holder">
			<a href="#" class="ajk-cs-up-arrow"></a>
			<a href="#" class="ajk-cs-down-arrow"></a>
			<div class="ajk-cs-scroll-bar">
			<span></span>
			</div>
			</div>
			</div>
			</div>
			</div>
		</div>
										
		<div class="tl-ch-video-content">
		<div class="tl-ch-vc-inner">
		</div>	</div>
		</div>
		</div>
		</div>
		</div>
		</div>
		<div class="tl-mc-bottom-right">
		<div class="tl-mc-bottom-left">
		<div class="tl-mc-footer-content">
		<div class="tl-ch-bc-inner tl-ch-next-prev-story">
		<p class="tl-ch-selected-story-num">x1 of x2 stories</p>
		<a class="tl-ch-prev-story" href="#"></a>
		<a class="tl-ch-next-story" href="#"></a>
		</div>
		<a class="tl-ch-close-video rt-button-3 rt-button-3-long" href="#">Close video</a>
		<a href="#" id="tl-ch-start-timeline-button" class="tl-ch-start-timeline rt-button-3">Continue</a>
		</div>
		</div>
		</div>
		</div>
		</div>
<div id="tl-cp-image-viewer" >
				<div class="tl-cpiv-main-item">
		</div>
				<div class="tl-cpiv-caption-holder">
					
				</div>
				<div class="tl-cpiv-content-mask">
					<div class="tl-cpiv-content-mask-inner"></div>
					<a href="http://www.tiki-toki.com/timeline/entry/43/Beautiful-web-based-timeline-software/#"></a>
				</div>
			</div>
		</div>
