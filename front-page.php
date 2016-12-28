<?php
/**
 * This file adds the Home Page to the Streamline Pro Theme.
 *
 * @author StudioPress
 * @package Streamline Pro
 * @subpackage Customizations
 */

add_action( 'genesis_meta', 'streamline_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function streamline_home_genesis_meta() {

	if ( is_active_sidebar( 'home-featured-1' ) ) {
	
		//* Force content-sidebar layout setting
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );
	
		// Add streamline-pro-home body class
		add_filter( 'body_class', 'streamline_body_class' );
	
		// Add homepage widgets
		add_action( 'genesis_before_content_sidebar_wrap', 'streamline_homepage_widgets' );

	}
}

function streamline_body_class( $classes ) {

	$classes[] = 'streamline-pro-home';
	return $classes;
	
}

function streamline_homepage_widgets() {

	if ( is_active_sidebar( 'home-featured-1' ) ) {

		echo '<div class="home-featured">';
	
		genesis_widget_area( 'home-featured-1', array(
			'before' => '<div class="home-featured full-width-widget">
										<div class="post-it"></div>
										<div class="note"></div>
										<div class="vintage"></div>
										<div class="market"></div>
										<!--<div class="paperclip"></div>-->
										<div class="postcard-wrapper">
											<div class="postcard-back card-1">
												<div class="postcard-back card-2">
													<div class="postcard-back card-3">
														<div class="postcard-back card-4">
														</div>
													</div>
												</div>
											</div>
										</div>
									',
			'after'  => '</div>',
		) );
		
		echo '</div><!-- end #home-featured -->';

		// add divider to set up home-featured shadows at bottom
		echo '<div class="home-featured-shadows shadow-bottom"></div>';

	}

}

genesis();
