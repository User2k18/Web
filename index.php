<html lang="en"><head>
        <title>
            indica / admin
        </title>
        
        <meta name="viewport" content="width=device-width">
        <!-- <link rel="stylesheet" href="styles.css"> -->
        <link rel="icon" type="image/png" href="/images/logo.png">
        <link rel="apple-touch-icon" href="/images/logo.png">
         <!--bootstrap4 library linked-->
  <link rel="stylesheet" href="./assets/bootstrap.min.css">
  <script src="./assets/jquery.min.js"></script>
  <script src="./assets/popper.min.js"></script>
  <script src="./assets/bootstrap.min.js"></script>


        
        
    </head>
<body>

<?php

if(session_status() == false){
    session_start();
};

$_SESSION['username'] = '123';
$_SESSION['password'] = '123';
$_SESSION['suwoo'] = 'suwoo';
if(isset($_SESSION['username']))
{
    header("Location: admin/userlist.php");
};
if (isset($_GET['error'])){
        $error = $_GET['error'];
    }
    
    ?>


        <div class="container">

            <div class="row navigation">
                <a href=".">
                    <img src="/images/logo.png" class="navigation-icon">
                </a>
                <a href="index.php">home</a>

            </div>


<body>

<div class="container-fluid">
 <div class="row">
   <div class="col-sm-4">
   </div>
   <div class="col-sm-4">
   <p class="err-msg">
    <?php if(isset($error)){ echo '<p class="hint" style="color: red;">Incorrect username or password.</p>'; } ?>
    
    <!--====registration form====-->
    <div class="registration-form">
      <h4 class="text-center">Admin Panel</h4>
      <form action="./admin/login.scr.php" method="post" class="loginform">
       
        
        <!--// Email//-->
        <div class="form-group">
            <label>Email:</label>
            <input type="text" class="form-control"  placeholder="Enter Email" name="uid" value="">
            
            </p>
        </div>
        
        <!--//Password//-->
        <div class="form-group">
            <label>Password:</label>
            <input type="text" class="form-control"  placeholder="Enter Password" name="pwd">
            
        </div>

        
        <button type="submit" class="btn btn-secondary" name="login">Login</button>
      </form>
    </div>
   </div>
   <div class="col-sm-4">
   </div>
 </div>
  
</div>
<?php

include 'footer.php';

?>
</body>
</html>