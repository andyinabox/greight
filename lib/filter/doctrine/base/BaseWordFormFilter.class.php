<?php

/**
 * Word filter form base class.
 *
 * @package    greight
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseWordFormFilter extends sfWordnikWordFormFilter
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['wordlist_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Wordlist'), 'add_empty' => true));
    $this->validatorSchema['wordlist_id'] = new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Wordlist'), 'column' => 'id'));

    $this->widgetSchema->setNameFormat('word_filters[%s]');
  }

  public function getModelName()
  {
    return 'Word';
  }

  public function getFields()
  {
    return array_merge(parent::getFields(), array(
      'wordlist_id' => 'ForeignKey',
    ));
  }
}
