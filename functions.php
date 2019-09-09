<?php
/**
 * This class takes an input string with letters and non-letters
 * and it replaces all the non leters with some fixed expression.
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

        public function __construct($letters)
        {
                $this->letters = strtolower($letters);
                $displayLetters = $this->setDisplayLetters();
                $searchLetters = $this->setSearchLetters();
        }


        private function setDisplayLetters()
        {

                $this->displayLetters = $this->processLetters('.');
        }


        /**
         * Returns an altered input string: all non-letter
         * characters are replaced by the same character -
         * in this case: '.'
         */
        public function getDisplayLetters()
        {
                return $this->displayLetters;
        }


        private function setSearchLetters()
        {
                $this->searchLetters = $this->processLetters('/[a-z]');
        }


        /**
         * Returns an altered input string: all non-letter
         * characters are replaced by the same regular expression
         * which will match any lowercase letter. The returned
         * sring is ready for the dictionary search.
         */
        public function getSearchLetters()
        {
                return $this->searchLetters;
        }

        /**
         * This to be deleted when testing is over. It will not
         * be needed in the final class.
         */
        public function getLetters()
                {
                        return $this->letters;
                }

        /**
         * This performs the regex substitution on the users
         * search term. It is passed the substututeString 
         * variable depending on the function it is called by
         */
        public function processLetters($substututeString)
        {
                $newString = preg_replace($this->inputRegex, $substututeString, $this->letters);
        return $newString;
}
}


$obj = new Pattern('D g');
echo $obj->getLetters() . "<br />";
echo $obj->getSearchLetters() . "<br />";
echo $obj->getDisplayLetters() . "<br />";

class DictionarySearch
{
        private $searchTerm = '';
        public $dictPath = '/usr/share/dict/words';
        public function __construct($searchTerm)
        {
                $this->searchTerm = $searchTerm;
//                $this->dict = $this->getDict();

        }

        /**
         * Load a standard Linux dictionary file.
         * Change for other systems.
         */
//        private function getDict()
//        {
//            $this->dict = file_get_contents('/usr/share/dict/words');
//            echo $this->dict;
//            if($this->dict == '')
//            {
//                    echo "Dictionary did not load";
//            }
//        }

        /**
         *
         */
        public function searchDictionary()
        {
                $dict = fopen("/usr/share/dict/words", "r");

                while(! feof($dict))
                {
                        $word = fgets($dict);
                        if(preg_match($this->searchTerm, $word))
                        {
                                echo $word;
                        }
                }
                fclose($dict);
        }

        /**
         * Temp
         */
        public function getSearchTerm()
        {
                return $this->searchTerm;
        }

}

$srch = new DictionarySearch('/\bd[a-z]g\b/');
echo var_dump($srch);
echo $srch->searchDictionary();
