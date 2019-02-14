<html>
<head>
   <title>Guess Game</title>
      <link href="style.css" rel="stylesheet" type="text/css">

   </head>
<body>
<div class="pageContainer centerText">
<h2>Guess Game</h2>

<form>
  <p>Please guess a number:
  <input type="text" name="intGuess" size="3" autofocus>
  <input type="submit" value="Give Hint" ></p>
</form>
<?php
         
         if (is_numeric($_GET['intGuess']))
         {
            $intGuess = $_GET['intGuess'];
             if ($intGuess < 4) {
               echo 'Your guess of ' . $intGuess . ' is <font color="red">very low.</font>';
            } elseif ($intGuess < 7) {
               echo 'Your guess of ' . $intGuess . ' is <font color="red">low.</font>';
            } elseif ($intGuess == 7) {
               echo 'Your guess of ' . $intGuess . ' is <font color="red">correct!</font>';
            } elseif ($intGuess <= 10) {
               echo 'Your guess of ' . $intGuess . ' is <font color="red">high.</font>';
            } elseif ($intGuess > 10) {
               echo 'Your guess of ' . $intGuess . ' is <font color="red">very high.</font>';
            }
            
         }
         ?>
</div>
</body>
</html>