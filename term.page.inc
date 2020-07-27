<?php

/**
 * @file
 * Contains term.page.inc.
 *
 * Page callback for Academic term entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Academic term templates.
 *
 * Default template: term.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_term(array &$variables) {
  // Fetch AcademicTerm Entity Object.
  $term = $variables['elements']['#term'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
