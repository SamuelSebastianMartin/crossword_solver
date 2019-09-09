<html>
  <head>
    <title>Crossword Results</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
  </head>

  <body>
<?php
// For changing the entered  string into the regex search term,
// (and a string to display to the user).
function replaceBlanks($regex, $replacement, $letters){
        $new_string = preg_replace($regex, $replacement, $letters);
        return $new_string;
}


$letters = strtolower($_POST["searchterm"]);
$regex = '/[^a-z]/i'; // matches any non-letter in input.
$replacement = '.';

$display_pattern = replaceBlanks($regex, '.', $letters);
$search_pattern = replaceBlanks($regex, "/[a-z]", $letters);

echo "<h1  class='mono'>$display_pattern</h1>";
echo "<h3  class='mono'>$search_pattern</h3>";

// Load dictionary.
$dict = file_get_contents('/usr/share/dict/words');
if(is_null($dict)){
        echo "Dictionary is null";
}
else {
        echo "<p>Dictionary loaded</p>";
}
var_dump($search_pattern);

//search for the word in the dictionary.
if(preg_match_all($pattern, $dict, $all_matches)){
   echo "Found matches:\n";
   echo implode("\n", $all_matches[0]);
}
else{
   echo "No matches found";
}

preg_match_all($pattern, $dict, $matches);
echo count($matches);

?>

    <center></br><a href="http://localhost/php/crossword_solver/">Try another word</a></center>

  </body>
</head>
