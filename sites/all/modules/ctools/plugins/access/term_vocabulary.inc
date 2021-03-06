<?php
// $Id: term_vocabulary.inc,v 1.1 2009/02/04 22:32:34 merlinofchaos Exp $

/**
 * @file
 * Plugin to provide access control based upon term vocabulary
 */

/**
 * Implementation of specially named hook_ctools_arguments().
 */
function ctools_term_vocabulary_ctools_access() {
  $args['term_vocabulary'] = array(
    'title' => t("Term access by vocabulary"),
    'description' => t('Control access by term vocabulary.'),
    'callback' => 'ctools_term_vocabulary_ctools_access_check',
    'default' => array('vids' => array()),
    'settings form' => 'ctools_term_vocabulary_ctools_access_settings',
    'settings form submit' => 'ctools_term_vocabulary_ctools_access_settings_submit',
    'summary' => 'ctools_term_vocabulary_ctools_acesss_summary',
    'required context' => new ctools_context_required(t('Term'), array('term', 'terms')),
  );

  return $args;
}

/**
 * Settings form for the 'by term_vocabulary' access plugin
 */
function ctools_term_vocabulary_ctools_access_settings(&$form, &$form_state, $conf) {
  $options = array();
  $vocabularies = taxonomy_get_vocabularies();
  foreach ($vocabularies as $voc) {
    $options[$voc->vid] = check_plain($voc->name);
  }

  $form['settings']['vids'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Vocabularies'),
    '#options' => $options,
    '#description' => t('Only terms in the checked vocabularies will be valid.'),
    '#default_value' => $conf['vids'],
  );
}

/**
 * Compress the term_vocabularys allowed to the minimum.
 */
function ctools_term_vocabulary_ctools_access_settings_submit(&$form, &$form_state) {
  $form_state['values']['settings']['vids'] = array_filter($form_state['values']['settings']['vids']);
}

/**
 * Check for access.
 */
function ctools_term_vocabulary_ctools_access_check($conf, $context) {
  // As far as I know there should always be a context at this point, but this
  // is safe.
  if (empty($context) || empty($context->data) || empty($context->data->vid)) {
    return FALSE;
  }

  if (array_filter($conf['vids']) && empty($conf['vids'][$context->data->vid])) {
    return FALSE;
  }

  return TRUE;
}

/**
 * Provide a summary description based upon the checked term_vocabularys.
 */
function ctools_term_vocabulary_ctools_acesss_summary($conf, $context) {
  if (!isset($conf['type'])) {
    $conf['type'] = array();
  }
  $vocabularies = taxonomy_get_vocabularies();

  $names = array();
  foreach (array_filter($conf['vids']) as $vid) {
    $names[] = check_plain($vocabularies[$vid]->name);
  }

  if (empty($names)) {
    return t('@identifier can be any vocabulary', array('@identifier' => $context->identifier));
  }

  return format_plural(count($names), '@identifier can be vocabulary "@vids"', '@identifier can be vocabulary "@vids"', array('@vids' => implode(', ', $names), '@identifier' => $context->identifier));
}

