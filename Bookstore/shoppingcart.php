<?php
//include database connection
                          include("databaseconnection.php");

                          //connect to database
                          $link = fConnectToDatabase();
include_once( 'utilities.php');


//Shopping cart uses cookies to store cart items.
//PHP script uses an array for adding, removing and displaying the cart items.
//Cookies can contain only string data so array must be serialized.

$cookieName = "myCart2";
// retrieve cookie and unserialize into $bookArray
if (isset($_COOKIE[$cookieName])) {
   $bookArray = unserialize($_COOKIE[$cookieName]);
}
// Add items to cart
$addISBN = fCleanString($link, $_GET['addISBN'], 10);
if (strlen($addISBN) > 0) {
   if (isset($addISBN, $bookArray)) {
      // Increment by +1
      $bookArray[$addISBN] += 1;
   } else {
      // Add new item to cart
      $bookArray[$addISBN] = 1;
   }
}
// Remove items from cart
$deleteISBN = fCleanString($link, $_GET['deleteISBN'], 10);
if (strlen($deleteISBN) > 0) {
   if (isset($bookArray[$deleteISBN])) {
      // Deincrement by 1
      $bookArray[$deleteISBN] -= 1;
      // remove ISBN from array if qty==0
      if ($bookArray[$deleteISBN] == 0) {
         unset($bookArray[$deleteISBN]);
      }
   }
}


if (isset($bookArray)) {
   // Write cookie
   setcookie($cookieName, serialize($bookArray), time() + 60 * 60 * 24 * 180);

   //Count total books in cart
   $totalbooks = 0;
   foreach ($bookArray as $isbn => $qty) {
      $totalbooks += $qty;
   }
   setCookie('BookCount', $totalbooks, time() + 60 * 60 * 24 * 180);
}
//***************************************************
//You do not need to modify any code above this point
//***************************************************
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <title>Shopping Cart - GeekBooks</title>
      <link rel="stylesheet" href="StyleSheet.css" type="text/css" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body>
      <!--Begin header include -->

       <?php include('header.html');  ?>

<!--End header include -->



      <div id="pageContainer">
         <div id="leftColumn">
            <!--Begin menu include -->

            <?php include_once('menu.php');  ?>

<!--End menu include -->
         </div>
         <!-- start dynamic content -->
        
         <div id="pageContent">
            
            <?php
               echo $totalbooks . " item";
               if ($totalbooks != 1)
                  echo 's';
               echo ' in your cart'
               ?> 
                <?php
                $sql = "Select ISBN,title,price
                        FROM bookdescriptions
                        WHERE  " ;
                
               //To do:
               // 1. Build sql statement containing ISBNs. Use foreach loop.
               // 2. Execute sql and display book titles, prices, qty, etc.
               if (count($bookArray)) {
                  echo "<table class='table table-bordered table-hover' id='cart'>
                        
                        <thead class='thead-dark'>
                        <tr>
                        <th>Title</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Add/Remove</th>
                        </tr>
                        </thead>";
                  foreach ($bookArray as $isbn => $qty) {
                     $sql .= " ISBN = '$isbn' OR ";
                    
                  }
                     
                     $sql = substr($sql,0,strlen($sql)-3);
                     //echo "sql: $sql <br> ";
                     $result = mysqli_query($link, $sql)
                                  or die('SQL syntax error: ' . mysqli_error($link));
                     
                     while ($row = mysqli_fetch_array($result)) {
                      $discountPrice = number_format($row[price] - $row[price]*.20,2);
                     
                     $qty = $bookArray[$row[ISBN]];
                     $total = number_format($discountPrice * $qty,2);
                     $subtotal += $total;
                     if($totalbooks > 1){
                         $shipping = 3.49 +(.99*($totalbooks-1));
                     }
                     elseif($totalbooks = 1){
                         $shipping = 3.49;
                     }
                     else{
                         $shipping = 0;
                     }
                     $finalTotal = $subtotal + $shipping;
                     $title = $row[title];
              
                     echo "
                     <tr>
                        <td>
                           <a class='booktitle' href='ProductPage.php?isbn=$row[ISBN]'>$row[title]</a> 
                        </td>
                        <td>
                       $qty
                        </td>
                        <td>
                        $$discountPrice  
                        </td>
                        <td>
                        $$total
                        </td>
                        
                        <td>
                           <a href='?addISBN=$row[ISBN]'>Add</a><br>
                           <a href='?deleteISBN=$row[ISBN]'>Remove</a>
                        </td>
                     </tr>";
                     
                     
                     }   
                  echo "</table>";
                  
                    echo "
                  <table class='cartTotal'>
          <tr>
            <td> Sub-Total:</td>
            <td align='right'> $$subtotal </td>
          </tr>
              <tr>
            <td> Shipping:*</td>
            <td align='right'> $$shipping </td>
          </tr>
          <tr>
            <td><b>Total:</b></td>
            <td align='right'><b> $$finalTotal </b></td>
          </tr>
        </table>";
                  
                   
               }
               ?>
              <div class="cartIcons">
            <a href="index.php"> <img border="0" src="/sandvig/mis314/assignments/bookstore/images/continue-shopping.gif" width="121" height="19" alt="Continue shopping" /></a>&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="checkout01.php"> <img border="0" src="/sandvig/mis314/assignments/bookstore/images/proceed-to-checkout.gif" width="183" height="31" alt="Proceed to checkout"  ></a>
           </div>


        <p id="shipping">* Shipping is $3.49 for the first book and $.99 for each additional book. To assure
        reliable delivery and to keep your costs low we send all books via UPS ground. </p>
         </div>
         
      <?php include('footer.html');  ?>
         <!-- end dynamic content -->
    </div>
      <!-- Sample site uses a MasterPage-like template for page layout. -->
      <!-- This is not required. It may be used as an enhancement. -->
      <!-- Source: http://spinningtheweb.blogspot.com/2006/07/approximating-master-pages-in-php.html -->
   </body>
  
</html>