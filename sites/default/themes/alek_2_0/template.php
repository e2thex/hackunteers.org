<?php
// $Id: template.php,v 1.1.4.2 2008/01/13 23:47:31 Gurpartap Exp $

/**
 * Override theme_regions().
 */
function alek_2_0_regions() {
  return array(
    'sidebar_left'  => t('Sidebar left'),
    'sidebar_right' => t('Sidebar right'),	
    'content'       => t('Content'),
    'footer_left'   => t('Footer left'),
    'footer_middle' => t('Footer middle'),
    'footer_right'  => t('Footer right'),
  );
}

/**
 * Return the width required for main content layout.
 */
function alek_2_0_get_primaryContent_width($sidebar_left, $sidebar_right) {
  $width = 100;

  if (!$sidebar_left || !$sidebar_right) {
    $width += 30;
  }

  return $width;
}

/**
 * Return a themed breadcrumb trail.
 *
 * @param $breadcrumb
 *   An array containing the breadcrumb links.
 * @return a string containing the breadcrumb output.
 */
function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return '<div class="breadcrumb">'. implode(' › ', $breadcrumb) .'</div>';
  }
}
