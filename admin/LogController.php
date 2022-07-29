<?php 

//example 
$data = "bob is loged in";
	request("Login",$data);

function request($request_info,$data  = null)
{   
    if($data == null and $request_info != null){
        $data = $request_info;
        $request_info = null;
    }
    
    $file = "log.txt";
    $test = "";
    if(!file_exists($file)){
        $file = fopen($file,"w");
        fwrite($file,"w");
        fclose($file);
    }else{
    if(is_null($_SERVER['QUERY_STRING'])){
         $test = " request> " . $_SERVER['QUERY_STRING'];
    }
    file_put_contents($file, $_SERVER['REQUEST_METHOD']." "."ip=".$_SERVER['REMOTE_ADDR'].$test." date> ". date('d.m.Y H:i:s') . ' - '.$request_info."->" . $data . "\r\n", FILE_APPEND);
    }
    

    // if ($data != null) { 
    //     return $data;}
    
	// return false;

}




?>
