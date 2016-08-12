<?php
    $method = $_SERVER['REQUEST_METHOD'];
    $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
    $pairs = explode("&", file_get_contents("php://input"));
    $conn =  mysql_connect('localhost','root','root') or die("cannot connect");
    mysql_select_db("radius_app");
    foreach ($pairs as $pair) {
	    $nv = explode("=", $pair);
	    $var = urldecode($nv[1]);
	}
    if($var)
     {
    	$sql="SELECT user_contact FROM register_users WHERE user_contact='$var'";
    	$check=mysql_query($sql);
	$row=mysql_fetch_array($check);
    	if($row==NULL)
	{
		echo "NO";
	}
    	else
	{
		echo "YES";
	}
      }
    mysql_close($conn);
?>

