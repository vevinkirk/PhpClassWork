<!DOCTYPE html>
<html>
   <head>
      <title>Movie Titles - Add, Delete</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">
         <h3>Movie Titles</h3><hr>

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
               <label></label>
               <button type="submit">Add to database</button>
            </div>
         </form>

         4 records in the database.</p>
<table class='simpleTable shadow'>
<tr><th>ASIN</th><th>Title</th><th>Price</th><th>Image</th><th>Delete</th>
<tr><td>B00005BKZS</td>
    <td>Black Robe</td>
    <td>$10.99</td>
    <td><img src='http://images.amazon.com/images/P/B00005BKZS.01.MZZZZZZZ.jpg'></td>
    <td><a href='?deleteASIN=B00005BKZS'> delete</a></td></tr>
<tr><td>B000065K8B</td>
    <td>Sliding Doors</td>
    <td>$9.98</td>
    <td><img src='http://images.amazon.com/images/P/B000065K8B.01.MZZZZZZZ.jpg'></td>
    <td><a href='?deleteASIN=B000065K8B'> delete</a></td></tr>
<tr><td>B00080ZG1A</td>
    <td>The Aviator</td>
    <td>$12.99</td>
    <td><img src='http://images.amazon.com/images/P/B00080ZG1A.01.MZZZZZZZ.jpg'></td>
    <td><a href='?deleteASIN=B00080ZG1A'> delete</a></td></tr>
<tr><td>B000BSM26Q</td>
    <td>Wedding Crashers</td>
    <td>$13.99</td>
    <td><img src='http://images.amazon.com/images/P/B000BSM26Q.01.MZZZZZZZ.jpg'></td>
    <td><a href='?deleteASIN=B000BSM26Q'> delete</a></td></tr>
</table>
      </div>
   </body>
</html>
