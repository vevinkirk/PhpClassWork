<html>
   <head>
      <title>Valid Input</title>
      <link href="style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <form>
            <p>Iterations:
               <input type="text" name="rows" size="5" autofocus>
               <input type="submit" value="Loop">
            </p>
         </form>
         <table class="simpleTable">
           <?php
           $rows = $_GET['rows'];
            if(!is_numeric($rows) && !empty($rows)){
                echo "<tr><td>Please enter number 1-10.</td></tr>\n";
            }
            elseif (is_numeric($rows)){
                  for($i=1;$i<=$rows;$i++){
                     echo "<tr><td>Iteration: $i</td></tr>\n";
                  }
              }
          ?>
         </table>
      </div>
   </body>
</html>