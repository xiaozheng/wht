<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package duena
 */
?>
	<div id="secondary" class="widget-area span4" role="complementary" style="display:none">
		<?php do_action( 'before_sidebar' ); ?>
		<?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
			
			<aside id="meta" class="widget">
				<h1 class="widget-title"><?php _e( 'Meta', 'duena' ); ?></h1>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<?php wp_meta(); ?>
				</ul>
			</aside>

		<?php endif; // end sidebar widget area ?>
	</div><!-- #secondary -->
