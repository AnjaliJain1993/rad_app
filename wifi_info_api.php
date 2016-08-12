<?php
    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $pairs = explode("&", file_get_contents("php://input"));
    $conn =  mysql_connect('localhost','root','root') or die("cannot connect");
    mysql_select_db("radius_app");
    $var=array();
    $i=0;
    foreach ($pairs as $pair) 
    {
            $nv = explode("=", $pair);
            $var[$i++] = urldecode($nv[1]);
    }
    $var[2]=str_replace("-",":","$var[2]");
    $valid=filter_var($var[2], FILTER_VALIDATE_MAC);
    if($valid)
    {
	    $sql="INSERT INTO wifi_info VALUES ('$var[0]','$var[1]','$var[2]','$var[3]',now())";
            $retval=mysql_query($sql);
    }
    else
            echo "Invalid MAC address";
    mysql_close($conn);
?>

