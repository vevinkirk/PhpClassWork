<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
   <head>
      <title>Movie Titles & Actors</title>
      <link href="style.css" rel="stylesheet" type="text/css">
   </head>
   <div class="pageContainer centerText">
      <h3>Movie Titles & Actors</h3>
      <hr>
      <form class="formLayout">
          <div class="formGroup">
            <label>ASIN:</label>
            <input type="text" name="asin"  required placeholder="ASIN" autofocus  pattern=".{10,}" title="10 or more numbers & characters"/>
            
         </div>
         <div class="formGroup">
            <label>ActorID:</label>
            <input type="text" name="actorID" required placeholder="actorID" pattern="[0-9]{1,4}" title="Must be numeric" />
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
      $actorid = fCleanString($link, $_GET['actorID'], 5);
      $deleteAsin = fCleanString($link,$_GET['deleteAsin'],15);
      $deleteID = fCleanNumber($_GET['deleteID']);

      //Insert
      if (!empty($asin)) {
         $sql = "Insert into dvdactortitles (asin,actorID)
                VALUES ('$asin','$actorid')";
         mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
      }
      //INSERT INTO `dvdtitles` (`asin`, `title`, `price`) VALUES ('4', 'testfour', '4');
      //Delete
      if (!empty($deleteAsin)) {
         $sql = "Delete from dvdactortitles WHERE dvdactortitles . actorid='$deleteID' AND dvdactortitles . asin='$deleteAsin'";
         //echo $sql;
         mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
      }
      //"DELETE FROM `dvdactortitles` WHERE `dvdactortitles`.`asin` = \'B000065K8B\' AND `dvdactortitles`.`actorid` = 11"?
      //List records
      $sql = 'SELECT asin,actorid
                FROM dvdactortitles order by actorid';

      //$result is an array containing query results 
      $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));

      echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
      ?>
      <table class="simpleTable">
         <tr>
             <th>Asin</th>
            <th>ActorID</th>
            <th>Delete</th>
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
                     <td>$row[actorid]</td>
                     <td><a href='?deleteAsin=$asin&deleteID=$actorid'>delete</a></td>
                 </tr>";
            
         }
         ?> 
      </table>
   </div>
</body>
</html>
