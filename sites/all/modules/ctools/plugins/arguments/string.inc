<?php
// $Id: string.inc,v 1.1 2009/02/04 22:32:34 merlinofchaos Exp $

/**
 * @file
 *
 * Plugin to provide an argument handler for a raw string
 */

/**
 * Implementation of specially named hook_ctools_arguments().
 */
function ctools_string_ctools_arguments() {
  $args['string'] = array(
    'title' => t("String"),
    // keyword to use for %substitution
    'keyword' => 'string',
    'description' => t('A string is a minimal context that simply holds a string that can be used for some other purpose.'),
    'context' => 'ctools_string_context',
  );
  return $args;
}

/**
 * Discover if this argument gives us the term we crave.
 */
function ctools_string_context($arg = NULL, $conf = NULL, $empty = FALSE) {
  // If unset it wants a generic, unfilled context.
  if ($empty) {
    return ctools_context_create_empty('string');
  }

  $string = ctools_break_phrase($arg);
  if (empty($string->value) || !empty($string->invalid_input)) {
    return FALSE;
  }

  $context = ctools_context_create('string', $string);
  $context->original_argument = $arg;
  return $context;
}
