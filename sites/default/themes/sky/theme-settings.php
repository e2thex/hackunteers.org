<?php
// $Id$

/**
 * Implementation of _settings() theme function.
 *
 * PHP Template users: Do NOT put this function in your
 * template.php file; it won't work.
 *
 * @return array
 */

function sky_settings($saved_settings) {
  // Set the default values for the theme variables
  $defaults = array(
    'sky_breadcrumbs' => 0,
    'sky_breadcrumbs_sep' => '&raquo;',
    'sky_font' => 'lucida',
    'sky_font_headings' => 'lucida',
    'sky_font_size' => '12px',
    'sky_header_height' => 'auto',
    'sky_layout' => 'fixed_960',
    'sky_title' => 1,
    'sky_nav_alignment' => 'center',
    'sky_sub_navigation_size' => '15em',
    'sky_wireframe' => 0,
  );
  
  // Merge the variables and their default values
  $settings = array_merge($defaults, $saved_settings);
  
  // Layout Type
  $form['sky_layout'] = array(
    '#type' => 'select',
    '#title' => t('Layout Type'),
    '#default_value' => $settings['sky_layout'],
    '#options' => array(
      'fixed_960' => t('Fixed - 960px'),
      'fluid_98' => t('Fluid - 98%'),
      'fluid' => t('Fluid - 100%'),
    ),
    '#description' => t('This will determine the width of your site layout. Fixed layouts are center aligned.
      <ul class="tips">
        <li><strong>Fixed - 960px:</strong> A standard size for targeting: 1024 x 768 resolution.</li>
        <li><strong>Fluid - 98%:</strong> Will automatically size to fit the 98% the screen width, leaving room for the background image.</li>
        <li><strong>Fluid - 100%:</strong> Will automatically size to fit the 100% the screen width.</li>
    </ul>'),
  );
  
  // Alignment of Navigation
  $form['sky_nav_alignment'] = array(
    '#type' => 'select',
    '#title' => t('Header Navigation Alignment'),
    '#default_value' =>  $settings['sky_nav_alignment'],
    '#options' => array(
      'left' => t('Left'),
      'right' => t('Right'),
      'center' => t('Center'),
    ),
    '#description' => t('The alignment of the header navigation bar.'),
  );
  
  // Page Title in Header
  $form['sky_title'] = array(
    '#type' => 'checkbox',
    '#title' => t('Print page title at the top of each page'),
    '#default_value' =>  $settings['sky_title'],
  );
  
  // Breadcrumb Settings
  $form['sky_breadcrumbs'] = array(
    '#type' => 'checkbox',
    '#title' => t('Disable Breadcrumbs'),
    '#default_value' =>  $settings['sky_breadcrumbs'],
  );
  
  // Breadcrumb Separator
  $breadcrumbs_status =  theme_get_setting('sky_breadcrumbs') ? TRUE : FALSE;
  $breadcrumbs_desc =  $breadcrumbs_status ? t('Select a breadcrumb separator.') : t('Breadcrumbs must be enabled to use this feature.');
  
  $form['sky_breadcrumbs_sep'] = array(
    '#type' => 'select',
    '#title' => t('Breadcrumb Separator'),
    '#default_value' =>  $settings['sky_breadcrumbs_sep'],
    '#options' => array(
      '&raquo;' => '»',
      '&rsaquo;' => '›',
      '&rarr;' => '→',
      '/' => t('/'),
    ),
    '#description' => $breadcrumbs_desc,
    '#disabled' => $breadcrumbs_status,
  );
  
  // Base Font
  $form['sky_font'] = array(
    '#type' => 'select',
    '#title' => t('Base Font'),
    '#default_value' =>  $settings['sky_font'],
    '#options' => _sky_font_list(),
    '#description' => t('Select the base font for the theme.'),
  );
  
  // Headings Font
  $form['sky_font_headings'] = array(
    '#type' => 'select',
    '#title' => t('Headings Font'),
    '#default_value' =>  $settings['sky_font_headings'],
    '#options' => _sky_font_list(),
    '#description' => t('Select the base font for the heading (block, page titles and heading tags).'),
  );
  
  // Base Font Size
  $form['sky_font_size'] = array(
    '#type' => 'select',
    '#title' => t('Base Font Size'),
    '#default_value' => $settings['sky_font_size'],
    '#options' => _sky_size_range(11, 16, 'px', 12),
    '#description' => t('Select the base font size for the theme.'),
  );
  
  // Width of Dropdown menus
  $form['sky_sub_navigation_size'] = array(
    '#type' => 'select',
    '#title' => t('Secondary Navigation Width'),
    '#default_value' => $settings['sky_sub_navigation_size'],
    '#options' => _sky_size_range(10, 30, 'em', 15),
    '#description' => t('The drop-down menus need a width. IF you find your menu items need to be adjusted smaller or larger, you can tweak the settings here.'),
  );
  
  // Adjust the height of the header, commonly requested in the issue queue.
  $form['sky_header_height'] = array(
    '#type' => 'textfield',
    '#title' => t('Height of Header (default is "132px")'),
    '#default_value' => $settings['sky_header_height'],
    '#description' => t('To tweak the height of the header, please enter the height in pixels or ems, ie. 200px, 10em'),
  );
  
  // Generate custom.css and display a link to the file
  $form['sky_css'] = array(
    '#type' => 'fieldset',
    '#title' => 'Custom CSS Generation',
    '#description' =>  _sky_write_css(), // This is the function that creates the custom.css file is created... Do not remove.
    '#collapsible' => TRUE,
    '#collapsed' => FALSE,
  );
  
  // Advanced Theme Settings
  $form['sky_advanced'] = array(
    '#type' => 'fieldset',
    '#title' => 'Advanced Themer Settings',
    '#collapsible' => TRUE,
    '#collapsed' => TRUE,
  );
  
  // Enable advanced themer classes
  $form['sky_advanced']['sky_themer_classes'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Advanced Themer ID\'s and Classes'),
    '#default_value' => $settings['sky_themer_classes'],
    '#description' => t('This option provides advanced, page-level classes for themers. <strong class="marker">Warning: For Advanced Themers Only.  Use this at your own risk.</strong>'),
  );
  
  // Enable wireframe or start from scratch mode
  $form['sky_advanced']['sky_wireframe'] = array(
    '#type' => 'checkbox',
    '#title' => t('Enable Wireframing / Starting From Scratch Mode'),
    '#default_value' => $settings['sky_wireframe'],
    '#description' => t('This option is helpful for developers/themers that want to show a wireframe style version of the theme.  It\'s also helpful for themers because it removes the stylesheet that controls Sky-specific colors. Enabling this option essentially removes the appearance.css file.  However, you can also just delete the contents of the file and write your own <acronym title="Cascading Style Sheets">CSS</acronym>.'),
  );
  
  return $form;
}

