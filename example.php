<?php

require "ColoredWords.php";

use Freshbrewedweb\ColoredWords;

$word = $_GET['word'] ?? NULL;

try {
  $color = new ColoredWords( $word );
  $converted = $color->convert();
} catch( Exception $e ) {
  $error = $e->getMessage();
}

?>
<!DOCTYPE html>
<html>
  <head>
    <style>
      body {
        background-color: <?= $word ? $converted->hex() : 'white' ?>;
      }
      input {
        padding: 0.5em 1em;
        box-sizing: border-box;
      }
      button {
        background: black;
        color: white;
        border: none;
      }
    </style>
  </head>
  <body>
    <form style="width:90%; max-width:400px;margin:3em auto;">
      <div style="display:flex;">
        <input type="text" name="word" value="<?= $word ?>" style="flex: 1 0 auto">
        <button type="submit" style="flex: 1 0 auto">Convert</button>
      </div>
      <?php if( isset($error) ): ?>
        <input
          type="text"
          value="<?= $error ?>"
          style="width: 100%; text-align: center; margin-top: 1em; border:3px solid; border-bottom-width:5em;border-color:red;color: red"
          disabled
        >
      <?php else: ?>
      <input
        type="text"
        value="<?= $word ? $converted->name(TRUE) : "Not set" ?>"
        style="width: 100%; text-align: center; margin-top: 1em;<?= $word ? 'color: ' . $converted->hex() : NULL ?>"
        disabled
      >
      <?php endif; ?>
    </form>
  </body>
</html>
