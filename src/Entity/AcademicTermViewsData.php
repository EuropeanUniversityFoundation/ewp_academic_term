<?php

namespace Drupal\ewp_academic_term\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Academic term entities.
 */
class AcademicTermViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.
    return $data;
  }

}
