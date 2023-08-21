<?php

session_start ();
include("connection.php"); 

if(isset($_REQUEST['sub']))
{
	
	
$a = $_REQUEST['u_name'];
$b = $_REQUEST['u_password'];
$c = $_REQUEST['title'];

$query = "SELECT * from login_data where u_name='$a'and u_password='$b' and u_type='$c'";
// echo "select* from login_data where u_name='$a'and u_password='$b' and u_type='$c'";die;
$res = mysqli_query($con, $query);

$result=mysqli_fetch_array($res);
if($result)
{
	$_SESSION["user_name"]=$result['u_name'];
	$_SESSION["login_type"]=$result['u_type'];
	$_SESSION["user_id"]= $result['user_id'];
	$_SESSION["logged_in"]="1";
	
	header("location:../pages/master.php");
	
}
else	
{
	header("location:../signup/signup.php?err=1");
	
	
}
}
?>