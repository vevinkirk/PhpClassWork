<html>
   <head>
      <title>For Loop</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h2>For Loop</h2><hr>

         <form>
            
            <p>Iterations:
               <input type="text" name="rows" size="5" autofocus>
               <input type="submit" value="Loop">
            </p>
         </form>
         <?php
              if (is_numeric($_GET['rows'])){
                  $rows = $_GET['rows'];
                  for($i=0;$i<$rows;$i++){
                      echo "Iteration: $i";
                      echo "<br \>";
                  }
              }
         ?>

      </div>
   </body>
</html>