<html>
   <head>
      <title>PHP Clock</title>
      <link rel="stylesheet" type="text/css" href="clockStyle.css">
   </head>
   <body>
      <div class="bodyContainer">   
         <h1>Example 1: PHP clock</h1><hr  />
         <div class="clockBorder clockFont" >
            <h4> Time is: 
            <?php
               //echo current time
               //Format parameters: g hour, i minutes
               //s seconds, a am/pm
               echo date("g:i:s a");
            ?>
            </h4>
         </div>
         <h3>Today is :
            <?php
               //add format string to produce date format
               //"January 12, 2015";
               echo "<br \>";
               for($x=0;$x<=10;$x++){
                    echo date("F j, Y");
                    echo "<br \>";
               }
            ?>
         </h3>
      </div>
   </body>
</html>
