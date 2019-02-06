<html>
<head>
    <title>Random Image</title>
   <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
<body>
<div class="pageContainer centerText">
        <h2>Random Image</h2>
        <hr />
        <?php
            
            $dice1 = rand(1, 6);
            $dice2 = rand(1,6);
            
            echo "<img src=/sandvig/images/dice/$dice1.gif>";
            echo "<img src=/sandvig/images/dice/$dice2.gif>";
            echo "<br \>";
            echo "Sum of device is: " . ($dice1 + $dice2);
            echo "<br \>";
            
         ?>
                
         <a href="?">Reload Page</a>
         

    </div>
</body>
</html>