function _sky_build_css() {
  
  // grab the current theme settings
  $theme_settings = variable_get('theme_sky_settings', '');
  
  // build an array of only the theme related settings
  $setting = array();
  foreach ($theme_settings as $key => $value) {
    if (strpos($key, 'sky_') !== FALSE) {
      $setting[$key] = $value;
    }
  }
  
  // handle custom settings for each case
  $custom_css = array();
  
  foreach ($setting as $key => $value) {
    switch ($key) {
      
      case 'sky_layout':
        switch ($value) {
          case 'fluid':
            $width = '100%';
          break;
          case 'fluid_98':
            $width = '98%';
          break;
          case 'fixed': default:
            $width = '960px';
          break;
        }
        $custom_css[] = '#wrapper, #footer { width: '. $width .'; }';
      break;
      
      case 'sky_font_size':
        $custom_css[] = 'body { font-size: '. $value .'; }';
      break;
      
      case 'sky_font':
        $custom_css[] = 'html, body, .form-radio, .form-checkbox, .form-file, .form-select, select, .form-text, input, .form-textarea, textarea  { font-family: '. _sky_font($value) .'; }';
      break;
      
      case 'sky_sub_navigation_size':
        $custom_css[] = '#navigation ul ul, #navigation ul ul li  { width: '. $value .'; }';
        // 3rd level + menu items, left position
        $custom_css[] = '#navigation li li.expanded ul { margin: -2.65em 0 0 '. $value .'!important; }';
      break;
      
      case 'sky_header_height':
        $custom_css[] = '#header-inner { height: '. $value .'; }';
      break;
      
      case 'sky_font_headings':
        $custom_css[] = 'h1, h2, h3, h4, h5, h6,  #main h1.title, .title  { font-family: '. _sky_font($value) .'; }';
      break;
    }
  }
  return implode("\r\n", $custom_css);
}


