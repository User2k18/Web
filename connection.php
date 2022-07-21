<?php
$dbHOST = "localhost";
$dbUSER = "root";
$dbPASS = "";
$dbNAME = "test";

//echo 'hi';

$mysqldb = mysqli_connect($dbHOST,$dbUSER,$dbPASS,$dbNAME);

// if(!$obj)
// {
//     $obj = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
// }
// else
// {
//     $obj = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD);
//     die('Not connected : ');

// }



//$obj = ;

//mysqli_select_db($obj,DB_DATABASE);




if(isset($_POST["Repair"]))
{

create_db();

}


function create_db()
{
	
$info = "
CREATE TABLE `tokens` (
  `username` varchar(255) NOT NULL,
  `token` varchar(20) NOT NULL,
  `expiry` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(5) NOT NULL,
  `hwid` varchar(255) NOT NULL,
  `ip` varchar(10) NOT NULL,
  `status` varchar(10) NOT NULL,
  `banned` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;
";

// $obj = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

// if (mysqli_query($obj, "CREATE DATABASE " + $dbNAME)) {
//  echo 'Database created successfully';
//   mysqli_query($obj,$info);
// }
// else {
//   echo 'Error creating database: ' . mysqli_error($obj);
// }

}



// select db  

//mysql_create_db("moonlight")
//query($info)


