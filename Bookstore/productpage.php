<?php
//include database connection
                          include("databaseconnection.php");

                          //connect to database
                          $link = fConnectToDatabase();
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

      <title>Product Details - GeekBooks - MIS 314 Sample Bookstore</title>
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

 <?php include('menu.php');  ?>

<!--End menu include -->
         </div>
         <!-- start dynamic content -->

            
<!-- start page content *************** -->
            <div id="pageContent">
                <div class="bookSimple">                
                        <?php
                          //include database connection
                          
                          
                          $isbn = $_GET['isbn'];
                          //connect to database
                          
                          //List records
                          $sql = "SELECT  *
                                  FROM bookdescriptions
                                  WHERE ISBN = '$isbn'";
                          
                          //need to join tables here

                          //$result is an array containing query results 
                          $result = mysqli_query($link, $sql)
                                  or die('SQL syntax error: ' . mysqli_error($link));

                          //echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
                          ?>

                             <?php
                             include 'utilities.php';
                             include 'listauthors.php';
                             $author = fListAuthors($link, $isbn);
                             // iterate through the retrieved records
                             while ($row = mysqli_fetch_array($result)){
                                $discountPrice = number_format($row[price] - $row[price]*.20,2);
                                $discount = number_format($row[price]*.20,2);
                                //Field names are case sensitive and must match
                                //the case used in sql statement
                                echo "<div class='container-fluid'>";
                                echo "<div class='row'>";
                                echo "<div class='card'> \n";
                                echo "<div class='card-body'> \n";
                                echo "<a class='booktitle' href='ProductPage.php?isbn=$row[ISBN]'>$row[title]</a> <br />";
                                //echo fListAuthors($link, $isbn);
                                echo "<div class='authors'>by <a href='SearchBrowse.php?search=$author</a></div>";
                                echo "<a href='ProductPage.php?isbn=$row[ISBN]'> 
                                      <img class='Book' alt=$row[title] 
                                      src='/sandvig/mis314/assignments/bookstore/bookimages/$row[ISBN].01.MZZZZZZZ.jpg'></a>";
                                echo "<div><span class='priceLabel'>List Price: </span><span class='bookPriceList'>$row[price]</span></div>";
                                echo "<div><span class='priceLabel'>Our Price:</span><span class='bookPriceB'>$$discountPrice </span></div>";
                                echo "<div><span class='priceLabel'>You Save:</span><span class='bookPriceB'>$$discount (20%)</span><br /></div>";
                                echo "<div class='bookDetails'><div><b>ISBN:</b> $row[ISBN]</div><div><b>Publisher:</b> $row[publisher]</div><div><b>Pages:</b> $row[pages]</div><div> <b>Edition:</b> $row[edition]</div></div>";
                                echo "<a href='ShoppingCart.php?addISBN=$row[ISBN]'><img class='addToCart' src='/sandvig/mis314/assignments/bookstore/images/add-to-cart-small.gif' alt='Add to cart' title='Add to cart' ></a>";
                                echo "<div class='bookDescription'>$row[description]</div>";
                                echo "<a href='ShoppingCart.php?addISBN=$row[ISBN]'><img class='addToCart'  src='/sandvig/mis314/assignments/bookstore/images/add-to-shopping-cart-blue.gif'  alt='Add to cart' title='Add to cart' ></a>";
                                //echo "<b>Price: $$row[price]</b>";
                                //echo checkEndSpace($row[description]);
                                //echo "<a href='ProductPage.php?isbn=$row[ISBN]'> more...</a>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                                echo "</div>";
                             }
         ?> 
                </div>  
            </div> 

   
   
<!-- end page content *************** -->
 
         <!-- end dynamic content -->

         <!--Begin footer include -->
 <?php include('footer.html');  ?>
<!--End footer include -->
      </div>

      <!-- Sample site uses a MasterPage-like template for page layout. -->
      <!-- This is not required. It may be used as an enhancement. -->
      <!-- Source: http://spinningtheweb.blogspot.com/2006/07/approximating-master-pages-in-php.html -->
   </body>
</html>


