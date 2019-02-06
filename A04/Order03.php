<html>
   <head>
      <title>Order Confirmation</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">
      <?php
        //must arrive from order02.php
        $referrer = $_SERVER['HTTP_REFERER'];
        if(stripos($referrer, 'order02.php') == false) header("location:order01.php");

        include 'ValidateUtilities.php';
        $color = $_GET['color'];
        $IsValid = true;
        
       if(!fIsValidColor($color)){
           echo "Select a color";
           $IsValid = false;
       }
        
        if (!$IsValid) {
            //at least one element not valid. Echo a message and stop execution
            echo "<p><input type='button' class='button' value='<< Go Back <<' onClick='history.back()'><br></p>";
            //stop execution. 
            exit();
         }
         if(isset($_COOKIE['fname']) && isset($_COOKIE['model'])){
            
             $fname = $_COOKIE['fname'];
             $model = $_COOKIE['model'];
             echo "<h2>Order Confirmation</h2>\n";
             echo "<h3> Congratulations $fname you have ordered a $color $model!</h3>\n";
             echo "<img style='margin:30px 0;' src='/sandvig/mis314/assignments/a04/images/$model$color.jpg' >\n";
             echo "<br>";
             echo "<a href=Order01.php>Place another order</a>\n";
             
         } 
    ?>
      </div>
         

<p></p>
        

      </div>
   </body>
</html>