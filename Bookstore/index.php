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
            

                     <div class="bookSimple">                
                        <?php
                          
                          //List records
                          $sql = "SELECT * 
                                  FROM bookdescriptions order by rand() limit 3";

                          //$result is an array containing query results 
                          $result = mysqli_query($link, $sql)
                                  or die('SQL syntax error: ' . mysqli_error($link));

                          //echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
                          ?>

                             <?php
                             include 'utilities.php';
                             // iterate through the retrieved records
                             while ($row = mysqli_fetch_array($result)) {
                                //Field names are case sensitive and must match
                                //the case used in sql statement
                                echo "<div class='card'> \n";
                                echo "<div class='card-body'> \n";
                                echo "<a class='booktitle' href='ProductPage.php?isbn=$row[ISBN]'>$row[title]</a> <br />";
                                echo "<a href='ProductPage.php?isbn=$row[ISBN]'> 
                                      <img class='Book' alt=$row[title] 
                                      src='/sandvig/mis314/assignments/bookstore/bookimages/$row[ISBN].01.THUMBZZZ.jpg'></a>";
                                echo "<b>Price: $$row[price]</b>";
                                echo checkEndSpace($row[description]);
                                echo "<a href='ProductPage.php?isbn=$row[ISBN]'> more...</a>";
                                echo "</div>";
                                echo "</div>";
                             }
         ?> 
                     </div>  
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