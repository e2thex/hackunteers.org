<?php // $Id$

function sky_regions() {
  return array(
    'left' => t('sidebar left'),
    'right' => t('sidebar right'),
    'contenttop' => t('content top'),
    'contentbottom' => t('content bottom'),
    'contentfooter' => t('content footer'),
    'footer' => t('footer'),
  );
}

/*
 * Initialize theme settings
 */
if (is_null(theme_get_setting('sky_layout'))) {
  global $theme_key;
  // Save default theme settings
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
  
  // Get default theme settings.
  $settings = theme_get_settings($theme_key);
  // Don't save the toggle_node_info_ variables.
  if (module_exists('node')) {
    foreach (node_get_types() as $type => $name) {
      unset($settings['toggle_node_info_' . $type]);
    }
  }
  // Save default theme settings.
  variable_set(
    str_replace('/', '_', 'theme_'. $theme_key .'_settings'),
    array_merge($defaults, $settings)
  );
  
  // Force refresh of Drupal internals
  theme_get_setting('', TRUE);
}

// Appearance Stylesheet.  Controls the colors, fonts and borders of the theme
if (theme_get_setting('sky_wireframe') == 0) {
  drupal_add_css(path_to_theme() .'/css/appearance.css', 'theme', 'all', TRUE);
}

// Theme Settings Generated CSS
$custom_css = file_directory_path() .'/sky/custom.css';
if (file_exists($custom_css)) {
  drupal_add_css($custom_css, 'theme', 'all', TRUE);
}

// Conditional stylesheets for IE
function _sky_conditional_stylesheets() {
  $output = "\n".'<!--[if IE 6.0]><link rel="stylesheet" href="'. base_path() . path_to_theme() .'/css/ie-6.css" type="text/css" media="all" charset="utf-8" /><![endif]-->'."\n";
  $output .= '<!--[if IE 7.0]><link rel="stylesheet" href="'. base_path() . path_to_theme() .'/css/ie-7.css" type="text/css" media="all" charset="utf-8" /><![endif]-->'."\n";
  return $output;
}

// Sky Javascipt
drupal_add_js(path_to_theme() .'/js/sky.js');

function sky_preprocess_page(&$variables, $hook) {
  
  // Add a page title variable using the site slogan on the front page
  if (theme_get_setting('sky_title')) {
    if ($variables['is_front'] && !is_null(variable_get('site_name', ''))) {
      $variables['sky_title'] = variable_get('site_name', '');
    }
    else {
      $variables['sky_title'] =  drupal_get_title();
    }
  }
  
  // Add a transparent spacer image to the end of the footer message
  $variables['footer_message'] .= theme('image', path_to_theme() .'/images/transparent.gif', 'spacer', 'spacer', array('style' => 'height:2em;'));
  
  // How is the navigation aligned
  $navigation_alignment = theme_get_setting('sky_nav_alignment');
  
  // Prepare the menu markup for the Primary Links (make it a menu tree)
  if ($variables['primary_links']) {
    $pid = variable_get('menu_primary_links_source', 'primary-links');
    $tree = menu_tree($pid);
    $variables['primary_links'] = '<del class="wrap-'. $navigation_alignment .'">'. $tree .'</del>';
  }

  // Include advanced theme classes.
  if (theme_get_setting('sky_themer_classes') == 1) {
    include('theme-classes.php');
    $variables['body_tag'] = '<body'. $variables['body_css'] .'>';
  }
  else {
    $variables['body_tag'] = '<body class="'. $variables['layout'] .'">';
  }
}

