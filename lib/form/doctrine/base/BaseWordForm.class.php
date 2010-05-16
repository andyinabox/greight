<?php

/**
 * Word form base class.
 *
 * @method Word getObject() Returns the current form's model object
 *
 * @package    greight
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedInheritanceTemplate.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseWordForm extends sfWordnikWordForm
{
  protected function setupInheritance()
  {
    parent::setupInheritance();

    $this->widgetSchema   ['wordlist_id'] = new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Wordlist'), 'add_empty' => true));
    $this->validatorSchema['wordlist_id'] = new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Wordlist'), 'required' => false));

    $this->widgetSchema->setNameFormat('word[%s]');
  }

  public function getModelName()
  {
    return 'Word';
  }

}
