<?php

/**
 * words actions.
 *
 * @package    greight
 * @subpackage words
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class wordsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }
  
  public function executeView(sfWebRequest $request)
  {

  }
  
  public function executeWordnik(sfWebRequest $request)
  {
  	$dictionary = new Wordnik();
  	$dictionary->setApiKey("14d7a963042b8069ad908049a8e0aa6da6165d467a3475747");
  	$word = "test";
  	$this->definitions = $dictionary->getDefinitions($word, true);
  	$this->related = $dictionary->getRelatedWords($word);
  	$this->examples = $dictionary->getExamples($word);
  	$this->wotd = $dictionary->getWordOfTheDay();
  	$this->random = $dictionary->getRandomWord();
  }
}