function sky_preprocess_node(&$variables, $hook) {
  $node = $variables['node'];
  // use sky_button_links
  $variables['links'] = _sky_button_links($node->links, array('class' => 'buttons'));
  
  // microformatted post date (from zen)
  if ($variables['submitted']) {
    $variables['submitted'] = t('Posted <abbr class="created" title="!microdate">@date</abbr> by !username', array(
      '!username' => theme('username', $node),
      '@date' => format_date($node->created, 'small'),
      '!microdate' => format_date($node->created, 'custom', "Y-m-d\TH:i:sO")
      )
    );
  }
  switch ($node->type) {
    case 'forum':
      if ($variables['page'] == TRUE) {
        // use theme_links
        $variables['links'] = theme('links', $node->links);
        if ($node->uid != 0) {
          // Load up the real user object
          $variables['account'] = user_load(array('uid' => $node->uid));
          $variables['joined'] = t('<abbr class="created" title="!microdate">@date</abbr>', array(
            '@date' => format_date($variables['account']->created, 'custom', "m/d/y"),
            '!microdate' => format_date($variables['account']->created, 'custom', "Y-m-d\TH:i:sO"),
            )
          );
          $variables['name'] = theme('username', $variables['account']);
        }
        else {
          $variables['name'] = theme('username', $node->uid);
        }
        $variables['content'] = filter_xss($variables['node']->body);
        $variables['user_status'] = _sky_user_status($node->uid);
      }
    break;
  }
}

function sky_preprocess_block(&$variables, $hook) {
  $block = $variables['block'];
  
  // ZEN: Some of Zen's special classes for blocks.
  $classes = array('block');
  $classes[] = 'block-' . $block->module;
  $classes[] = 'region-' . $variables['block_zebra'];
  $classes[] = $variables['zebra'];
  
  // Sky-specific block classes
  $variables['block_classes'] = 'block block-'. $variables['block']->module;
  // Add an indication that the block contains a menu
  switch ($variables['block']->module) {
    case 'menu':
    case 'user':
      if ($variables['block']->delta == 1) {
        $classes[] = 'btype-menu';
      }
    case 'book':
      if ($variables['block']->delta == 0) {
        $classes[] = 'btype-menu';
      }
    break;
  }
  
  // Render block classes.
  $variables['classes'] = implode(' ', $classes);
}

function sky_preprocess_comment(&$variables, $hook) {
  $comment = $variables['comment'];
  $node = node_load($comment->nid);
  
  if ($node->type == 'forum') {
    // User information
    $accountid = $comment->uid;
    
    if ($accountid == 0) {
      // Anonymous User
      $variables['account']->name = $comment->name;
      $variables['account']->homepage = $comment->homepage;
    }
    else {
      // Authenticated User
      $variables['account'] = user_load(array('uid' => $comment->uid));
      $variables['joined'] = t('<abbr class="created" title="!microdate">@date</abbr>', array(
      '@date' => format_date($variables['account']->created, 'custom', "m/d/y"),
      '!microdate' => format_date($variables['account']->created, 'custom', "Y-m-d\TH:i:sO"),
      ));
    }
    
    // provide an icon for comment copy link
    $icon_path = path_to_theme() .'/images/icons/link.png';
    $icon = theme('image', $icon_path, 'Copy comment link', NULL, NULL, TRUE);
    
    // if there is no image, provide alternative text
    if (!$icon) {
      $icon = '#'. $comment->cid;
    }
    
    $variables['comment_link'] = l($icon, 'node/'. $comment->nid, array(
      'attributes' => array(
        'class' => 'copy-comment',
        'title' => 'Grab this comment\'s link',
        'onclick' => 'javascript:return false;',
      ),
      'fragment' => 'comment-'. $comment->cid,
      'html' => TRUE,
      )
    );
    
    $variables['name'] = theme('username', $variables['account']);
    $variables['user_status'] = _sky_user_status($comment->uid);
  }
}

/*
 * Sky button links theme function
 * Insertion of <span> tags, and additional classes for themers
 */
