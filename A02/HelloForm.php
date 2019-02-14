<!DOCTYPE html>
<html>
   <head>
      <title>Sample web form</title>
      <link href="style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2>Hello Form</h2>
         <hr />

         <form>
            <p>Please enter your name:</p>
            <input type="text" name="fname" autofocus>
            <input type="submit" value="Submit Name">
         </form>

         <?php
         //Retrieve name from querystring. Check that parameter
         //is in querystring or may get "Undefined index" error
         if (isset($_GET['fname']))
         {
            $fname = $_GET['fname'];
            echo "<h1> Hello $fname";
         }
         ?>
      </div>
   </body>
</html>   

