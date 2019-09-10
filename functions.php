<?php
/**
 * This class takes an input string which is a representatioin
 * of an incomplete word in a crossword puzzle. The unknown
 * letters are replaced with spaces or other non-letters.
 * The class replaces all the non leters with some fixed expression.
 */
class Pattern{
    /**
     * This is the search pattern entered by the user.
     * Any characters which are not letters will be
     * taken as wild-card "blanks".
     */
    private $letters = "";

    /**
     * This is the regular expression to match any "blanks"
     * or wild-card letters which have been typed in by
     * the user. It matches any non-letter in input.
     */
    private $inputRegex = '/[^a-z]/i';

    /**
     * This is the search string as returned to the user.
     * All "blank" letters are given as ".".
     * It will be displayed in a "mono" font type.
     */
    private $displayLetters = '';

    /**
     * This is the search string with all the wild-card
     * letters replaced with a regular expression. It
     * will match any word of that form (in in lower case).
     */
    private $searchLetters = '';

    public function __construct($letters){
        $this->letters = strtolower($letters);
        $displayLetters = $this->setDisplayLetters();
        $searchLetters = $this->setSearchLetters();
    }

    private function setDisplayLetters(){
        $this->displayLetters = $this->processLetters('.');
    }

    /**
     * Returns an altered input string: all non-letter
     * characters are replaced by the same character -
     * in this case: '.'
     */
    public function getDisplayLetters(){
        return $this->displayLetters;
    }

    private function setSearchLetters(){
        $this->searchLetters = $this->processLetters('\w');
        $this->searchLetters = "/\b". $this->searchLetters. "\b/";
    }

    /**
     * Returns an altered input string: all non-letter
     * characters are replaced by the same regular expression
     * which will match any lowercase letter. The returned
     * sring is ready for the dictionary search.
     */
    public function getSearchLetters(){
        return $this->searchLetters;
    }

    /**
     * This to be deleted when testing is over. It will not
     * be needed in the final class.
     */
    public function getLetters(){
        return $this->letters;
    }

    /**
     * This performs the regex substitution on the users
     * search term. It is passed the substututeString 
     * variable depending on the function it is called by
     */
    public function processLetters($substututeString){
        $newString = preg_replace($this->inputRegex, $substututeString, $this->letters);
        return $newString;
    }
}

/**
 * This class takes a regular expression and searches the dictionary
 * for words that match.
 * Matching words are returned in an array, reachable by using the
 * searchResults property.
 */
class DictionarySearch{
    private $searchTerm = '';
    public $searchResults = [];
    public function __construct($searchTerm){
        $this->searchTerm = $searchTerm;
    }

    /**
     * This loads the default linux dictionary, and checks each
     * word for a match with the $searchterm.
     */
    public function searchDictionary(){
        $dict = fopen("/usr/share/dict/words", "r");
        while(! feof($dict)){
            $word = fgets($dict);
            if(preg_match($this->searchTerm, $word)){
                $this->searchResults[] = $word;
            }
        }
        if(count($this->searchResults) == 0){
            $this->searchResults[0] = "No Results Were Found";
        }
        fclose($dict);
    }

    /**
     * Temp
     */
    public function getSearchTerm(){
        return $this->searchTerm;
    }
}

//$obj = new Pattern('D g');
//echo $obj->getLetters() . "<br />";
//echo $obj->getSearchLetters() . "<br />";
//$search_string = $obj->getSearchLetters();
//echo $obj->getDisplayLetters() . "<br />";
//
//$srch = new DictionarySearch($search_string);
////echo var_dump($srch);
//$srch->searchDictionary();
//echo '<pre>'; print_r($srch->searchResults); echo '</pre>';
