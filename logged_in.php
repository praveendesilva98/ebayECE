<?php

$email = $_SESSION['email'];

$query = "SELECT active FROM acheteur WHERE email='$email'";
$result1 = query($query);
$user1 = fetch_array($result1);

$active = $user1['active'];



if(logged_in() && $active == '1')
{	
	$sql = "SELECT * FROM acheteur WHERE email='$email'";
	$result = query($sql);
	$user = fetch_array($result);
}
else
{
	redirect("logout.php");
}


    

?>