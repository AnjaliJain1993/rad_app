<?php
  $filename=$_GET['filename'];
//  $f='/var/www/html/rad_app/uploads/'.$filename;
  $fileData=file_get_contents('php://input');
  $fhandle=fopen($filename, 'wb');
  fwrite($fhandle, $fileData);
  fclose($fhandle);
//  chmod($f,0777);
?>




