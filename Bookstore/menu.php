<div class="menuContainer">
   <div class="menuSearch" >
      <div class="menuHead">
         Search
      </div>

      <div class="menuBorder">
         <form action="SearchBrowse.php" >
            <input type="text" name="search" autofocus />
            <input type="submit" value="Search" class="button fullWidth" />
         </form>
      </div>
   </div>

   <nav class="IsDesktop">
      <div class="menuHead">
         Browse
      </div>

      <div class="menuBorder">
         <?php
            
            
            $sql = "SELECT * from bookcategories ORDER BY CategoryName;";
                    $result = mysqli_query($link, $sql)
                                  or die('SQL syntax error: ' . mysqli_error($link));
                    
             while ($row = mysqli_fetch_array($result)) {
                 echo "<a href='SearchBrowse.php?catID=$row[CategoryID]&catName=$row[CategoryName]' class='menuitem'>$row[CategoryName]</a><br />";
                 
             }
         ?>
         
      </div>
   </nav>
</div>