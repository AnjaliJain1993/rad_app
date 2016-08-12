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
    $sql="SELECT * FROM otp WHERE user_contact='$var[0]' and otp=$var[2]";
    $check=mysql_query($sql);
    $row=mysql_fetch_array($check);
    if($row==NULL)
    {
	echo "incorrect";
    }
    else
    {
	$sql="INSERT INTO register_users VALUES ('$var[0]','$var[1]','$var[2]')";
	$retval=mysql_query($sql);
	echo "registered";
    }
    mysql_close($conn);
?>

