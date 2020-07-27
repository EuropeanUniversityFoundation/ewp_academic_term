<?php

namespace Drupal\ewp_academic_term\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;

/**
 * Provides an interface for defining Academic term entities.
 *
 * @ingroup ewp_academic_term
 */
interface AcademicTermInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Academic term name.
   *
   * @return string
   *   Name of the Academic term.
   */
  public function getName();

  /**
   * Sets the Academic term name.
   *
   * @param string $name
   *   The Academic term name.
   *
   * @return \Drupal\ewp_academic_term\Entity\AcademicTermInterface
   *   The called Academic term entity.
   */
  public function setName($name);

  /**
   * Gets the Academic term creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Academic term.
   */
  public function getCreatedTime();

  /**
   * Sets the Academic term creation timestamp.
   *
   * @param int $timestamp
   *   The Academic term creation timestamp.
   *
   * @return \Drupal\ewp_academic_term\Entity\AcademicTermInterface
   *   The called Academic term entity.
   */
  public function setCreatedTime($timestamp);

}
