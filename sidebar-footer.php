<?php
/**
 * The Footer Widgets
 *
 * @package kaneko
 */

if ( ! is_active_sidebar( 'footer-area' ) ) {
	return;
}
?>

<div id="supplementary">
	<div id="footer-widgets" class="footer-widgets widget-area clear" role="complementary">
		<?php dynamic_sidebar( 'footer-widgets' ); ?>
	</div><!-- #footer-sidebar -->
</div><!-- #supplementary -->
