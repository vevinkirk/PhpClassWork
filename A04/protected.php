 <?php
        session_start();
        if (!isset($_SESSION['username'])){
            header("location: login.php"); exit; //stops page execution
        }
         if(isset($_POST['abandon'])){
             session_unset();
             header("location: login.php"); exit; //stops page execution
         }
      ?>
<html>
   <head>
      <title>Password Protected Page</title>
      <link href="/sandvig/mis314/assignments/style.css" rel="stylesheet" type="text/css">
   </head>
   <body>
      <?php
        if (!isset($_SESSION['username'])){
            header("location: login.php"); exit; //stops page execution
        }
         if(isset($_POST['abandon'])){
             session_unset();
             header("location: login.php"); exit; //stops page execution
         }
      ?>
      <div class="pageContainer centerText">

            <h2>Password Protected Page</h2><hr>

            <h2>Welcome <?php echo $_SESSION['username'] ?></h2>
            <img src="/sandvig/mis314/assignments/images/vault.jpg" style="width:400px;height:auto;" />
            <br>
                 Your session will timeout
                 after 24 minutes of inactivity.<br><br>

         <form method="post" class="formLayout">
            <div class="formGroup">
               <input type="hidden" name="abandon" value="true">
               <label> </label>
               <button type="submit">Logout</button>
            </div>
         </form>

      </div>
   </body>
</html>