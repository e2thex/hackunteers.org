<?php
// $Id: node_edit.inc,v 1.4 2009/01/29 22:12:05 merlinofchaos Exp $

/**
 * @file
 *
 * Plugin to provide an argument handler for a Node edit form
 */

/**
 * Implementation of specially named hook_ctools_arguments().
 */
function ctools_node_edit_ctools_arguments() {
  $args['node_edit'] = array(
    'title' => t("Node edit form"),
    // keyword to use for %substitution
    'keyword' => 'node',
    'description' => t('Creates a node edit form context from a node ID argument.'),
    'context' => 'ctools_node_edit_context',
  );
  return $args;
}

/**
 * Discover if this argument gives us the node we crave.
 */
function ctools_node_edit_context($arg = NULL, $conf = NULL, $empty = FALSE) {
  // If unset it wants a generic, unfilled context.
  if ($empty) {
    return ctools_context_create_empty('node_edit_form');
  }

  // We can accept either a node object or a pure nid.
  if (is_object($arg)) {
    return ctools_context_create('node_edit_form', $arg);
  }

  if (!is_numeric($arg)) {
    return FALSE;
  }

  $node = node_load($arg);
  if (!$node) {
    return NULL;
  }

  // This will perform a node_access check, so we don't have to.
  return ctools_context_create('node_edit_form', $node);
}

