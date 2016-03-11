



<html>
  <head>
  <meta charset="UTF-8">
  <meta name="description" content="Crowd Scouting Player Rankings">
  <meta name="keywords" content="Football,Hockey,Baseball,Basketball,Player,Rankings,Scout,Scouting">
    <title>LogIn CrowdScout</title>
    
    <?php include('header.php');?>

  </head> 
<!--Log In Form-->

<div class="container">
<body>

    <h3>Forgot Password</h3>

  <div class="col-md-6 col-md-offset-3">
    <div class="card card-container">
      <form action='#' method='post'>
          
      <span id="reauth-email" class="reauth-email"></span>
      <input id="email" name="email" placeholder="Registered Email" type="text" id="inputEmail" class="form-control" required autofocus name='email'>
      <br>        
      <input class="btn btn-lg btn-primary btn-block btn-signin" type='submit' name='submit' value='Submit'/>
              
      </form>

<?php

if(isset($_POST['submit'])) { 

 $conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","crowdscout_main");
  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

 $email=$_POST['email'];
 $user_q = $conn->query("SELECT * FROM members_v0 where email = '$email'") or die($conn->error.__LINE__);

 if ($user_q->num_rows > 0) {

         //create a new random password

        $password = substr(md5(uniqid(rand(),1)),3,10);
        $pass = md5($password); //encrypted version for database entry

      $res = $user_q->fetch_assoc() ;
      
            //send email
            $to=$res['email'];
            $subject='CrowdScout Sports Account Recovery';
            $body = "Hi ".$res['user_name'].", we have some new account details for you! Your username is ".$res['user_name']. 
                      " and your new password is $password. Your password has been reset please login and change your password as desired. Thanks!";
            
            $additionalheaders = "From: <info@crowdscoutsports.com>rn";
            $additionalheaders .= "Reply-To: noreply@crowdscoutsports.com";
            $m = mail($to, $subject, $body, $additionalheaders);

             //update database
            $sql = $conn->query("UPDATE members_v0 SET password='$pass' WHERE email = '$email'") or die($conn->error.__LINE__);
            $rsent = true;



                if ($rsent == true){
                    echo "<h4>You have been sent an email with your account details to $email</h4>";
                    } else {
                    echo "<h4>Please enter your e-mail address. You will receive a new password via e-mail.</h4>";
                    }

        if($m) {
          echo'<h4>Check your inbox! Thanks!</h4>';
        } else {
         echo'<h4>Trouble sending email!</h4>';
        }

    } else {
      echo '<h4>This email could not be found in database!</h4>';
     }
  }
 
?>
 </div>
</div>


</div><!-- /container -->
       
<?php include('footer.php'); ?>

</body>
</html>
