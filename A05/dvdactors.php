<!-- template for mySql database access. -->
<!DOCTYPE html>
<html>
   <head>
      <title>Movie Actors</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <div class="pageContainer centerText">
      <h3>Movie Actors</h3>
      <hr>
      <form class="formLayout">
          <div class="formGroup">
            <label>First name:</label>
            <input type="text" name="fname" required placeholder="first name" autofocus />
            
         </div>
         <div class="formGroup">
            <label>Last name:</label>
            <input type="text" name="lname" required placeholder="last name" />
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
      $fname = fCleanString($link, $_GET['fname'], 20);
      $lname = fCleanString($link, $_GET['lname'], 20);
      $deleteAsin = fCleanString($link,$_GET['deleteAsin'],15);

      //Insert
      if (!empty($fname)) {
         $sql = "Insert into dvdactors (fname,lname)
                VALUES ('$fname','$lname')";
         mysqli_query($link, $sql) or die('Insert error: ' . mysqli_error($link));
      }
      //INSERT INTO `dvdtitles` (`asin`, `title`, `price`) VALUES ('4', 'testfour', '4');
      //Delete
      if (!empty($deleteAsin)) {
         $sql = "Delete from dvdactors WHERE dvdactors . actorid='$deleteAsin'";
         mysqli_query($link, $sql) or die('Delete error: ' . mysqli_error($link));
      }
      //DELETE FROM `dvdtitles` WHERE `dvdtitles`.`asin` = '123123123123123' 
      //List records
      $sql = 'SELECT actorid, fname, lname
                FROM dvdactors order by actorid';

      //$result is an array containing query results 
      $result = mysqli_query($link, $sql)
              or die('SQL syntax error: ' . mysqli_error($link));

      echo "<p>" . mysqli_num_rows($result) . " records in query</p>";
      ?>
      <table class="simpleTable">
         <tr>
            <th>Actor Id</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Delete</th>
         </tr>
         <?php
         // iterate through the retrieved records
         while ($row = mysqli_fetch_array($result)) {
            //Field names are case sensitive and must match
            //the case used in sql statement
            $actorid = $row['actorid'];
            echo "<tr>
                     <td>$actorid</td>
                     <td>$row[fname]</td>
                     <td>$row[lname]</td>
                     <td><a href='?deleteAsin=$actorid'>delete</a></td>
                 </tr>";
            
         }
         ?> 
      </table>
   </div>
</body>
</html>
