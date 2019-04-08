<?php
include("databaseconnection.php");
include_once( 'utilities.php');
$link = fConnectToDatabase();

if(isset($_COOKIE['BookCount'])){
    $totalbooks = $_COOKIE['BookCount'];
}

        
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <title>Sign-in - GeekBooks - MIS 314 Sample Bookstore</title>
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
            
<div class="pageTitle">Your Account</div>
<p class="pageTitle2">Buying online is quick and easy!</p>
<p class="pageTitle2"> <?php 
    if($totalbooks == 1){
        echo "$totalbooks book in cart"; 
    }
    else{
        echo "$totalbooks books in cart"; 
    }
            ?> </p>
   <form method="post" action="checkout02.php" autocomplete="on" class="myForm">
      <div class="cartIcons">
      <div class="formGroup">
         <label for="email">Email:</label>
         <input type="email" name="email" id="email" autofocus required placeholder="Email"  />
      </div>
      <div class="formGroup">
           <label> </label>
          
         <input type="image" src="/sandvig/mis314/assignments/bookstore//images/proceed-to-checkout.gif" alt="Proceed to checkout" class="inputImage" />
      </div>
      </div>
   </form>
    
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
