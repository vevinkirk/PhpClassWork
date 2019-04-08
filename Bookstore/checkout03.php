<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      
      <link rel="stylesheet" href="StyleSheet.css" type="text/css" />
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   </head>
   <body>
      <!--Begin header include -->

        <?php include('header.html');  ?>
<!--End header include -->



      <div id="pageContainer">
          
          <?php
        include("databaseconnection.php");
        include_once( 'utilities.php');
        include_once( 'encryption.php');
        $link = fConnectToDatabase();
        $email = $_POST['email'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $state = $_POST['state'];
        $zip = $_POST['zip'];
        $custIDe = $_POST['custIDe'];
        $custID = decrypt($custIDe, $secretPassword); 
        //echo $custID;
        //echo $state;
        $IsValid = true;
        
        if(!fIsValidEmail($email)) {
            echo "<p class='centeredNotice'> Enter A Valid Email</p>";
            $IsValid = false;
         }
         if (!fIsValidLength($fname, 2, 20)) {
            echo "<p class='centeredNotice'>Enter first name (2-20 characters)</p>";
            $IsValid = false;
         }
         if (!fIsValidLength($lname, 2, 20)) {
            echo "<p class='centeredNotice'>Enter last name (2-20 characters)</p>";
            $IsValid = false;
         }
         if (!fIsValidLength($street, 2, 25)) {
            echo "<p class='centeredNotice'>Enter first name (2-25 characters)</p>";
            $IsValid = false;
         }
         if (!fIsValidLength($city, 2, 30)) {
            echo "<p class='centeredNotice'>Enter first name (2-30) characters)</p>";
            $IsValid = false;
         }
         if (!fIsValidStateAbbr($state)) {
            echo "<p class='centeredNotice'>Enter 2-character state abbreviation</p>";
            $IsValid = false;
         }
          if(!fIsValidZip($zip)){
             echo "<p class='centeredNotice'>Enter 5-digit zip</p>";
             $IsValid = false;
         }
         if (!$IsValid) {
            //at least one element not valid. Echo a message and stop execution
            echo "<title>Input error</title>";
            echo "<p class='centeredNotice'><input type='button' class='button' value='<< Go Back <<' onClick='history.back()'><br></p>";
            //stop execution. 
             include('footer.html');
            exit();
         }
         
         if($IsValid){
            echo "<title>Order Confirmation-GeekBooks</title>";
            if($custID){
                //echo "Exists";
                $sql = "UPDATE bookCustomers
                        SET fname='$fname',lname='$lname',street='$street',city='$city',zip='$zip',state='$state'
                        WHERE custID = $custID ";
                $result = mysqli_query($link, $sql)
                                  or die('SQL syntax error: ' . mysqli_error($link));
            }
            else{
                //echo "Doesnt exist";
                $sql = "INSERT into bookCustomers(email,fname,lname,street,city,zip,state)
                        VALUES ('$email','$fname','$lname','$street','$city','$zip','$state')";
                $result = mysqli_query($link, $sql)
                                  or die('SQL syntax error: ' . mysqli_error($link));
                $newID = mysqli_insert_id($link);
                $custID = $newID;
                //echo $custID;
                
                //echo "New record has id: " . mysqli_insert_id($link);
            }
            $custIDe = encrypt($custID, $secretPassword);
            //echo $custIDe;
            $sql = "Select ISBN,title,price
                        FROM bookdescriptions
                        WHERE  " ;
            $cookieName = "myCart2";
            if(isset($_COOKIE[$cookieName])){
                $bookArray = unserialize($_COOKIE[$cookieName]);
                //echo $bookArray; 
            }
            setcookie($cookieName, null, time()-60000);
            if (count($bookArray)) {
                  echo "<div class='pageTitle'>Order Confirmation</div>";
                  echo "<h5 align='center'>Books Shipped</h5>";
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
                     $count++;
                     $title = $title."\n".$count.".".$row[title]." qty=$qty"."\n";
                     //echo $title;
                     $body = "Order Number:$orderID\n
                              Items Shipped:\n";
                     $body = $body.$title;
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
                  
                    
               $timestamp = time();
               //echo date("F d, Y",$timestamp);
               $sql = "INSERT into bookorders(custID,orderdate)
                        VALUES ('$custID','$timestamp')";
               $result = mysqli_query($link, $sql)
                                  or die('SQL syntax error: ' . mysqli_error($link));
               $orderID = mysqli_insert_id($link);
               //echo "New record has id: " . mysqli_insert_id($link);
               foreach ($bookArray as $isbn => $qty) {
                    $discount = 0.8;
                    $sql = "INSERT INTO bookorderitems (orderID, isbn, qty, price) VALUES
                            ($orderID, '$isbn', $qty, (select (price * $discount) from bookdescriptions where ISBN = '$isbn'))";
                     $result = mysqli_query($link, $sql)
                                  or die('SQL syntax error: ' . mysqli_error($link));
                     
                  }
                  
                  echo "<table class='table table-bordered table-hover' id='cart'>
                        
                        <thead class='thead-dark'>
                        <tr>
                            <th>Order number</th>
                            <th>Shipping</th>
                            <th>Address</th>
                        </tr>
                        </thead>";
                  echo "
                     <tr>
                        <td>
                            $orderID
                        </td>
                        <td>
                            $fname $lname
                        </td>
                        <td>
                         $street\n
                         $city, $state $zip
                        </td>
                     </tr>";
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
                  $subject = "Order Confirmation-Geek Books";
                  $restOfBody = "\n$fname $lname\n
                                 $street\n
                                 $city, $state $zip\n
                                 Total Cost: $$finalTotal\n
                                 Your order should arrive via UPS ground within 3-5 business days\n
                                 Thank you for shopping GeekBooks.";
                  $body = $body.$restOfBody;
                 mail($email, $subject ,$body, 'From: virkk2@wwu.edu');
                 
                 
                 
               }
        }
        
      ?>
         <!-- start content -->
       
<div class='cartIcons'>
                    A confirmation has been sent to your email address.<br>
                    Thank you for shopping with GeekBooks.com.
                    <br>
                    <a href='index.php'>
                       <img border='0' src='/sandvig/mis314/assignments/bookstore/images/continue-shopping.gif' width='121' height='19'></a><br>
                    <br>
                    <!-- must use method post to transfer encrypted custID. Cannot transfer in query string due to URL encoding -->
                    <form method='post' action='orderHistory.php'>
                       <input type='submit' class='button' value='View Your Order History'  style='max-width: 300px;' />
                       <input type='hidden' name='custIDee' value='<?php echo $custIDe;?>'/>
                    </form>
</div>          

     
    

<!-- end page content *************** -->
    </div> 
         <!-- end content -->

         <!--Begin footer include -->
<?php include('footer.html');  ?>
<!--End footer include -->
     

      <!-- Sample site uses a MasterPage-like template for page layout. -->
      <!-- This is not required. It may be used as an enhancement. -->
      <!-- Source: http://spinningtheweb.blogspot.com/2006/07/approximating-master-pages-in-php.html -->
   </body>
</html>


