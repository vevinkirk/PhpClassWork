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

<?php include('header.html');?>


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

        <td valign="top">
          <?php
            include 'utilities.php';
            include 'listauthors.php';
            
            include_once( 'encryption.php');
            
            $custIDe = $_POST['custIDee'];
            $custID = decrypt($custIDe, $secretPassword);
            //echo $custID;
            $sql = "SELECT DISTINCT b.ISBN, b.qty,b.orderID,a.orderID,a.custID,a.orderdate,c.title,c.ISBN
                    FROM bookorders a,bookorderitems b, bookdescriptions c
                    WHERE a.custID = $custID
                    AND b.ISBN = c.ISBN
                    AND a.orderID = b.orderID
                    ORDER by a.orderdate DESC
                    ";
                   
            $result = mysqli_query($link, $sql)
                or die('SQL syntax error: ' . mysqli_error($link));
            
            $sql2 = "SELECT DISTINCT b.ISBN, b.qty,b.orderID,a.orderID,a.custID,a.orderdate,c.title,c.ISBN
                    FROM bookorders a,bookorderitems b, bookdescriptions c
                    WHERE a.custID = $custID
                    AND b.ISBN = c.ISBN
                    AND a.orderID = b.orderID
                    ";
            $result2 = mysqli_query($link, $sql2)
                or die('SQL syntax error: ' . mysqli_error($link));
            while ($row2 = mysqli_fetch_array($result2)) {
                //echo $row2[qty];
                $sum = $sum+$row2[qty];
            }
            //echo $sum;
            echo "<div class='pageTitle'>Your Order History</div><br />";
            echo "<div class='pageTitle2'>You have ordered $sum books</div>";
           while ($row = mysqli_fetch_array($result)) {
                
                $author = fListAuthors($link, $row[ISBN]);
                $timestamp = $row[orderdate];    
                $orderdate = date("F d, Y",$timestamp);
                echo "<div class='card' class='bookHistory'> \n";
                echo "<div class='card-body'> \n";
                echo "<a class='booktitle' href='ProductPage.php?isbn=$row[ISBN]'>$row[title]</a> <br />";
                echo "<div class='authors'>by <a href='SearchBrowse.php?search=$author</a></div>";
                echo "Qty: $row[qty]";
                echo "</br>";
                echo "Order Date: ".date("F d, Y",$row[orderdate]);
                echo "</br>";
                echo "<a href='ProductPage.php?isbn=$row[ISBN]'> 
                      <img class='Book' alt=$row[title] 
                      src='/sandvig/mis314/assignments/bookstore/bookimages/$row[ISBN].01.THUMBZZZ.jpg'></a>";         
               echo "</div>";
               echo "</div>";
            }
          ?>

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


