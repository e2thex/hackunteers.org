<?php
// $Id: string.inc,v 1.1 2009/02/04 22:32:34 merlinofchaos Exp $


/**
 * @file
 *
 * Plugin to provide a string context
 */

/**
 * Implementation of specially named hook_ctools_contexts().
 */
function ctools_string_ctools_contexts() {
  $args['string'] = array(
    'title' => t('String'),
    'description' => t('A context that is just a string.'),
    'context' => 'ctools_context_create_string',
    'keyword' => 'string',
    'no ui' => TRUE,
    'context name' => 'string',
  );
  return $args;
}

/**
 * It's important to remember that $conf is optional here, because contexts
 * are not always created from the UI.
 */
function ctools_context_create_string($empty, $data = NULL, $conf = FALSE) {
  // The input is expected to be an object as created by ctools_break_phrase
  // which contains a group of string.

  $context = new ctools_context('string');
  $context->plugin = 'string';

  if ($empty) {
    return $context;
  }

  if (!empty($data) && is_object($data)) {
    $context->data = $data;
    return $context;
  }
}
