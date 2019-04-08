<?php
       $referrer = $_SERVER['HTTP_REFERER'];
        if(stripos($referrer, 'checkout01.php') == false) header("location:checkout01.php");
        include_once( 'utilities.php');
        $email = $_POST['email'];
        //echo $email;
        $IsValid = true;
        
        if (!fIsValidEmail($email)) {
            echo "Enter A Valid Email";
            $IsValid = false;
         }
         if (!$IsValid) {
            //at least one element not valid. Echo a message and stop execution
            echo "<p><input type='button' class='button' value='<< Go Back <<' onClick='history.back()'><br></p>";
            //stop execution. 
            exit();
         }
        
        
      ?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <title>Shipping Information - GeekBooks - MIS 314 Sample Bookstore</title>
      <link rel="stylesheet" href="StyleSheet.css" type="text/css" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body>
      <!--Begin header include -->

       <?php include('header.html');  ?>

<!--End header include -->



      <div id="pageContainer">
         <!-- start content -->
         <div id="checkoutContent">
            
<!-- start page content *************** -->
<div class="pageTitle">Shipping Information</div>
<?php
    include("databaseconnection.php");
    include_once( 'utilities.php');
    include_once( 'encryption.php');
    $link = fConnectToDatabase();
    $sql = "SELECT custID,email,fname,lname,street,city,zip,state FROM bookCustomers WHERE email = '$email'";
    
    $result = mysqli_query($link, $sql)
                                  or die('SQL syntax error: ' . mysqli_error($link));
    if (mysqli_num_rows($result) == 0 ) {
        echo "<p class='centeredNotice'>New Customer - Please provide your shipping address.  </p><br>";
    }
    else {
        echo "<p class='centeredNotice'>Returning Customer - Please confirm your email and mailing addresses.   </p><br>";
        $row = mysqli_fetch_array($result);
       
    }
    $custID = $row['custID'];
    $custIDe = encrypt($custID, $secretPassword);
    //echo $custIDe;
?>


   <form method="post" action="checkout03.php" autocomplete="on" class="myForm">

      <div class="formGroup">
         <label for="email">
            Email: </label>

         <input type="email" name="email" value="<?php echo $email ?>" required placeholder="Enter Email" maxlength="50" />
      </div>

      <div class="formGroup">
         <label for="fname">
            First name: </label>
         <input type="text" name="fname" value="<?php echo $row['fname'];?>" autofocus required  
                placeholder="First name" title="first name" maxlength="20" pattern="[A-Za-z'-]{2,20}" />
      </div>
      <div class="formGroup">
         <label for="lname">
            Last name: </label>
         <input type="text" name="lname" value="<?php echo $row['lname'];?>"required 
                placeholder="Last name" title="last name" maxlength="20" pattern="[A-Za-z'-]{2,20}" />
      </div>
      <div class="formGroup">
         <label for="street">
            Street: </label>
         <input type="text" name="street" value="<?php echo $row['street'];?>" required 
                placeholder="Street address" title="street address" maxlength="25" />
      </div>
      <div class="formGroup">
         <label for="city">
            City:</label>
         <input type="text" name="city" value="<?php echo $row['city'];?>" required 
                placeholder="City" title="city" maxlength="30"  pattern="[A-Za-z'-]{2,30}" />
      </div>
      <div class="formGroup">
         <label for="state">
            State:</label>
         <td>
            <input type="text" name="state" style="width:40px" value="<?php echo $row['state'];?>" required 
                   placeholder="ST" title="2-character state abbreviation" max length="2" pattern="[A-Za-z]{2}" />
      </div>
      <div class="formGroup">
         <label for="zip">
            Zip: </label>
         <input type="text" name="zip" style="width:80px;" value="<?php echo $row['zip'];?>" required 
                placeholder="Zip" title="zip" maxlength="5" pattern="[0-9]{5}" />
      </div>
      <div class="formGroup">
         <label></label>

         <input type="hidden" name="custIDe" value="<?php echo $custIDe;?>">
         <input class="inputImage" type="image" src="/sandvig/mis314/assignments/bookstore//images/buy-now.gif">
      </div>
   </form>
   <br>
<!-- must use method post to transfer encrypted custID. Cannot transfer in query string due to URL encoding -->
   
                   
   <form method='post' action='orderHistory.php' class='centeredText' >
      <input type='submit' class='button' value='View Your Order History' style='max-width: 300px;' />
      <input type='hidden' name='custIDe' value='<?php echo $custIDe;?>' />
   </form>
<!-- end page content *************** -->
         </div> 
         <!-- end content -->

         <!--Begin footer include -->
              <?php include('footer.html');  ?>
<!--End footer include -->
      </div>

      <!-- Sample site uses a MasterPage-like template for page layout. -->
      <!-- This is not required. It may be used as an enhancement. -->
      <!-- Source: http://spinningtheweb.blogspot.com/2006/07/approximating-master-pages-in-php.html -->
   </body>
</html>


