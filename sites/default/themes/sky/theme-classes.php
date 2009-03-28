<?php
// $Id$
// Create detailed page level ID's and classes for easy theming

// Default String based on Arguments
$index = 0;
$arg_string = array();

while (($argvalue = arg($index)) != '' ) {
  // exclude values that are numeric (i.e node id's, user id's)
  if (!is_numeric($argvalue)) {
    $arg_string[$index] = check_plain($argvalue);
  }
  $index++;
}

// Use the modified args array to build a detailed class string
$arg_string = _sky_id_safe(implode(' ', $arg_string));

$class = array();
$id = array();

$sidebar_left = $variables['left'];
$sidebar_right = $variables['right'];

switch (TRUE) {
  case empty($sidebar_left) && empty($sidebar_right):
    $class[] = 'no-sidebars';
  break;
  case $sidebar_left && $sidebar_right:
    $class[] = 'both';
  break;
  case $sidebar_left:
    $class[] = 'left';
  break;
  case $sidebar_right:
    $class[] = 'right';
  break;
} // end layout switch

switch (arg(0)) {
  // Nodes
  case 'node':
    if ($node = menu_get_object()) {
    // regular node view page
    if (!arg(2)) {
      $class[] = 'page-'. $node->type;
      $id[] = 'page-node-'. $node->nid;
    }
    else {
      // node op: edit, delete, preview
      $class[] = 'page-'. $node->type .' '. $arg_string;
    }
  }
  elseif (arg(1) == 'add') {
    // node op: add
      $class[] = 'page-add'.' '. $arg_string;
  }
  
  break;
  // User Pages
  case 'user':
  // Add common page-user class
  if (arg(1)) {
      if (is_numeric(arg(1)) && !arg(2)) {
        $class[] = 'page-'.'user';
      }
      else {
        $class[] = 'page-user page-'. $arg_string;
      }
    }
    else {
      // sub user page ie. login, regiter, tracker, etc..
      $class[] = 'page-'. $arg_string;
    }
  break;
  // Misc node cases
  case 'blog':
    $id[] = 'page-'. $arg_string;
    $class[] = 'page-blog';
  break;
  // Admin pages
  case 'admin':
    $class[] = 'page-admin';
    $id[] = 'page-'. $arg_string;
  break;
  // Forum pages
  case 'forum':
    if (is_numeric(arg(1))) {
      $class[] = 'page-forum';
      $id[] = 'page-forum-'. arg(1);
    }
    else {
      $class[] = 'page-forum';
      $id[] = 'page-forum';
    }
  break;
  default:
    $id[] = 'page-'. $arg_string;
  break;
} // end arg(0) switch

if (drupal_is_front_page()) {
  $id = '';
  $id[] =  'homepage';
}

// Prepare for output
if ($id) {
  $id_string = ' id="'. implode(' ', $id) .'"';
}
if ($class) {
  $class_string = ' class="'. implode(' ', $class) .'"';
}

$variables['body_css'] =  $id_string . $class_string;
