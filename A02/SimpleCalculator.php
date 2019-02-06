<html>
   <head>
      <title>Simple Calculator</title>
      <link href="style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2>Simple Calculator</h2><hr />
         <form>
            <p>
               Value 1:
               <input type="text" name="value1" autofocus><br><br>
               Value 2:
               <input type="text" name="value2"><br><br>
               <input type="submit" value="Add"></p>
         </form>
         <?php
         if (is_numeric($_GET['value1']) and is_numeric($_GET['value2']) )
         {
            $value1 = $_GET['value1'];
            $value2 = $_GET['value2'];
            echo 'value1 = ' . $value1;
            echo "<br \>";
            echo 'value2 = ' . $value2;
            echo "<br \>";
            echo 'Sum is: ' . ($value1 + $value2);
                    
         }
         ?>
      </div>
   </body>
</html>
