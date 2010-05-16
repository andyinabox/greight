<?php
/**
 * The Wordnik class is a basic wrapper for the Wordnik API.
 * 
 * Methods of the Wordnik class can be used to return nicely formatted portions of the Wordnik response.
 * 
 * If you want to access the responses directly, use the getRaw* methods.
 *
 * @TODO Implement the following additional elements of the API:
 * 		PHRASES
 * 
 */
class Wordnik {
	
	//A default API key could be set here rather than after instantiaion:
	private static $api_key = "f34852f706df0a099570c0638cf0fca4525738e2dd93a8673";
	
	const BASE_URI = 'http://api.wordnik.com/api';
	
	/** If there's an existing Wordnik instance, return it, otherwise create and return a new one. */
	private static $instance;
	
	public static function instance() {
		if (self::$instance == NULL) {
			self::$instance = new Wordnik();
		}
		
		return self::$instance;
	}
	
	/**
	 * Pass in a word as a string, returns raw Wordnik response as an object.
	 * 
	 * @TODO implement useSuggest, partOfSpeech filter, count
	 *
	 * @param String $word
	 * @param Boolean $useSuggest
	 * @return Array
	 */
	public static function getRawDefinitions($word, $useSuggest = null, $partOfSpeech = null, $count = null) {
		if(is_null($word) || trim($word) == '') {
			throw new InvalidParameterException("getDefinitions expects word to be a string");
		}
		return self::curlData( '/word.json/' . rawurlencode($word) . '/definitions');
	}
	
	/**
	 * Pass in a word as a string, get back an array of related words.
	 *
	 * @param String $word
	 * @return Array
	 */
	public static function getRawRelatedWords($word) {
		if(is_null($word) || trim($word) == '') {
			throw new InvalidParameterException("getRelatedWords expects word to be a string");
		}
		return self::curlData( '/word.json/' . rawurlencode($word) . '/related' );
	}
	
	/**
	 * Pass in a word as a string, get back an array of example sentences.
	 *
	 * @param String $word
	 * @return Array
	 */
	public static function getRawExamples($word) {
		if(is_null($word) || trim($word) == '') {
			throw new InvalidParameterException("getExamples expects word to be a string");
		}
		
		return self::curlData( '/word.json/' . rawurlencode($word) . '/examples' );
	}
	
	/**
	 * Returns the Word of the Day
	 *
	 * @return Array
	 */
	public static function getRawWordOfTheDay() {
		return self::curlData( '/wordoftheday.json/' );
	}
	
	/**
	 * Get a random word.
	 *
	 * @return Array
	 */
	public static function getRawRandomWord() {
		return self::curlData( '/words.json/randomWord' );
	}
	
	/**
	 * Static method takes a word and returns all definitions as an array of strings.
	 *
	 * @param String $word
	 * @return Array
	 */
	public static function getAllDefinitions($word) {
		$defsObj = self::getRawDefinitions($word);
		$defsAry = array();
		if($defsObj) {
			foreach ($defsObj as $definition) {
				if(isset($definition->text)) {
					array_push($defsAry, $definition->text);
				}
			}
		}
		return $defsAry;
	}

	/**
	 * Static method takes a word and returns only the first definition.
	 *
	 * @param String $word
	 * @return String
	 */
	public static function getFirstDefinition($word) {
		$defsObj = self::getRawDefinitions($word);
		return $defsObj[0]->text;
	}
	
	/**
	 * Static method taking a word and returning an array of all associated examples.
	 *
	 * @param String $word
	 * @return Array
	 */
	public static function getAllExamples($word) {
		$examplesObj = self::getRawExamples($word);
		$examplesAry = array();
		if($examplesObj) {
			foreach($examplesObj as $example) {
				array_push($examplesAry, $example->display);
			}
		}
		return $examplesAry;
	}
	
	/**
	 * Static method taking a word and returning the first example
	 *
	 * @param String $word
	 * @return Array
	 */
	public static function getFirstExample($word) {
		$examplesObj = self::getRawExamples($word);
		return $examplesObj[0]->display;
	}
	/**
	 * Static method taking a word and returning an array of related words.  Returns false if no
	 * related words are found.
	 *
	 * @param String $word
	 * @return Array, False
	 */
	public static function getAllRelatedWords($word) {
		$relatedObj = self::getRawRelatedWords($word);
		$relatedAry = array();
		if($relatedObj) {
			foreach($relatedObj[0]->wordstrings as $word) {
				array_push($relatedAry, $word);
			}
		}
		return $relatedAry ? $relatedAry : false;
	}
	
	public static function getPartOfSpeech($word) {
		$defsObj = self::getRawDefinitions($word);
		if(isset($defsObj[0]->partOfSpeech)) {
			return $defsObj[0]->partOfSpeech;
		}
		return false;
	}
	
	public static function getWordObject($headword) {
		//JSON Word Prototype:
		// {"headword":"word", "definitions":{"0":"def1", "1":"def2"}, "examples":{"0":"exp1", "1":"exp2"}, "related":{"0":"rel1", "1":"rel2"}}
		$word = array();
		$word["headword"] = $headword;
		$word["partOfSpeech"] = self::getPartOfSpeech($headword);
		$word["definitions"] = array();
		
		foreach(self::getAllDefinitions($headword) as $definition) {
			array_push($word["definitions"], $definition);
		}
		$word["examples"] = array();
		foreach(self::getAllExamples($headword) as $example) {
			array_push($word["examples"], $example);
		}
		$word["related"] = array();
		if(self::getAllRelatedWords($headword)){
			foreach(self::getAllRelatedWords($headword) as $related) {
				array_push($word["related"], $related);
			}
		}
		return json_encode($word);
	}
	
	/**
	 * Utility method to call json apis.
	 *
	 * @param String unknown_type $uri
	 * @return Array
	 */
	private static function curlData($uri) {
		$data = null;
		
		$header = array();
		$header[] = "Accept: application/json";
		$header[] = "api_key: " . self::$api_key;

		$curl = curl_init();
		curl_setopt($curl, CURLOPT_TIMEOUT, 5); // 5 second timeout
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // return the result on success, rather than just TRUE
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
		curl_setopt ($curl, CURLOPT_URL, self::BASE_URI . $uri);
		
		$response = curl_exec($curl);
		$response_info = curl_getinfo($curl);
		
		if ($response_info['http_code'] == 0) {
			throw new Exception( "TIMEOUT: curlData Api call to " . $uri . " took more than 5s to return" );
		} else if ($response_info['http_code'] == 200) {
			$data = json_decode($response);
		} else if ($response_info['http_code'] == 404) {
			$data = null;
		} else {
			throw new Exception("Can't connect to the api: " . $uri . " response code: " . $response_info['http_code']);
		}

		return $data;
	}
	
	
	
	//**********//  GETTERS/SETTERS  //**********//
	
	/**
	 * Set the API key for this Wordnik instance
	 *
	 * @param String $key
	 */
	public function setApiKey($key) {
		self::$api_key = $key;
	}
	
}
?>