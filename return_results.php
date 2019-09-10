<html>
  <head>
    <title>Crossword Results</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>
  </head>

  <body>
    <div class="search-input">
<?php
    require_once('functions.php'); // the 2 classes used.

    $letters = strtolower($_POST["searchterm"]); // input from form.
    $pattern = new Pattern($letters); // process input: class.
    $display_pattern = $pattern->getDisplayLetters(); // to display to user.
    $search_pattern = $pattern->getSearchLetters();  // to use for searching.

    echo "<h3>Searching for:</h3>";
?>

      <div id="word pattern" class="form" style="height: 30; padding: 10;">
<?php
    echo "<h3>$display_pattern</h3>";
?>
      </div>
<?php
    //search for the word in the dictionary.
    $dicSearch = new DictionarySearch($search_pattern);
    $dicSearch->searchDictionary();
    $searchResults = $dicSearch->searchResults;
?>

      <div id="display results" class="form" style="text-align: left; padding: 10;">
<?php
    //display results
    for($x = 0; $x < count($searchResults); $x++) {
        echo $searchResults[$x];
        echo "<br>";
    }
?>
      </div>

    <center></br><a href="http://localhost/php/crossword_solver/">Try another word</a></center>

    </div>
  </body>
</head>
