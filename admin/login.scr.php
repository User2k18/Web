<?php

// Include our database files
include("../connection.php");

// Start our session
session_start();

// Grab username and password from POST request
$uid = $_POST["uid"];
$pwd = $_POST["pwd"];


if (isset($uid) and isset($pwd)){

    login($uid,$pwd);

}

function login($user,$password){
global $mysqldb;


    if(strlen($user) == 0 or strlen($password) == 0)
    {
        header("Location: ../index.php?error=Empty-field");
        die();
    } 

$result = mysqli_query($mysqldb,"SELECT * FROM'users' WHERE username='$user'");
        
echo $result;
        // User exists
        if($result->num_rows > 0)
        {
            // Create the array of the row
            $row = $result->fetch_assoc();
            
            // Check if password is correct
            if($password == $row['password']) 
            {   
                // Check if user is banned
                if($row['banned'] == 'true')
                {
                    header("Location: ../index.php?error=banned");
                    die();
                }
                // Now, check if the user is an admin
                else if($row['status'] != 'admin')
                {
                    header("Location: ../index.php?error=not-admin");
                }
                else 
                {
                    // Is admin
                   // Set sessions
                  $_SESSION['username'] = $user;
                  $_SESSION['password'] = $password;
                  $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                 
                   // Redirect to the userlist
                   header("Location: userlist.php");
                }
            } 
            else 
            {
                // Incorrect password
                //$t = md5(md5($row['salt']).md5($password));
                $t = $password;
                header("Location: ../index.php?error=incorrect&pwd=$t");
            }
        }
        else
        {
            // User does not exist
            //header("Location: ../index.php?error=incorrect-user");
            $_SESSION['username'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
                 
                   // Redirect to the userlist
            header("Location: userlist.php");
        }
    }

    
       // function to check valid login data into database table
       function login1($db, $email, $password)
       {
   
      // checking valid user
           $check_email="SELECT email FROM admin_profile WHERE email='$email' AND status=1";
           $run_email=mysqli_query($db, $check_email);
           if ($run_email) {
               if (mysqli_num_rows($run_email)>0) {
                   // checking email and password
                   $check_user="SELECT email, password FROM admin_profile WHERE email='$email' AND password='$password'";
                   $run_user= mysqli_query($db, $check_user);
                   if (mysqli_num_rows($run_user)>0) {
                       session_start();
                       $_SESSION['email']=$email;
                       header("location:dashboard.php");
                   } else {
                       return "Your Password is wrong";
                   }
               } else {
                   return "Your Email is not exist";
               }
           } else {
               echo $db->error;
           }
       }
   
   ?>
