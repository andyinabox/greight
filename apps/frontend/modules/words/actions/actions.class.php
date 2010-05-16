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
  
  /**
   * Returns a bunch of raw data about the word.
   *
   * EG:
   * [base_path]/frontend_dev.php/words/wordnik?word=computer
   * 
   * @param sfWebRequest $request
   */
  public function executeWordnik(sfWebRequest $request)
  {
  	$dictionary = new Wordnik();
  	$word = $request->getGetParameter("word");
  	$this->definitions = $dictionary->getRawDefinitions($word, true);
  	$this->related = $dictionary->getRawRelatedWords($word);
  	$this->examples = $dictionary->getRawExamples($word);
  	$this->wotd = $dictionary->getRawWordOfTheDay();
  	$this->random = $dictionary->getRawRandomWord();
  	$this->defsArray = Wordnik::getAllDefinitions($word);
  	$this->firstDef = Wordnik::getFirstDefinition($word);
  }
  
  /**
   * returns an example with the word in question removed
   *
   * EG:
   * [base_path]/frontend_dev.php/words/hint?word=computer
   * 
   * @param sfWebRequest $request
   */
  public function executeHint(sfWebRequest $request) {
  	$word = $request->getGetParameter("word");
  	$firstExample = Wordnik::getFirstExample($word);
  	$hint = str_replace($word, "_____________", $firstExample);
  	$this->hint = $hint;
  	//$this->examples = Wordnik::getAllExamples("gree");
  }
  
  /**
   * returns a related word, if one is found
   *
   * EG:
   * [base_path]/frontend_dev.php/words/relatedHint?word=computer
   * 
   * @param sfWebRequest $request
   */
  public function executeRelatedHint(sfWebRequest $request) {
  	$word = $request->getGetParameter("word");
  	$relatedAry = Wordnik::getAllRelatedWords($word);
  	if(!$relatedAry) {
  		$relatedAry[0] = "Sorry, no hint available!";
  	}
	$this->related = $relatedAry;
  }
  
  /**
   * returns a json response containing all the info on specified word
   * 
   * EG:
   * [base_path]/frontend_dev.php/words/json?word=computer
   *
   * @param sfWebRequest $request
   */
  public function executeJson(sfWebRequest $request) {
  	$headword = $request->getGetParameter("word");
  	$this->wordJSON = Wordnik::getWordObject($headword);  	
  }
  
  /**
   * returns the part of speech for specified word
   * 
   * EG:
   * [base_path]/frontend_dev.php/words/pos?word=computer
   *
   * @param sfWebRequest $request
   */
  public function executePos(sfWebRequest $request) {
  	$headword = $request->getGetParameter("word");
  	$this->pos = Wordnik::getPartOfSpeech($headword);  	
  }
}