function _sky_write_css() {
  // Set the location of the custom.css file
  $file_path = file_directory_path() .'/sky/custom.css';
  
  // If the directory doesn't exist, create it
  file_check_directory(dirname($file_path), FILE_CREATE_DIRECTORY);
  
  // Generate the CSS
  $file_contents = _sky_build_css();
  $output = '<div class="description">'. t('This CSS is generated by the settings chosen above and placed in the files directory: '. l($file_path, $file_path) .'. The file is generated each time this page (and only this page) is loaded. <strong class="marker">Make sure to refresh your page to see the changes</strong>') .'</div>';
  
  file_save_data($file_contents, $file_path, FILE_EXISTS_REPLACE);
  
  return $output;
  
}

function _sky_font_list() {
  // create an array for use in the for font selection in forms
  $fonts = array(
    'Sans-serif' => array(
      'verdana' => t('Verdana'),
      'helvetica' => t('Helvetica, Arial'),
      'lucida' => t('Lucida Grande, Lucida Sans Unicode'),
      'geneva' => t('Geneva'),
      'tahoma' => t('Tahoma'),
    ),
    'Serif' => array(
      'georgia' => t('Georgia'),
      'palatino' => t('Palatino Linotype, Book Antiqua'),
      'times' => t('Times New Roman'),
    ),
  );
  return $fonts;
}

function _sky_font($font) {
  if ($font) {
    $fonts = array(
      'verdana' => '"Bitstream Vera Sans", Verdana, Arial, sans-serif',
      'helvetica' => 'Helvetica, Arial, "Nimbus Sans L", "Liberation Sans", "FreeSans", sans-serif',
      'lucida' => '"Lucida Grande", "Lucida Sans", "Lucida Sans Unicode", "DejaVu Sans", Arial, sans-serif',
      'geneva' => '"Geneva", "Bitstream Vera Serif", "Tahoma", sans-serif',
      'tahoma' => 'Tahoma, Geneva, "DejaVu Sans Condensed", sans-serif',
      'georgia' => 'Georgia, "Bitstream Vera Serif", serif',
      'palatino' => '"Palatino Linotype", "URW Palladio L", "Book Antiqua", "Palatino", serif',
      'times' => '"Free Serif", "Times New Roman", Times, serif',
    );
    
    foreach ($fonts as $key => $value) {
      if ($font == $key) {
        $output = $value;
      }
    }
  }
  return $output;
}

function _sky_size_range($start = 11, $end = 16, $unit = 'px', $default = NULL) {
  $range = '';
  if (is_numeric($start) && is_numeric($end)) {
    $range = array();
    $size = $start;
    while ($size >= $start && $size <= $end) {
      if ($size == $default) {
        $range[$size . $unit] = $size . $unit .' (default)';
      }
      else {
        $range[$size . $unit] = $size . $unit;
      }
      $size++;
    }
  }
  return $range;
}