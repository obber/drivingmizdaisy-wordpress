<?php

/**
 *  Layout Shortcodes
 *
 *  Custom shortcodes that use bootstrap's floating layout containers.
 * 
 *  @Link: http://twitter.github.io/bootstrap/assets/css/bootstrap-responsive.css
 */

/**
 *  Notice Boxes
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
 *  Blue Image Border
 *
 */
function blueBorder($params, $content = null) {

  // default parameters
  extract(shortcode_atts(array(
    'align' => ''
    ), $params));

  return
    '<div class="blue-image-border'
    . ($align == '' ? '">' : " align$align\">")
    . do_shortcode($content) . "</div>";
}
add_shortcode('image-border', 'blueBorder');

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
