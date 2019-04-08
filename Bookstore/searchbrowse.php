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

      <title>Book Search - GeekBooks - MIS 314 Sample Bookstore</title>
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
<?php
    include 'utilities.php';
    include 'listauthors.php';
    
    
    $search = $_GET['search'];
    $search = mysqli_real_escape_string($link,$search);
    $catID = $_GET['catID'];
    //echo $search;
    //echo $catID;
    //echo "$catName";
    if($catID){
        $sql = "SELECT DISTINCT d.ISBN, title, description, price, CategoryName
                FROM bookauthors a, bookauthorsbooks ba, bookdescriptions d,
                bookcategoriesbooks cb, bookcategories c
                WHERE a.AuthorID = ba.AuthorID
                AND ba.ISBN = d.ISBN
                AND d.ISBN = cb.ISBN
                AND c.CategoryID = cb.CategoryID
                AND cb.CategoryId = '$catID'
                ORDER BY title";
        
    }
    elseif($search){
        $sql = "SELECT DISTINCT d.ISBN, title, description, price
                FROM bookauthors a, bookauthorsbooks ba, bookdescriptions d,
                bookcategoriesbooks cb, bookcategories c
                WHERE a.AuthorID = ba.AuthorID
                AND ba.ISBN = d.ISBN
                AND d.ISBN = cb.ISBN
                AND c.CategoryID = cb.CategoryID
                AND (CategoryName = '$search'
                OR title LIKE '%$search%'
                OR description LIKE '%$search%'
                OR publisher LIKE '%$search%'
                OR concat_ws(' ', nameF, nameL, nameF) LIKE '%$search%' )
                ORDER BY title";
      
    }
    else{
        $sql = "SELECT DISTINCT d.ISBN, title, description, price
                FROM bookauthors a, bookauthorsbooks ba, bookdescriptions d,
                bookcategoriesbooks cb, bookcategories c
                WHERE a.AuthorID = ba.AuthorID
                AND ba.ISBN = d.ISBN
                AND d.ISBN = cb.ISBN
                AND c.CategoryID = cb.CategoryID
                ORDER BY title";
        
    }
    $result = mysqli_query($link, $sql)
                or die('SQL syntax error: ' . mysqli_error($link));
    $numRows = mysqli_num_rows($result);
    if($search){
        echo "$numRows books in the search: $search";
    }
    else{
        
        echo "$numRows books in the category";
    }
    while ($row = mysqli_fetch_array($result)) {
        //Field names are case sensitive and must match
        //the case used in sql statement
        $author = fListAuthors($link, $row[ISBN]);
        echo "<div class='card'> \n";
        echo "<div class='card-body'> \n";
        echo "<a class='booktitle' href='ProductPage.php?isbn=$row[ISBN]'>$row[title]</a> <br />";
        echo "<div class='authors'>by <a href='SearchBrowse.php?search=$author</a></div>";
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


