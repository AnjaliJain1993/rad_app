<?php
        $method = $_SERVER['REQUEST_METHOD'];
        $request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
        $link =  mysql_connect('localhost','root','root') or die("cannot connect");
        mysql_select_db("radius_app");
        $number = preg_replace('/[^a-z0-9_]+/i','',array_shift($request));
	if($number)
	{
        	$otp =  rand(10000, 99999);
	        $sql="SELECT * FROM register_users WHERE user_contact='$number'";
	        $check=mysql_query($sql);
       		$row=mysql_fetch_array($check);
		if($row==NULL)
	        {
        	        $result = file_get_contents('http://sms.salert.co.in/new/api/api_http.php?username=rachit&password=rachit123&senderid=POZIOM&to='.$number.'&text=One%20time%20usage%20password%20is%20'.$otp.'&route=Transaction');
                	$sql="SELECT * FROM otp WHERE user_contact=$number";
			$retval=mysql_query($sql);
			$row=mysql_fetch_array($retval);
			if($row==NULL)
			{	
				$sql="INSERT INTO otp VALUES ('$number',$otp)";
				$retval=mysql_query($sql);
			}
			else
			{
				$sql="UPDATE otp SET otp=$otp WHERE user_contact=$number";
				$retval=mysql_query($sql);
			}
               		$reply="new_user";
        	}	
		else
        	{
                	$reply="already_registered";
       		}
//        echo (json_encode($reply)));
		echo $reply;
	}
        mysqli_close($link);
?>
