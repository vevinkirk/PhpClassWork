<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
   <head>
      <title>Movie Database</title>
      <link href="/style.css" rel="stylesheet" type="text/css">
   </head>
   <div class="pageContainer centerText">
      <h3>Movie Database</h3>
      <hr>
      <form class="formLayout">
          <div class="formGroup">
            <label>ASIN:</label>
            <input type="text" name="asin" required placeholder="ASIN" autofocus  pattern=".{10,}" title="10 or more numbers & characters"/>
            
         </div>
         <div class="formGroup">
            <label>Title:</label>
            <input type="text" name="title" required placeholder="title" />
         </div>
          <div class="formGroup">
            <label>Price:</label>
            <input type="text" name="price" required placeholder="price" pattern="[0-9\.]{1,7}" title="Must be numeric" />
         </div>
         <div class="formGroup">
            <label> </label>
            <button>Add to Database</button>
         </div>
      </form>
      <?php
      //include database connection
      include("databaseconnection.php");

      //connect to database
      $link = fConnectToDatabase();

      //Retrieve parameters from querystring and sanitize
      $asin = fCleanString($link, $_GET['asin'], 15);
      $title = fCleanString($link, $_GET['title'], 100);
      $price = fCleanString($link, $_GET['price'], 5);
      $deleteAsin = fCleanString($link,$_GET['deleteAsin'],15);

      //Insert
      if (!empty($asin)) {
         $sql = "Insert into dvdtitles (asin,title, price)
                VALUES ('$asin','$title',$price)";
         mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
      }
      //INSERT INTO `dvdtitles` (`asin`, `title`, `price`) VALUES ('4', 'testfour', '4');
      //Delete
      if (!empty($deleteAsin)) {
         $sql = "Delete from dvdtitles WHERE dvdtitles . asin='$deleteAsin'";
         mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
      }
      //DELETE FROM `dvdtitles` WHERE `dvdtitles`.`asin` = '123123123123123' 
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
            <th>image</th>
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
                     <td>$$row[price]</td>
                     <td><img src='http://images.amazon.com/images/P/$asin.01.MZZZZZZZ.jpg'></td>
                     <td><a href='?deleteAsin=$asin'>delete</a></td>
                 </tr>";
            
         }
         ?> 
      </table>
   </div>
</body>
</html>
