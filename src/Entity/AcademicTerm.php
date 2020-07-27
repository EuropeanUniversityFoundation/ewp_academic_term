<?php

namespace Drupal\ewp_academic_term\Entity;

use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;

/**
 * Defines the Academic term entity.
 *
 * @ingroup ewp_academic_term
 *
 * @ContentEntityType(
 *   id = "academic_term",
 *   label = @Translation("Academic Term"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\ewp_academic_term\AcademicTermListBuilder",
 *     "views_data" = "Drupal\ewp_academic_term\Entity\AcademicTermViewsData",
 *
 *     "form" = {
 *       "default" = "Drupal\ewp_academic_term\Form\AcademicTermForm",
 *       "add" = "Drupal\ewp_academic_term\Form\AcademicTermForm",
 *       "edit" = "Drupal\ewp_academic_term\Form\AcademicTermForm",
 *       "delete" = "Drupal\ewp_academic_term\Form\AcademicTermDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\ewp_academic_term\AcademicTermHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\ewp_academic_term\AcademicTermAccessControlHandler",
 *   },
 *   base_table = "academic_term",
 *   translatable = FALSE,
 *   admin_permission = "administer academic term entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/ewp/academic_term/{academic_term}",
 *     "add-form" = "/admin/ewp/academic_term/add",
 *     "edit-form" = "/admin/ewp/academic_term/{academic_term}/edit",
 *     "delete-form" = "/admin/ewp/academic_term/{academic_term}/delete",
 *     "collection" = "/admin/ewp/academic_term/list",
 *   },
 *   field_ui_base_route = "academic_term.settings"
 * )
 */
class AcademicTerm extends ContentEntityBase implements AcademicTermInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('label')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('label', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['label'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Label'))
      ->setDescription(t('The internal label of the Academic Term entity.'))
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -20,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['status']
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => 20,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
