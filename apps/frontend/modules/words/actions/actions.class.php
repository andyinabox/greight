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
		// NOTE -- changed this from `getGetParameter` to `getParameter.`
		// The former wasn't working for some reason, $word was coming up empty
		// andyinabox - 2010-05-20
  	$word = $request->getParameter('word');
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
  	// NOTE -- changed this from `getGetParameter` to `getParameter.`
		// The former wasn't working for some reason, $word was coming up empty
		// andyinabox - 2010-05-20
  	$word = $request->getParameter('word');
  	$firstExample = Wordnik::getFirstExample($word);
  	$hint = str_replace($word, "_____________", $firstExample);
		$this->logMessage($hint);
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
  	// NOTE -- changed this from `getGetParameter` to `getParameter.`
		// The former wasn't working for some reason, $word was coming up empty
		// andyinabox - 2010-05-20
  	$word = $request->getParameter('word');
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
  	// NOTE -- changed this from `getGetParameter` to `getParameter.`
		// The former wasn't working for some reason, $headword was coming up empty
		// andyinabox - 2010-05-20
  	$headword = $request->getParameter("word");
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
  	// NOTE -- changed this from `getGetParameter` to `getParameter.`
		// The former wasn't working for some reason, $headword was coming up empty
		// andyinabox - 2010-05-20
  	$headword = $request->getParameter("word");
  	$this->pos = Wordnik::getPartOfSpeech($headword);  	
  }
  
  /**
   * An example of how to populate a new sfWordnikWord object using it's populate method.
   *
   * @param sfWebRequest $request
   */
  public function executeNewWord(sfWebRequest $request) {
  	$word = new sfWordnikWord();
  	// NOTE -- changed this from `getGetParameter` to `getParameter.` (andyinabox - 2010-05-20)
  	$word->populate(Wordnik::getWordObject($request->getParameter("word")));
//  	$word->name = $request->getGetParameter("word");
//  	$word->Definitions[]->text = "To see if something works.";
//  	$word->Examples[]->text = "Let's test this motor, see if it works.'";
//  	$word->RelatedWords[]->text = "try";
	$word->save();
    $this->success = "Awesome.";
  }
}
