<?php
error_reporting(0);
$b=$_POST['sandi'];
include "sambung.php";
$query = mysqli_query($link, "select * from login where id_login ='1'");
$jmlh=mysqli_fetch_array($query);
if($b==$jmlh[1])
{
	include"menu.php";
}
if($b!=$jmlh[1])
{
	echo "<script language=\"Javascript\">\n";
	echo "window.alert('Login Gagal');";
	echo "</script>";
	include"index.php";
}
?>