function _sky_button_links($links, $attributes) {
  $output = '';
  
  if (count($links) > 0) {
    $output = '<ul'. drupal_attributes($attributes) .'>';
    $num_links = count($links);
    $i = 0;
    
    foreach ($links as $key => $link) {
      $class = '';
      // Automatically add a class to each link and also to each <li>
      if (isset($link['attributes']) && isset($link['attributes']['class'])) {
        $link['attributes']['class'] .= ' '. $key;
      }
      else {
        $link['attributes']['class'] = $key;
      }
      
      // Add even/odd classes
      $stripe = $i % 2 ? 'even' : 'odd';
      $link['attributes']['class'] = empty($link['attributes']['class']) ? $stripe : ($link['attributes']['class'] .' '. $stripe);
      
      // Add fist/last classes
      if ($i == 0) {
        $link['attributes']['class'] = empty($link['attributes']['class']) ? 'first' : ($link['attributes']['class'] .' first');
      }
      elseif ($i == $num_links - 1) {
        $link['attributes']['class'] = empty($link['attributes']['class']) ? 'last' : ($link['attributes']['class'] .' last');
      }
      
      // Is the title HTML?
      $html = isset($link['html']) && $link['html'];
      
      // Initialize fragment and query variables.
      $link['query'] = isset($link['query']) ? $link['query'] : NULL;
      $link['fragment'] = isset($link['fragment']) ? $link['fragment'] : NULL;
      
      // Add an HTML class to help style the content
      if ($html) {
        $wrapper = TRUE;
        $link['attributes']['class'] = empty($link['attributes']['class']) ? 'mixed' : ($link['attributes']['class'] .' mixed');
      }
      
      // Add an wrapper to items without actual links class to help style the content
      if (!$link['href'] && !$html) {
        $wrapper = TRUE;
        $link['attributes']['class'] = empty($link['attributes']['class']) ? 'plain' : ($link['attributes']['class'] .' plain');
      }
      // Add even/odd stripes
      $output .= '<li class="'. $link['attributes']['class'] .'">';
      
      if (isset($link['href'])) {
        $output .= l('<span class="tr">&nbsp;</span><span class="tl">&nbsp;</span><em>'. $link['title'] .'</em><span class="bl">&nbsp;</span><span class="br">&nbsp;</span>', $link['href'], array(
          'attributes' => array(
            'class' => 'button',
            'title' => $link['attributes']['title'],
            ),
          'query' => $link['query'],
          'fragment' => $link['fragment'],
          'html' => TRUE,
          )
        );
      }
      else if ($wrapper && $link['title']) {
        //Some links are actually not links, but we wrap these in <span> for adding title and class attributes
        if (!$html) {
          $link['title'] = check_plain($link['title']);
        }
        if ($wrapper) {
          $output .= '<div class="button">';
        }
        $output .= '<span class="tr">&nbsp;</span><span class="tl">&nbsp;</span><div>'. $link['title'] .'</div><span class="bl">&nbsp;</span><span class="br">&nbsp;</span>';
        if ($wrapper) {
          $output .= '</div>';
        }
      }
      $i++;
      $output .= "</li>\n";
    }
    $output .= '</ul>';
  }
  return $output;
}

function sky_feed_icon($url, $title) {
  if (!$title) {
    $title = t('Subscribe to this feed');
  }
  if ($image = theme('image', path_to_theme() .'/images/feed.png', t('Syndicate content'), $title)) {
    return '<a href="'. check_url($url) .'" class="feed-icon">'. $image .'</a>';
  }
}

/*
 * Modification of core's theme_table();
 * Added a wrapper <div> with overflow to system generated tables
 * to deal <td> contents and the fact they they will not wrap or word-break
 */
