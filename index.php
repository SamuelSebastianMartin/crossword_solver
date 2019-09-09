<!DOCTYPE html>

<!-- Taken initially from: https://codepen.io/colorlib/pen/rxddKy -->

<html>
  <head>
    <title>Test Form Action
    </title>

    <link rel="stylesheet" type="text/css" href="stylesheet.css"/>

  </head>

  <body>

    <div class="search-input">
      <div class="form" action="return_results.php" method="post">
        <form class="login-form" action="return_results.php" method="post"/>
          <input name="searchterm" type="text" placeholder="Type letters here"/>
          <button>Search</button>
          <p class="message">Type the letters into the space, above.</p>
          <p class="message">Use a space or non-letter for those letters you do not have</p>
          <p class="message">For example</p>
          <p class="example">b n na</p>
          <p class="example">.an.na</p>
          <p class="example">.a ?!a</p>
          <p class="message">...would all find the word</p>
          <p class="example">banana</p>
        </form>
      </div>
    </div>
  </body>
</html>
