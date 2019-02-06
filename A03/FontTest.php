<?php
if (!empty($_GET['message']))
   $message = $_GET['message'];
else
   $message = "The quick brown fox jumps over the lazy dog";
?>
<html>
   <head>
      <title>Funky Font Message</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <div class="pageContainer centerText">
      <h2>Funky Font Message</h2><hr>
      <form>
        Please enter a message:<br>
            <input type="text" name="message" size="50" value="<?php echo $message ?>" autofocus>
            <input type="submit" value="Send">
      </form>

      <?php
      //parse individual characters from $message and display character image
      for ($i = 0; $i < strlen($message); $i++) {
         //grab the next character
         $char = substr($message, $i, 1);
         // display <br> tags for spaces
         if ($char != " ") {
            echo "<img src='/sandvig/Images/Alphabet/chunk/red/{$char}9.jpg'>\n";
         } else {
            echo "<br />\n";
         }
      }
      ?>
   </div>
   <body>
</html>