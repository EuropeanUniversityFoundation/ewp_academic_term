<?php

namespace Drupal\ewp_academic_term;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Academic term entities.
 *
 * @ingroup ewp_academic_term
 */
class AcademicTermListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Academic Term ID');
    $header['label'] = $this->t('Label');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var \Drupal\ewp_academic_term\Entity\AcademicTerm $entity */
    $row['id'] = $entity->id();
    $row['label'] = Link::createFromRoute(
      $entity->label(),
      'entity.academic_term.edit_form',
      ['academic_term' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
