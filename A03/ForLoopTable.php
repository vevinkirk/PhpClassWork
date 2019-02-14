<html>
   <head>
      <title>For Loop Table</title>
      <link href="style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2>For Loop Table</h2><hr>

         <form>
            
            <p>Iterations:
               <input type="text" name="rows" size="5" autofocus>
               <input type="submit" value="Loop">
            </p>
         </form>
         <table class=simpleTable>
         <?php
              if (is_numeric($_GET['rows'])){
                  $rows = $_GET['rows'];
                  for($i=1;$i<=$rows;$i++){
                     echo "<tr><td>Iteration: $i</td></tr>\n";
                  }
              }
         ?>
      </table>
      </div>
   </body>
</html>