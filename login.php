<?php
session_start(); // Starting Session

//submit is hit, then run script
if (isset($_POST['submit'])) {
	//Check to see if username and password are filled
	if (empty($_POST['user_name']) || empty($_POST['password'])) {
		$error = "Missing Username or Password";
} else {
	// Establishing Connection with Server by passing server_name, user_id and password as a parameter
	$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","crowdscout_main");

	$user_verify = $conn->real_escape_string($_POST['user_name']);

	// To protect MySQL injection for Security purpose
	$user_name = $conn->real_escape_string($_POST['user_name']);
	$password = $conn->real_escape_string(md5($_POST['password']));
	// Selecting Database
	// SQL query to fetch information of registerd users and finds user match.
	$user = $conn->query("select * from members_v0 where password='$password' AND user_name='$user_verify' or email='$user_verify'");
	
	if ($user->num_rows > 0) {
		$user = $user->fetch_assoc();
		$_SESSION['login_user']=$user['user_name']; // Initializing Session
		$_SESSION['user_id']=$user['member_id']; // Initializing Session
		$_GET['scout'] = $_SESSION['user_id'];
		$getid = $_GET['scout'] + 12000;


			

		
		header("location: profile.php?scout=$getid"); // Redirecting To Other Page

	} else {
		$error = "Username or Password is Invalid";
		}


		
	$conn->close(); // Closing Connection
}
}
?>