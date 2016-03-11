<?php
session_start();

$scout = $_SESSION['login_user'] ;
$user_id = $_SESSION['user_id'] ;

	if (isset($_GET['scout'])) {
		$_POST['getid'] = $_GET['scout'] ; 
		$getid = $_POST['getid'] - 12000 ;

	} else {
		$getid = $user_id ;
	}

	//Grab user profile
	$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","crowdscout_main");
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

$query = "SELECT * FROM members_v0 WHERE member_id = $getid";
$user_profile = $conn->query($query) or die($conn->error.__LINE__);
	
	
		if ($user_profile->num_rows > 0) {
		
			$user_profile = $user_profile->fetch_assoc();	
			
			$user_name = $user_profile['user_name'];
			$email = $user_profile['email'];
			$city = $user_profile['city'];
			$state = $user_profile['state'];
			$country = $user_profile['country'];
			$zip = $user_profile['zip'];
		}
	 

if(isset($_POST['user_name_v1'])) {

		echo "hi";
 		$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","crowdscout_main");
  		// Check connection
		 if ($conn->connect_error) {  
		 	die("Connection failed: " . $conn->connect_error); }	

		$user_name_v1=$_POST['user_name_v1'];
		$sql = $conn->query("UPDATE members_v0 SET user_name=$user_name_v1 WHERE member_id = $getid") or die($conn->error.__LINE__);
		echo "done:" . $user_name_v1;
		}


if(isset($_POST['user_name_v1'])) {

		echo "done2";
		}


	$conn->close();
?>

<html>
	<head>
		<meta charset="UTF-8">
		<meta name="description" content="Crowd Scout Player Ratings">
		<meta name="keywords" content="Player,Ratings,Rankings,Scout,Scouting">
		<title>Update Profile</title>
	
			<?php include('header.php');?>
	
	
	</head>


  <body>  
  		<!--facebook-->
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>


	<div class="container">
			
				<div class="panel panel-default">
					<div class="panel-heading">	
						<h2><?php echo $scout.' Profile Update';?></h2>
					</div>

					<div class="panel-body table table-striped">
						<table class="table table-striped">
									
							<tbody>
					
								<tr>

								 	<form role="form" method="post" action="update.php">
									<div class="form-group">
										<td><?php echo '<strong>User Name:</strong> '. $user_name;?></td>
										<td><input name="user_name_v1" type="text" class="form-control" placeholder="Enter User Name"></td>
									</div>
									<td>
		  										<!--div>
													<input type="submit" class="btn btn-success btn-lg" value="Update2" />
												</div-->	
									</td>
									</form>
								</tr>

								<tr>
									<td><?php echo '<strong>Email:</strong> '. $email;?></td>



									<td align="right"> <button type="button" class="btn btn-success">Update</button></td>
								</tr>								
								<tr>
									<td><?php echo '<strong>City:</strong> '.$city;?></td>
									<td align="right"> <button type="button" class="btn btn-success">Update</button></td>
								</tr>								
								<tr>
									<td><?php echo '<strong>St/Prov:</strong> '. $state;?></td>
									<td align="right"> <button type="button" class="btn btn-success">Update</button></td>
								</tr>														
								<tr>
									<td><?php echo '<strong>Country:</strong> '. $country;?></td>
									<td align="right"> <button type="button" class="btn btn-success">Update</button></td>
								</tr>							
								<tr>
									<td><?php echo '<strong>Zip:</strong> '. $zip;?></td>
									<td align="right"> <button type="button" class="btn btn-success">Update</button></td>
								</tr>
							
										
							</tbody>	
						</table>
					</div>
				
			</div>
	</div><!--container-->
	
	<?php include('footer.php'); ?>

  </body>
</html>