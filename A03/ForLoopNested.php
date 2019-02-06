<html>
<head>
   <title>For Loop Nested</title>
   <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
<body>
<div class="pageContainer centerText">
<h2>For Loop Nested</h2><hr>

<form>
    Rows:
    <input type="text" name="rows" size="5">
    <br><br>
    Columns:
    <input type="text" name="cols" size="5">
    <br><br>
    <input type="submit" value="Loop">
</form>

<table class=simpleTable>
         <?php
              if (is_numeric($_GET['rows'])){
                  $rows = $_GET['rows'];
                  $cols = $_GET['cols'];
                  for($i=0;$i<$rows;$i++){
                      echo "<tr>\n";
                      echo "<td>row $i, col 0</td>\n";
                      for($j=1;$j<=$cols-1;$j++){
                        echo "<td>" . "row" .($i).",col" .($j)."</td>\n";
                      }
                  }
                  echo "<tr>\n";
              }
         ?>
      </table>
</table>
</div>
</body>
</html>