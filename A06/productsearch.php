<!DOCTYPE html>
<html>
   <head><title>Product Search</title>
      <link rel="stylesheet" type="text/css" href="Style.css">
   </head>
   <body>
      <div class="pageContainer centerText">

         <h3>Product Search</h3><hr>
         Please enter all or part of a product name:
         <form class="formLayout">
            <div class="formGroup">
               <label>Search:</label>
               <input type="text" name="query" />
               <input type="hidden" name="postback" value="true">
            </div>
            <div class="formGroup">
               <label></label>
               <button type="submit">Search</button>
            </div>
         </form>

         (Leave empty to see all products.)
           <?php
      //include database connection
      include("databaseconnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
      $price = fCleanString($link, $_GET['price'], 5);
      //List records
      $sql = "SELECT price, Name, Image
                FROM geekproducts where price <= '$price' order by price";

      //$result is an array containing query results 
      $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));

      echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
      ?>
      <table class="simpleTable">
         <tr>
            <th>Price</th>
            <th>Item Name</th>
            <th>Thumbnail</th>
         </tr>
         <?php
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $price = $row['actorid'];
            echo "<tr>
                     <td>$row[price]</td>
                     <td>$row[Name]</td>
                     <td><a href='/sandvig/mis314/assignments/a06/images/l_$row[Image]'><img src='/sandvig/mis314/assignments/a06/images/m_$row[Image]' class='geekImageMed'></td>
                 </tr>";
         }
         ?> 
               </div>
   </body>
</html>
