<html>
   <head>
      <title>Display Image</title>
      <link href="style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">
         <h2>Display Image</h2>
         <hr />
         <form>
            <p>
               Please enter a value between 1-6:<br>
               <input type="text" name="value1" size="3" autofocus><br>
               <input type="submit" value="Display Image"></p>
         </form>
        <?php
        if (is_numeric($_GET['value1']))
         {
            $value1 = $_GET['value1'];
            if($value1 >= 7){
                echo '<h3>Error pick between 1-6</h3>';
                 
            }elseif($value1 < 7){
                echo "<h3>You entered $value1 </h3>";
                echo "<img src=/sandvig/images/dice/$value1.gif>";
                
            }        
         }
         ?>
      </div>
   </body>
</html>
