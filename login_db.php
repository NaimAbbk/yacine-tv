<?php
include("includes/connection.php");

$username = filter_input(INPUT_POST, 'user_login', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'user_pass', FILTER_SANITIZE_STRING);

if($username==""){
	$_SESSION['class']="error";
	$_SESSION['msg']="1"; 
	header( "Location:index.php");
	exit;
	
}else if($password==""){
	$_SESSION['class']="error";
	$_SESSION['msg']="2"; 
	header( "Location:index.php");
	exit;	

}else{

	$qry="select * from tbl_admin where username='".$username."' and password='".$password."'";
	
	$result=mysqli_query($mysqli,$qry);		
	
	if(mysqli_num_rows($result) > 0){ 

		$row=mysqli_fetch_assoc($result);

		$_SESSION['id']=$row['id'];
		$_SESSION['admin_name']=$row['username'];

		$_SESSION['class']="success"; 
		$_SESSION['msg']="17"; 
		
		header( "Location:dashboard.php");
		exit;

	}else{

		$_SESSION['class']="error";
		$_SESSION['msg']="4"; 
		header( "Location:index.php");
		exit; 
	}
}
?> 