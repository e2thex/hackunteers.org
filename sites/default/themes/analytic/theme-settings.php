<?php
// $Id: theme-settings.php,v 1.1 2008/12/26 10:06:56 troy Exp $

/**
* Implementation of THEMEHOOK_settings() function.
*
* @param $saved_settings
*   array An array of saved settings for this theme.
* @return
*   array A form array.
*/
function phptemplate_settings($saved_settings) {
  $defaults = array(
    'admin_left_column' => 1,
    'admin_right_column' => 0
  );
  
  $settings = array_merge($defaults, $saved_settings);
   
   
  $form['tnt_container'] = array(
    '#type' => 'fieldset',
    '#title' => t('Column settings'),
    '#description' => t('Sometimes the content of admin section is much wider than the central column (especially on "views" and "theme" configuration pages), and as a result the content is cut. Here you can choose if you want the columns to be displayed in admin section, or not.'),
    '#collapsible' => TRUE,
    '#collapsed' => false,
  );
  
  // General Settings
  $form['tnt_container']['admin_left_column'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show left column in admin section'),
    '#default_value' => $settings['admin_left_column']
    );
  
  $form['tnt_container']['admin_right_column'] = array(
    '#type' => 'checkbox',
    '#title' => t('Show right column in admin section'),
    '#default_value' => $settings['admin_right_column']
    );  
  
  // Return theme settings form
  return $form;
}  

?>
