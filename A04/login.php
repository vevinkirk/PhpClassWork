 <?php
        session_start();
        if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off") {
            $location = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            header('HTTP/1.1 301 Moved Permanently');
            header('Location: ' . $location);
            exit;
}
         if(isset($_POST['postback'])){
            $postback = $_POST['postback'];
            $uname = $_POST['username'];
            $password = $_POST['password'];
            if ($password == 'guest' && strlen($uname) > 0) { 
                $_SESSION['username'] = "$uname";
                header("location: protected.php"); exit; //stops page execution 
            }
        }
     ?>
<!DOCTYPE HTML>
<html>
   <head>
      <title>Login</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <div class="pageContainer centerText">
         <h2>Login</h2>
         <form method="post" class="formLayout">
            <div class="formGroup">
               <label>First name:</label>
               <input type="text" name="username" value="<?php echo $uname ?>" 
                      class="formElement" 
                      placeholder="first name" 
                      title="first name" required autofocus /><br>
                <?php
               if ($postback && strlen($uname) < 1) {
                   
                    echo "<span class=alert>&nbsp;Please enter your name.</span>";
                }
               ?>
            </div>
            
            <div class="formGroup">
               <label>Password:</label>
               <input type="password" name="password" value="<?php echo $password ?>"
                      class="formElement"
                      placeholder="password"
                      title="password" required /><br>
               <label></label>(Password is 'guest')<br>
               <label></label>
               <?php
               if ($postback && $password != "guest" ) {
                   
                    echo "<span class=alert>&nbsp;Please enter the password 'guest'.</span>";
                }
               ?>
            </div>
             

            <div class="formGroup">
               <label> </label>
               <input type="hidden" name="postback" value="true">
               <button type="submit">Login</button>
            </div>
            <div class="formGroup">
               <label></label>
               <button type="submit" formnovalidate>Login without HTML5 validation</button>
            </div>

            <div class="vertGap55 centerText">
                 <a href="protected.php">Try going to protected.php without logging on.</a>
            </div>
         </form>     
       
      </div>
   </body>
</html>