<?php
	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode('/', trim($_SERVER['PATH_INFO'],'/'));
	$pairs = explode("&", file_get_contents("php://input"));
	$conn =  mysql_connect('localhost','root','root') or die("cannot connect");
	mysql_select_db("radius_app");
	$timestamp2=date('Y-m-d H:i:s');
	$var=array();
	$i=0;
	foreach ($pairs as $pair) 
	{
		$nv = explode("=", $pair);
		$var[$i++] = urldecode($nv[1]);
	}
	$sql1="SELECT timestamp FROM request_profile WHERE req_id='$var[1]' and contact='$var[2]' and user_os='$var[0]'";
	$retval1=mysql_query($sql1);
	$row1=mysql_fetch_array($retval1);
	if($row1==NULL)
	{
		$sql="SELECT ssid,bssid,password FROM wifi_info where user_contact='$var[2]'";
	}
        else
        {
            $timestamp1=$row1[0];
            $sql="SELECT ssid,bssid,password FROM wifi_info where user_contact='$var[2]' and timestamp BETWEEN '$timestamp1' AND '$timestamp2'";
        }
        $retval=mysql_query($sql,$conn);
        $row=mysql_fetch_array($retval);
        $num=mysql_num_rows($retval);
        $i=0;
	$list=array();
        while($i<$num)
        {
                $info=array();
		$info['ssid']=$row[0];
		$info['bssid']=$row[1];
		$info['password']=$row[2];
                $i++;
		$list[]=$info;
                $row=mysql_fetch_array($retval);
        }
        if($row1==NULL)
        {
                $sql2="INSERT INTO request_profile VALUES('$var[1]','$var[2]','$var[0]','$timestamp2')";
        }
        else
        {
                $sql2="UPDATE request_profile SET timestamp='$timestamp2' WHERE req_id='$var[1]' and contact='$var[2]' and user_os='$var[0]'";
        }
	echo (json_encode($list));
        $retval2=mysql_query($sql2);
        mysql_close($conn);
?>
                                   

