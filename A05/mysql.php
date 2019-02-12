<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
   <head>
      <title>PHP Database Insert, Read & Delete</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <div class="pageContainer centerText">
      <h3>PHP Database Insert, Read, & Delete</h3>
      <hr>
      <form class="formLayout">
         <div class="formGroup">
            <label>Title</label>
            <input name="Title" type="text" autofocus>
         </div>
         <div class="formGroup">
            <label> </label>
            <button>Submit</button>
         </div>
      </form>
      <?php
      //include database connection
      include("databaseconnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
      $title = fCleanString($link, $_GET['title'], 100);
      $price = fCleanString($link, $_GET['price'], 15);
      $deleteID = fCleanNumber($_GET['deleteID']);

      //Insert
      if (!empty($nameF) && !empty($nameL)) {
         $sql = "Insert into dvdtitles (title, price)
                VALUES ('$title', '$price')";
         mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
      }

      //Delete
      if (!empty($deleteID)) {
         $sql = "Delete from dvdtitles WHERE asin=$deleteID";
         mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
      }
      //List records
      $sql = 'SELECT asin, title, price
                FROM dvdtitles order by asin';

      //$result is an array containing query results
      $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));

      echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
      ?>
      <table class="simpleTable">
         <tr>
            <th>asin</th>
            <th>title</th>
            <th>price</th>
            <th>Delete</th>
         </tr>
         <?php
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $asin = $row['asin'];
            echo "<tr>
                     <td>$asin</td>
                     <td>$row[title]</td>
                     <td>$row[price]</td>
                     <td><a href='?deleteID=$custID'>delete</a></td>
                 </tr>";
         }
         ?> 
      </table>
   </div>
</body>
</html>