function sky_table($header, $rows, $attributes = array(), $caption = NULL) {

  // Add sticky headers, if applicable.
  if (count($header)) {
    drupal_add_js('misc/tableheader.js');
    // Add 'sticky-enabled' class to the table to identify it for JS.
    // This is needed to target tables constructed by this function.
    $attributes['class'] = empty($attributes['class']) ? 'sticky-enabled' : ($attributes['class'] .' sticky-enabled');
  }

  $output = '<div class="table-wrapper">';
  $output .= '<table'. drupal_attributes($attributes) .">\n";

  if (isset($caption)) {
    $output .= '<caption>'. $caption ."</caption>\n";
  }

  // Format the table header:
  if (count($header)) {
    $ts = tablesort_init($header);
    // HTML requires that the thead tag has tr tags in it follwed by tbody
    // tags. Using ternary operator to check and see if we have any rows.
    $output .= (count($rows) ? ' <thead><tr>' : ' <tr>');
    foreach ($header as $cell) {
      $cell = tablesort_header($cell, $header, $ts);
      $output .= _theme_table_cell($cell, TRUE);
    }
    // Using ternary operator to close the tags based on whether or not there are rows
    $output .= (count($rows) ? " </tr></thead>\n" : "</tr>\n");
  }
  else {
    $ts = array();
  }

  // Format the table rows:
  if (count($rows)) {
    $output .= "<tbody>\n";
    $flip = array('even' => 'odd', 'odd' => 'even');
    $class = 'even';
    foreach ($rows as $number => $row) {
      $attributes = array();

      // Check if we're dealing with a simple or complex row
      if (isset($row['data'])) {
        foreach ($row as $key => $value) {
          if ($key == 'data') {
            $cells = $value;
          }
          else {
            $attributes[$key] = $value;
          }
        }
      }
      else {
        $cells = $row;
      }
      if (count($cells)) {
        // Add odd/even class
        $class = $flip[$class];
        if (isset($attributes['class'])) {
          $attributes['class'] .= ' '. $class;
        }
        else {
          $attributes['class'] = $class;
        }

        // Build row
        $output .= ' <tr'. drupal_attributes($attributes) .'>';
        $i = 0;
        foreach ($cells as $cell) {
          $cell = tablesort_cell($cell, $header, $ts, $i++);
          $output .= _theme_table_cell($cell);
        }
        $output .= " </tr>\n";
      }
    }
    $output .= "</tbody>\n";
  }

  $output .= "</table>\n";
  $output .= '</div>';
  return $output;
}


/**
 * Returns the rendered local tasks. The default implementation renders
 * them as tabs.
 *
 * @ingroup themeable
 */
function sky_menu_local_tasks() {
  
  $primary = menu_primary_local_tasks();
  $secondary = menu_secondary_local_tasks();
  
  if ($primary || $secondary) {
    $output = '<div class="tab-wrapper">';
    if ($primary) {
      $output .= "\n".'<div class="tabs-primary">'."\n".
      '  <ul>'."\n". $primary .'</ul>'."\n".
      '</div>';
    }
    if ($secondary) {
      $output .= "\n".'<div class="tabs-secondary">'."\n" .
      '  <ul>'."\n". $secondary .'</ul>'."\n" .
      '</div>';
    }
    $output .= '</div>';
  }
  
  return $output;
}

/**
 * Override breadcrumb theme function to allow for customization
 */
function sky_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb) && (is_null(theme_get_setting('sky_breadcrumbs')) || (theme_get_setting('sky_breadcrumbs') != 1))) {
    // Use separator defined by theme settings
    $sky_separator = theme_get_setting('sky_breadcrumbs_sep');
    $separator =  $sky_separator ? $sky_separator : '&raquo;';
    return '<div class="breadcrumb">'. implode(' '. $separator .' ', $breadcrumb) .'</div>';
  }
}

/*
 * Gets a users online status for the forum nodes/comments
 */
function _sky_user_status($uid) {
  if ($uid > 0) {
    $time_period = variable_get('user_block_seconds_online', 600);
    $users = db_query('SELECT DISTINCT (uid), access FROM {users} WHERE access >= %d AND uid = "%s"', time() - $time_period, $uid);
    $status = db_result($users);
    if ($status) {
      return TRUE;
    }
  }
}

/*
 * Class/ID String Filter (borrowed from zen)
 */
function _sky_id_safe($string) {
  if (is_numeric($string{0})) {
    // If the first character is numeric, add 'n' in front
    $string = 'n'. $string;
  }
  return strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', $string));
}