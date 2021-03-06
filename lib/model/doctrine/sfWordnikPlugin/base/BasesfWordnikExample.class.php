<?php

/**
 * BasesfWordnikExample
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $id
 * @property integer $sf_wordnik_word_id
 * @property string $text
 * @property sfWordnikWord $sfWordnikWord
 * 
 * @method integer          getId()                 Returns the current record's "id" value
 * @method integer          getSfWordnikWordId()    Returns the current record's "sf_wordnik_word_id" value
 * @method string           getText()               Returns the current record's "text" value
 * @method sfWordnikWord    getSfWordnikWord()      Returns the current record's "sfWordnikWord" value
 * @method sfWordnikExample setId()                 Sets the current record's "id" value
 * @method sfWordnikExample setSfWordnikWordId()    Sets the current record's "sf_wordnik_word_id" value
 * @method sfWordnikExample setText()               Sets the current record's "text" value
 * @method sfWordnikExample setSfWordnikWord()      Sets the current record's "sfWordnikWord" value
 * 
 * @package    greight
 * @subpackage model
 * @author     Your name here
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfWordnikExample extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_wordnik_example');
        $this->hasColumn('id', 'integer', 4, array(
             'type' => 'integer',
             'primary' => true,
             'autoincrement' => true,
             'length' => 4,
             ));
        $this->hasColumn('sf_wordnik_word_id', 'integer', 4, array(
             'type' => 'integer',
             'length' => 4,
             ));
        $this->hasColumn('text', 'string', null, array(
             'type' => 'string',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfWordnikWord', array(
             'local' => 'sf_wordnik_word_id',
             'foreign' => 'id'));
    }
}