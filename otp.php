<?php
        $conn =  mysql_connect('localhost','root','root') or die("cannot connect");
        mysql_select_db("radius_app");
        $number = $_POST['user_contact'];

        $otp =  rand(10000, 99999);
        $sql="SELECT * FROM register_users WHERE user_contact='$number'";
        $check=mysql_query($sql);
        $row=mysql_fetch_array($check);
        if($row==NULL)
        {
                $result = file_get_contents('http://sms.salert.co.in/new/api/api_http.php?username=rachit&password=rachit123&senderid=POZIOM&to='.$number.'&text=One%20time%20usage%20password%20is%20'.$otp.'&route=Transaction');
#		echo $result;
                $sql="INSERT INTO otp VALUES ('$number',$otp)";
                $retval=mysql_query($sql);
                echo "new_user";
        }
        else
	{
		echo "already_registered";
	}
        mysql_close($conn);
?>



