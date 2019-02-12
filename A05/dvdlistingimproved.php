<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
   <head>
      <title>Movie Listing</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <div class="pageContainer centerText">
      <h3>Movie Listing</h3>
      <hr>
      <?php
      //include database connection
      include("databaseconnection.php");

      //connect to database
      $link = fConnectToDatabase();

      
      $sql = 'Select c.asin,title,price,GROUP_CONCAT( Concat( FName, " ", LName ) SEPARATOR ", " ) AS Name from dvdactors a, dvdtitles b, dvdactortitles c
              WHERE c.asin = b.asin
              AND c.actorid = a.actorid
              GROUP BY c.ASIN';

      //$result is an array containing query results 
     $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));

     echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
      ?>
      <table class="simpleTable">
         <tr>
            <th>Asin</th>
            <th>Title</th>
            <th>Price</th>
            <th>Actors</th>
            <th>Cover</th>
         </tr>
         <?php
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $asin = $row['asin'];
            $actorid = $row['actorid'];
            echo "<tr>
                     <td>$row[asin]</td>
                     <td>$row[title]</td>
                     <td>$$row[price]</td>
                     <td>$row[Name]</td>
                     <td><img src='http://images.amazon.com/images/P/$asin.01.MZZZZZZZ.jpg'></td>
                 </tr>";
            
         }
         ?> 
      </table>
   </div>
</body>
</html>
