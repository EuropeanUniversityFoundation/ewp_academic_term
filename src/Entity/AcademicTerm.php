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
 *     "label" = "label",
 *     "uuid" = "uuid",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/ewp/academic_term/{academic_term}",
 *     "add-form" = "/ewp/academic_term/add",
 *     "edit-form" = "/ewp/academic_term/{academic_term}/edit",
 *     "delete-form" = "/ewp/academic_term/{academic_term}/delete",
 *     "collection" = "/admin/ewp/academic_term/list",
 *   },
 *   field_ui_base_route = "academic_term.settings",
 *   common_reference_target = TRUE,
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
        'max_length' => 255,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'hidden',
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

    $fields['academic_year_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Academic Year ID'))
      ->setDescription(t('A global identifier of an academic year.<br />Example: 2010/2011'))
      ->setSettings([
        'max_length' => 9,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -19,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -19,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setPropertyConstraints('value', [
        'Regex' => [
          'pattern' => '/[0-9]{4}\/[0-9]{4}/',
          'message' => 'Allowed format is 2010/2011',
        ],
      ])
      ->setRequired(TRUE);

    $fields['ewp_academic_term_id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('EWP Academic Term ID'))
      ->setDescription(t('Format as AcademicYearId-TermNumber/NumberOfTerms.<br />Example: 2010/2011-1/2'))
      ->setSettings([
        'max_length' => 13,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -18,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -18,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE)
      ->setPropertyConstraints('value', [
        'Regex' => [
          'pattern' => '/[0-9]{4}\/[0-9]{4}\-[1-9]\/[1-9]/',
          'message' => 'Allowed format is 2010/2011-1/2',
        ],
      ]);

    /** @disregard P1013 */
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
