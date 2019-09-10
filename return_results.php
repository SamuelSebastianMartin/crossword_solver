<html>
  <head>
    <title>Crossword Results</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
  </head>

  <body>
<?php
require_once('functions.php');


$letters = strtolower($_POST["searchterm"]);

$pattern = new Pattern($letters);

$display_pattern = $pattern->getDisplayLetters();
$search_pattern = $pattern->getSearchLetters();

echo "<h1>Searching for:<br /><span class='mono'>$display_pattern</span></h1>";


//search for the word in the dictionary.
$dicSearch = new DictionarySearch($search_pattern);
$dicSearch->searchDictionary();
$searchResults = $dicSearch->searchResults;

//display results

echo '<pre>'; print_r($searchResults); echo '</pre>';

?>

    <center></br><a href="http://localhost/php/crossword_solver/">Try another word</a></center>

  </body>
</head>
