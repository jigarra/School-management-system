<?php
// Register Admin

session_start();
$connection = mysqli_connect("localhost","root","","admin");

if (isset($_POST['submit']))
{
	$last_name     = $_POST['LastName'];
	$email    = $_POST['email'];
	$password   = $_POST['password'];
	if ($password === $cpassword) 
	{
		$query = "INSERT INTO register (FirstName,LastName,email,password) VALUES('$first_name','$last_name','$email','$password')";
		$query_run = mysqli_query($connection, $query);

		if ($query_run) 
		{
			$_SESSION['success']="admin profile added";
			header('Location: register.php');
		}
		else
		{
			$_SESSION['status']="admin profile NOT added";
			header('Location: register.php');
		} 
	}
	else
	{
		$_SESSION['status']="passwordand confirm password dosew not methch";
		header('Location: register.php');
	}
}
// Login Admin

?>