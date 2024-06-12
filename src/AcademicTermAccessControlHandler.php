<?php

namespace Drupal\ewp_academic_term;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Academic term entity.
 *
 * @see \Drupal\ewp_academic_term\Entity\AcademicTerm.
 */
class AcademicTermAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\ewp_academic_term\Entity\AcademicTermInterface $entity */

    switch ($operation) {

      case 'view':

        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished academic term entities');
        }

        return AccessResult::allowedIfHasPermission($account, 'view published academic term entities');

      case 'update':

        return AccessResult::allowedIfHasPermission($account, 'edit academic term entities');

      case 'delete':

        return AccessResult::allowedIfHasPermission($account, 'delete academic term entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add academic term entities');
  }

}
