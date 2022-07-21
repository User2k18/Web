<?php
if(session_status() == false){
    session_start();
};
    ?>
<html lang="en"><head>
        <title>
            User list
        </title>
        
        <meta name="viewport" content="width=device-width">
        <link rel="stylesheet" href="../styles.css">
        <link rel="icon" type="image/png" href="../images/logo.png">
        <link rel="apple-touch-icon" href="../images/logo.png">
        
        
    </head>
<body>


    

        <div class="container">

            <div class="row navigation">
                <a href="index.php">
                    <img src="/images/logo.png" class="navigation-icon">
                </a>
                
                <?php
                    if(isset($_SESSION['username']))
                    {
                        echo '<a href="../admin/userlist.php">userlist</a>';
                        echo '<a href="../admin/addusers.php">addusers</a>';
                        echo '<a href="../admin/bannedusers.php">banned</a>';
                        
                        echo '<span class="aside">
			<a href="../admin/logout.scr.php">logout</a>
		</span>';
                        
                    }
                    else
                    {
                        echo '<a href="index.php">home</a>';
                    }
                
                    
                ?>
                

            </div>
