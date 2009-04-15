<?php
// $Id: template.php,v 1.5 2009/01/29 14:32:52 troy Exp $

function phptemplate_preprocess_page(&$vars) {
  $defaults = array(
    'admin_left_column' => 1,
    'admin_right_column' => 0
  );
  
  global $theme_key;
  // Get default theme settings.
  $settings = theme_get_settings($theme_key);    
  $settings = array_merge($defaults, $settings);
 
  
  
  if (arg(0) == 'admin' && ($settings['admin_right_column'] == 0) && !(arg(1) == 'build' && arg(2) == 'block')) {
    $vars['right'] = '';
  }
  
  if (arg(0) == 'admin' && ($settings['admin_left_column'] == 0) && !(arg(1) == 'build' && arg(2) == 'block')) {
    $vars['left'] = '';
  }
  
  $vars['registration_enabled'] = variable_get('user_register', 1);
  $vars['closure'] .= '<span class="developer">
<strong><a href="http://russianwebstudio.com" title="Go to RussianWebStudio.com">Drupal theme</a></strong> by        <a href="http://russianwebstudio.com" title="Go to RussianWebStudio.com">RussianWebStudio.com</a> <span class="version">ver.1.3</span>
</span>';
}


/**
 * Generate the HTML representing a given menu item ID.
 *
 * An implementation of theme_menu_item_link()
 *
 * @param $link
 *   array The menu item to render.
 * @return
 *   string The rendered menu item.
 */
function phptemplate_menu_item_link($link) {
  if (empty($link['options'])) {
    $link['options'] = array();
  }

  // If an item is a LOCAL TASK, render it as a tab
  if ($link['type'] & MENU_IS_LOCAL_TASK) {
    $link['title'] = '<span class="tab">' . check_plain($link['title']) . '</span>';
    $link['options']['html'] = TRUE;
  }

  if (empty($link['type'])) {
    $true = TRUE;
  }

  return l($link['title'], $link['href'], $link['options']);
}

/**
 * Duplicate of theme_menu_local_tasks() but adds clear-block to tabs.
 */
function phptemplate_menu_local_tasks() {
  $output = '';

  if ($primary = menu_primary_local_tasks()) {
    $output .= '<ul class="tabs primary clear-block">' . $primary . '</ul>';
  }
  if ($secondary = menu_secondary_local_tasks()) {
    $output .= '<ul class="tabs secondary clear-block">' . $secondary . '</ul>';
  }

  return $output;
}

?>
