<html>
<head>  
    <title>Sales Calculation</title>
   <link href="style.css" rel="stylesheet" type="text/css">
   </head>
<body>
<div class="pageContainer centerText">
<h2>Sales Calculation</h2><hr>
<form>
    <p>Item Price:
    <input type="text" name="price" size="5" autofocus>
    <input type="submit" value="Calculate">
    </p>
</form>

<?php
    $price = $_GET['price'];
    if(!is_numeric($price) && !empty($price)){
        echo "<div class='alert'>Invalid entry. Please enter a numeric value.</div>";
    }
    elseif(is_numeric($price)){
        echo "<table class=simpleTable>\n";
        $formattedPrice = number_format($price,2);
        echo "<tr>\n";
        echo "<td align=right>Price:</td>\n";
        echo "<td>$$formattedPrice</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td align=right>25% discount:</td>\n";
        $discountPrice = number_format($formattedPrice/4,2);
        echo "<td>-$$discountPrice</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td align=right>Discounted Price:\n";
        $lowerPrice = number_format($price-$discountPrice,2);
        echo "<td>$$lowerPrice</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td align=right>Tax(8.4%)\n";
        $tax = number_format($lowerPrice*.084,2);
        echo "<td>$$tax</td>\n";
        echo "</tr>\n";
        echo "<tr>\n";
        echo "<td align=right>Total Due:\n";
        $total = number_format($lowerPrice+$tax,2);
        echo "<td><b>$$total</b></td>\n";
        echo "</tr>\n";
        echo "</table>\n";
        echo " <br>&nbsp;\n";
        echo "<table class=simpleTable>\n";
        echo "<tr>\n";
        echo "<td align=right>Sales Date:</td>\n";
        $today = getdate();
        $d = $today['mday'];
        $m = $today['month'];
        $y = $today['year'];
        $time = date("h:i:s A");
        echo "<td>$m $d, $y</td>\n";
        echo "</tr>\n";
        echo "<td align=right>Sales Time:</td>\n";
        echo "<td>$time</td>\n";
        echo "</table>\n";
        echo "<h3>Thank you for shopping at Discount-O-Rama!</h3>";
    }
?>
</div>
</body>
</html>