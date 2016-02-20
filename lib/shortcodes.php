<?php

/**
 *  Notice Boxes Shortcodes
 *
 */
function noticeContainer($params, $content = null) {

  // default parameters
  extract(shortcode_atts(array(
    'color' => ''
    ), $params));

  return
    '<div class="notice'
    . ($color == '' ? '">' : " notice-$color\">")
    . do_shortcode($content) . "</div>";
}
add_shortcode('notice', 'noticeContainer');

/**
 *  Image Border Shortcodes
 *
 */
function imageBorder($params, $content = null) {

  // default parameters
  extract(shortcode_atts(array(
    'align' => '',
    'color' => ''
    ), $params));

  return
    '<div class="image-border'
    . ($color == '' ? '">' : " $color-border")
    . ($align == '' ? '">' : " align$align\">")
    . do_shortcode($content) . "</div>";
}
add_shortcode('image-border', 'imageBorder');

/**
 *  Layout Shortcodes
 *
 *  Custom shortcodes that use bootstrap's floating layout containers.
 * 
 *  @Link: http://twitter.github.io/bootstrap/assets/css/bootstrap-responsive.css
 */

/**
 *  Clearfix
 *
 */
function clearfix() {
  return '<div class="clear"></div>';
}
add_shortcode('clear-layout', 'clearfix');

/**
 *  half columns
 *
 *  first class requires class="first" param to be passed.
 */
function oneHalf($params, $content = null) {

  // default parameters
  extract(shortcode_atts(array(
    'class' => ''
    ), $params));

  return
    '<div class="layout-shortcode one-half'
    . ($class == '' ? '">' : " $class\">")
    . do_shortcode($content) . "</div>";
}
add_shortcode('one-half', 'oneHalf');


/**
 * one-third columns
 *
 */
function oneThird($params, $content = null) {

  // default parameters
  extract(shortcode_atts(array(
    'class' => ''
    ), $params));

  return
    '<div class="layout-shortcode one-third'
    . ($class == '' ? '">' : " $class\">")
    . do_shortcode($content) . "</div>";
}
add_shortcode('one-third', 'oneThird');

/**
 * two-thirds columns
 *
 */
function twoThirds($params, $content = null) {

  // default parameters
  extract(shortcode_atts(array(
    'class' => ''
    ), $params));

  return
    '<div class="layout-shortcode two-thirds'
    . ($class == '' ? '">' : " $class\">")
    . do_shortcode($content) . "</div>";
}
add_shortcode('two-thirds', 'twoThirds');
