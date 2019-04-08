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

      <title>GeekBooks - MIS 314 Sample Bookstore</title>
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
         <div id="pageContent">
            
<!-- start page content *************** -->

        <p class="pageTitle">Site Features</p>
        <ul>
          <li>Site created by Kevin Virk as a class project for <a href="http://yorktown.cbe.wwu.edu/sandvig/mis314/">MIS
            314</a> at Western Washington University. </li>
          <li>All product information is dynamically generated using PHP and mySQL.</li>
          <li>Product, customer and order information is stored in a mySQL database.</li>
          <li>Include files are used for all code that is used more
            than once (i.e. search/browse menu, ListAuthor function, 
            header and footer). </li>
          <li><span class="subHead">mySQL Database</span>
            <ul>
              <li>Normalized to 3rd normal form (or greater). Tables include:
                <ul>
                  <li>book details </li>
                  <li>book categories</li>
                  <li>relationship details-books (many-to-many) </li>
                  <li>authors</li>
                  <li>relationship authors-books  (many-to-many) </li>
                  <li>customers</li>
                  <li>orders</li>
                  <li>order items (one-to-many) </li>
                </ul>
              </li>
            </ul>
          </li>
          <li><span class="subHead">Home page</span>
          <ul>
            <li>Selects three random items from from the
            database using a SQL statement.</li>
            <li>Generates the browse menu dynamically from the database using a SQL query that shows
              only the book categories that currently contain books.</li>
            <li>Truncates book descriptions at 250 characters.</li>
          </ul>
          </li>
          <li><span class="subHead">Search page</span>
                <ul>
                  <li>Cleans user entered data to protect against SQL Injection attacks and cross-site scripting. </li>
                  <li>Searches book title, description, author and
                    category fields in the database.</li>
                  <li>The mysql_num_rows() function is used
                    to count the number of books found by the search.</li>
                  <li>Responds gracefully to searches that return no matches.</li>
                </ul>
          </li>
          <li><span class="subHead">Shopping cart page</span>
                <ul>
                  <li>Uses a cookie to store the ISBNs of items in the
                    cart.</li>
                </ul>
          </li>
          <li><span class="subHead">Checkout pages</span>
                <ul>
                  <li>Searches the database for email addresses of existing
                    customer accounts and writes their shipping information in
                    the form on the order confirmation page.</li>
                  <li>Customer ID is encrypted using Rijndael encryption algorithm
                    </li>
                </ul>
          </li>
          <li><span class="subHead">Order Confirmation Page</span>
                <ul>
                  <li>Checks for shopping cart and prompts user if cart is
                    empty.</li>
                  <li>All fields are checked to make sure that they contain
                    information.</li>
                  <li>Checks email address in database and prompts user to try
                    again user if address not found.</li>
                  <li>Modifications made to customer information are updated in
                    the database.</li>
                  <li>Order information are written to the database.</li>
                  <li>An email is sent to the customer with the order
                    information.</li>
                    <li>The shopping cart is emptied by setting ItemCount to zero in the ShoppingCart cookie.</li>
                </ul>
          </li>
          <li><span class="subHead">Order History Page</span>
                <ul>
                  <li>Searches the database for all orders associated with
                    e-mail address</li>
                  <li>If no matching email address is found user is prompted to
                    try again.</li>
                </ul>
          </li>
          <li><span class="subHead">Enhancements</b></span>
                <ul>
                    <li>Added function checkEndSpace in utilities.php that makes sure the descriptions in index.php aren't cut off mid word and always displays a full word at the end before more..</li>
                    <li>Added Twitter bootstrap css&js to create a mobile friendly website.</li>
                    <li>Added style enhancements to the website including updated tables with bootstrap grids and look</li>
                    <li>Added accurate sum to orderhistory page that calculates for quantity more than 1 for a book</li>
                </ul>
          </li>
          <li>Thanks to Amazon.com for the use of its
            icons, book images and book descriptions.</li>     
        </ul>
      
<!-- end page content *************** -->
         </div> 
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


