<!DOCTYPE html>
<html>
   <head>
      <title>Validation Confirm</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">

   </head>
   <body>
      <div class="pageContainer centerText">
         <?php
         include 'ValidateUtilities.php';

         //Retrieve inputs (using helper function)
         $email = $_GET['email'];
         $fname = $_GET['fname'];
         $date = $_GET['birthday'];
         $age = $_GET['age'];
         $state = $_GET['state'];
         $zip = $_GET['zip'];
         //set validation flag
         $IsValid = true;

         echo "<p class='centeredNotice'>";
         //email
         if (!fIsValidEmail($email)) {
            echo "Invalid email<br>";
            $IsValid = false;
         }
        
         if (!fIsValidLength($fname, 2, 20)) {
            echo "Enter first name (2-20 characters)<br>";
            $IsValid = false;
         }
         
         if(!fIsValidDate($date)){
             echo "Enter birthday yyyy/mm/dd<br>";
             $IsValid = false;
         }
         if(!fIsValidAge($age)){
             echo "Enter age (1-99)<br>";
             $IsValid = false;
         }

         if (!fIsValidStateAbbr($state)) {
            echo "Enter 2-character state abbreviation<br>";
            $IsValid = false;
         }
         
         if(!fIsValidZip($zip)){
             echo "Enter 5-digit zip<br>";
             $IsValid = false;
         }

         echo "</p>";
         if (!$IsValid) {
            //at least one element not valid. Echo a message and stop execution
            echo "<img class='validImage' src='/sandvig/mis314/images/red_x.jpg' /><br><br>
            <p><input type='button' class='button' value='<< Go Back <<' onClick='history.back()'><br></p>";
            //stop execution. 
            exit();
         }
         //all inputs are valid. 
            echo "<div class='center'>
            <img class='validImage' src='/sandvig/mis314/images/valid.png' />
            <h3>All inputs have valid formats!</h3>
            Email: $email <br>
            First name: $fname <br>
            Birthday: $date <br>
            Age: $age <br>
            State: $state <br>
            Zip: $zip <br>
            ";
         ?>
      </div>
   </body>
</html>

