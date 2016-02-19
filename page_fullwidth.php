<?php
/**
 * This file adds the Full Width template to the Streamline Pro Theme.
 *
 * @author StudioPress
 * @package Streamline Pro
 * @subpackage Customizations
 */

/*
Template Name: Full Width
*/


//* Force full width content layout
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );

//* Remove breadcrumbs
remove_action( 'genesis_before_content_sidebar_wrap', 'genesis_do_breadcrumbs' );

//* Run the Genesis loop
genesis();
