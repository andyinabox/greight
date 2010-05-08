<?php
/**
 * The Wordnik class is an API wrapper based on the sample PHP code provided by Wordnik.
 *
 * @TODO Implement the following additional elements of the API:
 * 		PHRASES
 * 
 */
class Wordnik {
	
	//A default API key could be set here rather than after instantiaion:
	private $api_key;
	
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
	 * Pass in a word as a string.  The second parameter triggers the suggester, defaulting to false.
	 * Returns an array of definitions.
	 * 
	 * @TODO implement partOfSpeech filter, count
	 *
	 * @param String $word
	 * @param Boolean $useSuggest
	 * @return Array
	 */
	public function getDefinitions($word, $useSuggest = null, $partOfSpeech = null, $count = null) {
		if(is_null($word) || trim($word) == '') {
			throw new InvalidParameterException("getDefinitions expects word to be a string");
		}
		
		$suggest = $useSuggest ? "useSuggest=true" : "";
		
		//$pos = $partOfSpeech ? "partOfSpeech=" : "";
		
		return $this->curlData( '/word.json/' . rawurlencode($word) . '/definitions?' . $suggest);
	}
	
	/**
	 * Pass in a word as a string, get back an array of related words.
	 *
	 * @param String $word
	 * @return Array
	 */
	public function getRelatedWords($word) {
		if(is_null($word) || trim($word) == '') {
			throw new InvalidParameterException("getRelatedWords expects word to be a string");
		}
		
		return $this->curlData( '/word.json/' . rawurlencode($word) . '/related' );
	}
	
	/**
	 * Pass in a word as a string, get back an array of example sentences.
	 *
	 * @param String $word
	 * @return Array
	 */
	public function getExamples($word) {
		if(is_null($word) || trim($word) == '') {
			throw new InvalidParameterException("getExamples expects word to be a string");
		}
		
		return $this->curlData( '/word.json/' . rawurlencode($word) . '/examples' );
	}
	
	/**
	 * Returns the Word of the Day
	 *
	 * @return Array
	 */
	public function getWordOfTheDay() {
		return $this->curlData( '/wordoftheday.json/' );
	}
	
	/**
	 * Get a random word.
	 *
	 * @return Array
	 */
	public function getRandomWord() {
		return $this->curlData( '/words.json/randomWord' );
	}
	
	
	
	/**
	 * Utility method to call json apis.
	 *
	 * @param String unknown_type $uri
	 * @return Array
	 */
	private function curlData($uri) {
		$data = null;
		
		$header = array();
		$header[] = "Accept: application/json";
		$header[] = "api_key: " . $this->api_key;

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
		$this->api_key = $key;
	}
	
}
?>