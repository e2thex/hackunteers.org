<?php
// $Id: term_from_node.inc,v 1.1 2008/12/04 22:22:41 merlinofchaos Exp $

/**
 * @file
 *
 * Plugin to provide an relationship handler for term from node
 */

/**
 * Implementation of specially named hook_ctools_relationships().
 */
function ctools_term_from_node_ctools_relationships() {
  $args['term_from_node'] = array(
    'title' => t("Term from node"),
    'keyword' => 'term',
    'description' => t('Adds a taxonomy term from a node context; if multiple terms are selected, this will get the "first" term only.'),
    'required context' => new ctools_context_required(t('Node'), 'node'),
    'context' => 'ctools_term_from_node_context',
    'settings form' => 'ctools_term_from_node_settings_form',
    'settings form validate' => 'ctools_term_from_node_settings_form_validate',
  );
  return $args;
}

/**
 * Return a new context based on an existing context
 */
function ctools_term_from_node_context($context = NULL, $conf) {
  // If unset it wants a generic, unfilled context, which is just NULL
  if (empty($context->data)) {
    return ctools_context_create_empty('term', NULL);
  }

  if (isset($context->data->taxonomy)) {
    foreach ($context->data->taxonomy as $term) {
      if ($term->vid == $conf['vid']) {
        return ctools_context_create('term', $term);
      }
    }
  }
}

/**
 * Settings form for the relationship
 */
function ctools_term_from_node_settings_form($conf) {
  $options = array();
  foreach (taxonomy_get_vocabularies() as $vid => $vocabulary) {
    $options[$vid] = $vocabulary->name;
  }
  $form['vid'] = array(
    '#title' => t('Vocabulary'),
    '#type' => 'select',
    '#options' => $options,
    '#default_value' => $conf['vid'],
    '#prefix' => '<div class="clear-block">',
    '#suffix' => '</div>',
  );

  return $form;
}

