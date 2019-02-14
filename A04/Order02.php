<html>
   <head>
      <title>Select Color</title>
      <link href="style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">
    <?php
        
        $referrer = $_SERVER['HTTP_REFERER'];
        if(stripos($referrer, 'order01.php') == false) header("location:order01.php");
        
        include 'ValidateUtilities.php';
        $model = $_GET['model'];
        $fname = $_GET['fname'];
        $IsValid = true;
        
        if (!fIsValidLength($fname, 2, 20)) {
            echo "Enter first name (2-20 characters)<br>";
            $IsValid = false;
         }
         
        if(!fIsValidModel($model)){
            echo "Select a model";
            $IsValid = false;
        }
        
        if (!$IsValid) {
            //at least one element not valid. Echo a message and stop execution
            echo "<p><input type='button' class='button' value='<< Go Back <<' onClick='history.back()'><br></p>";
            //stop execution. 
            exit();
         }
         setcookie('fname',"$fname", time() + 60*60*24+180);
         setcookie('model',"$model", time() + 60*60*24+180);
         
    ?>

         

<p></p>
         <h2 class="centerText">Select Color</h2>


         <div class="pageContainer">
            <form action="Order03.php" class="formLayout">
               <div class="formGroup">
                  <label>Car color:</label>
                  <div class="formElements">
                     <select name="color" required >
                        <option  value=""></option>
                        <option style="background-color: blue; color:white;" value="blue">Blue</option>
                        <option style="background-color: red" value="red">Red</option>
                        <option style="background-color: yellow" value="yellow">Yellow</option>
                     </select> 

                  </div>
               </div>
               <div class="formGroup">
                  <label></label>
                  <button type="submit"> >> Next >> </button>
               </div>
               <div class="centerText vertGap55">
                  <button type="submit" formnovalidate>Submit without validation</button><br><br>
                  <a href="?">Reload page</a>
               </div>
            </form>
         </div>
      </div>
   </body>
</html>