<?php
session_start();

/////ADD TO MYSQL DATABASE

	if($_POST){
		// Create connection
		$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","crowdscout_main");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		
		//Get variables from post array
		$user_name = $conn->real_escape_string($_POST['user_name']);
		$email = $conn->real_escape_string($_POST['email']); 
		$password = $conn->real_escape_string(md5($_POST['password'])); 
		$city = $conn->real_escape_string($_POST['city']);
		$state = $conn->real_escape_string($_POST['state']);
		$country = $conn->real_escape_string($_POST['country']);
		$zip = $conn->real_escape_string($_POST['zip']);
		// If your checkbox name is foo, this will convert it
		// into a value that can be stored in the database
		$football = isset($_POST['football']) ? 1 : 0;
		$hockey = isset($_POST['hockey']) ? 1 : 0;
		$baseball = isset($_POST['baseball']) ? 1 : 0;
		$basketball = isset($_POST['basketball']) ? 1 : 0;
		$soccer = isset($_POST['soccer']) ? 1 : 0;
		$nfl = isset($_POST['nfl']) ? 1 : 0;
		$ncaafSEC = isset($_POST['ncaafSEC']) ? 1 : 0;
		$ncaafPAC12 = isset($_POST['ncaafPAC12']) ? 1 : 0;
		$ncaafACC = isset($_POST['ncaafACC']) ? 1 : 0;
		$ncaafBIG10 = isset($_POST['ncaafBIG10']) ? 1 : 0;
		$ncaafBIG12 = isset($_POST['ncaafBIG12']) ? 1 : 0;
		$ncaafamerican = isset($_POST['ncaafamerican']) ? 1 : 0;
		$footballother = isset($_POST['footballother']) ? 1 : 0;
		$nhl = isset($_POST['nhl']) ? 1 : 0;
		$ahl = isset($_POST['ahl']) ? 1 : 0;
		$whl = isset($_POST['whl']) ? 1 : 0;
		$ohl = isset($_POST['ohl']) ? 1 : 0;
		$ncaah = isset($_POST['ncaah']) ? 1 : 0;
		$qmjhl = isset($_POST['qmjhl']) ? 1 : 0;
		//$khlrus = isset($_POST['khlrus']) ? 1 : 0;
		$sel = isset($_POST['sel']) ? 1 : 0;
		$smliiga = isset($_POST['smliiga']) ? 1 : 0;
		$extraliga = isset($_POST['extraliga']) ? 1 : 0;
		$hockeyother = isset($_POST['hockeyother']) ? 1 : 0;
		
		$mlb = isset($_POST['mlb']) ? 1 : 0 ;
		$iaaa = isset($_POST['iaaa']) ? 1 : 0 ;
		$paaa = isset($_POST['paaa']) ? 1 : 0 ;
		$mxaaa = isset($_POST['mxaaa']) ? 1 : 0 ;
		$bbrk = isset($_POST['bbrk']) ? 1 : 0 ;
		$ncaabase = isset($_POST['ncaabase']) ? 1 : 0 ;
		$baseballother = isset($_POST['baseballother']) ? 1 : 0 ;
		$nba = isset($_POST['nba']) ? 1 : 0 ;
		$nbadl = isset($_POST['nbadl']) ? 1 : 0 ;
		$ncaabbPAC12 = isset($_POST['ncaabbPAC12']) ? 1 : 0 ;
		$ncaabbACC = isset($_POST['ncaabbACC']) ? 1 : 0 ;
		$ncaabbBIGE = isset($_POST['ncaabbBIGE']) ? 1 : 0 ;
		$ncaabbBIG10 = isset($_POST['ncaabbBIG10']) ? 1 : 0 ;
		$ncaabbBIG12 = isset($_POST['ncaabbBIG12']) ? 1 : 0 ;
		$eurobb = isset($_POST['eurobb']) ? 1 : 0 ;
		$basketballother = isset($_POST['basketballother']) ? 1 : 0 ;
		$hANA = isset($_POST['hANA']) ? 1 : 0 ;
		$hBOS = isset($_POST['hBOS']) ? 1 : 0 ;
		$hBUF = isset($_POST['hBUF']) ? 1 : 0 ;
		$hCAR = isset($_POST['hCAR']) ? 1 : 0 ;
		$hCBJ = isset($_POST['hCBJ']) ? 1 : 0 ;
		$hCGY = isset($_POST['hCGY']) ? 1 : 0 ;
		$hCHI = isset($_POST['hCHI']) ? 1 : 0 ;
		$hCOL = isset($_POST['hCOL']) ? 1 : 0 ;
		$hDAL = isset($_POST['hDAL']) ? 1 : 0 ;
		$hDET = isset($_POST['hDET']) ? 1 : 0 ;
		$hEDM = isset($_POST['hEDM']) ? 1 : 0 ;
		$hFLA = isset($_POST['hFLA']) ? 1 : 0 ;
		$hLAK = isset($_POST['hLAK']) ? 1 : 0 ;
		$hMIN = isset($_POST['hMIN']) ? 1 : 0 ;
		$hMTL = isset($_POST['hMTL']) ? 1 : 0 ;
		$hNJD = isset($_POST['hNJD']) ? 1 : 0 ;
		$hNSH = isset($_POST['hNSH']) ? 1 : 0 ;
		$hNYI = isset($_POST['hNYI']) ? 1 : 0 ;
		$hNYR = isset($_POST['hNYR']) ? 1 : 0 ;
		$hOTT = isset($_POST['hOTT']) ? 1 : 0 ;
		$hPHI = isset($_POST['hPHI']) ? 1 : 0 ;
		$hPHO = isset($_POST['hPHO']) ? 1 : 0 ;
		$hPIT = isset($_POST['hPIT']) ? 1 : 0 ;
		$hSJS = isset($_POST['hSJS']) ? 1 : 0 ;
		$hSTL = isset($_POST['hSTL']) ? 1 : 0 ;
		$hTBL = isset($_POST['hTBL']) ? 1 : 0 ;
		$hTOR = isset($_POST['hTOR']) ? 1 : 0 ;
		$hVAN = isset($_POST['hVAN']) ? 1 : 0 ;
		$hWPG = isset($_POST['hWPG']) ? 1 : 0 ;
		$hWSH = isset($_POST['hWSH']) ? 1 : 0 ;
		$fARI = isset($_POST['fARI']) ? 1 : 0 ;
		$fATL = isset($_POST['fATL']) ? 1 : 0 ;
		$fBAL = isset($_POST['fBAL']) ? 1 : 0 ;
		$fBUF = isset($_POST['fBUF']) ? 1 : 0 ;
		$fCAR = isset($_POST['fCAR']) ? 1 : 0 ;
		$fCHI = isset($_POST['fCHI']) ? 1 : 0 ;
		$fCIN = isset($_POST['fCIN']) ? 1 : 0 ;
		$fCLE = isset($_POST['fCLE']) ? 1 : 0 ;
		$fDAL = isset($_POST['fDAL']) ? 1 : 0 ;
		$fDEN = isset($_POST['fDEN']) ? 1 : 0 ;
		$fDET = isset($_POST['fDET']) ? 1 : 0 ;
		$fGB = isset($_POST['fGB']) ? 1 : 0 ;
		$fHOU = isset($_POST['fHOU']) ? 1 : 0 ;
		$fIND = isset($_POST['fIND']) ? 1 : 0 ;
		$fJAC = isset($_POST['fJAC']) ? 1 : 0 ;
		$fKC = isset($_POST['fKC']) ? 1 : 0 ;
		$fMIA = isset($_POST['fMIA']) ? 1 : 0 ;
		$fMIN = isset($_POST['fMIN']) ? 1 : 0 ;
		$fNE = isset($_POST['fNE']) ? 1 : 0 ;
		$fNO = isset($_POST['fNO']) ? 1 : 0 ;
		$fNYG = isset($_POST['fNYG']) ? 1 : 0 ;
		$fNYJ = isset($_POST['fNYJ']) ? 1 : 0 ;
		$fOAK = isset($_POST['fOAK']) ? 1 : 0 ;
		$fPHI = isset($_POST['fPHI']) ? 1 : 0 ;
		$fPIT = isset($_POST['fPIT']) ? 1 : 0 ;
		$fSD = isset($_POST['fSD']) ? 1 : 0 ;
		$fSEA = isset($_POST['fSEA']) ? 1 : 0 ;
		$fSF = isset($_POST['fSF']) ? 1 : 0 ;
		$fSTL = isset($_POST['fSTL']) ? 1 : 0 ;
		$fTB = isset($_POST['fTB']) ? 1 : 0 ;
		$fTEN = isset($_POST['fTEN']) ? 1 : 0 ;
		$fWSH = isset($_POST['fWSH']) ? 1 : 0 ;
		$bATL = isset($_POST['bATL']) ? 1 : 0 ;
		$bBKN = isset($_POST['bBKN']) ? 1 : 0 ;
		$bBOS = isset($_POST['bBOS']) ? 1 : 0 ;
		$bCHA = isset($_POST['bCHA']) ? 1 : 0 ;
		$bCHI = isset($_POST['bCHI']) ? 1 : 0 ;
		$bCLE = isset($_POST['bCLE']) ? 1 : 0 ;
		$bDAL = isset($_POST['bDAL']) ? 1 : 0 ;
		$bDEN = isset($_POST['bDEN']) ? 1 : 0 ;
		$bDET = isset($_POST['bDET']) ? 1 : 0 ;
		$bGSW = isset($_POST['bGSW']) ? 1 : 0 ;
		$bHOU = isset($_POST['bHOU']) ? 1 : 0 ;
		$bIND = isset($_POST['bIND']) ? 1 : 0 ;
		$bLAC = isset($_POST['bLAC']) ? 1 : 0 ;
		$bLAL = isset($_POST['bLAL']) ? 1 : 0 ;
		$bMEM = isset($_POST['bMEM']) ? 1 : 0 ;
		$bMIA = isset($_POST['bMIA']) ? 1 : 0 ;
		$bMIL = isset($_POST['bMIL']) ? 1 : 0 ;
		$bMIN = isset($_POST['bMIN']) ? 1 : 0 ;
		$bNOP = isset($_POST['bNOP']) ? 1 : 0 ;
		$bNYK = isset($_POST['bNYK']) ? 1 : 0 ;
		$bOKC = isset($_POST['bOKC']) ? 1 : 0 ;
		$bORL = isset($_POST['bORL']) ? 1 : 0 ;
		$bPHI = isset($_POST['bPHI']) ? 1 : 0 ;
		$bPHX = isset($_POST['bPHX']) ? 1 : 0 ;
		$bPOR = isset($_POST['bPOR']) ? 1 : 0 ;
		$bSAC = isset($_POST['bSAC']) ? 1 : 0 ;
		$bSAS = isset($_POST['bSAS']) ? 1 : 0 ;
		$bTOR = isset($_POST['bTOR']) ? 1 : 0 ;
		$bUTA = isset($_POST['bUTA']) ? 1 : 0 ;
		$bWAS = isset($_POST['bWAS']) ? 1 : 0 ;
		$mARI = isset($_POST['mARI']) ? 1 : 0 ;
		$mATL = isset($_POST['mATL']) ? 1 : 0 ;
		$mBAL = isset($_POST['mBAL']) ? 1 : 0 ;
		$mBOS = isset($_POST['mBOS']) ? 1 : 0 ;
		$mCHC = isset($_POST['mCHC']) ? 1 : 0 ;
		$mCHW = isset($_POST['mCHW']) ? 1 : 0 ;
		$mCIN = isset($_POST['mCIN']) ? 1 : 0 ;
		$mCLE = isset($_POST['mCLE']) ? 1 : 0 ;
		$mCOL = isset($_POST['mCOL']) ? 1 : 0 ;
		$mDET = isset($_POST['mDET']) ? 1 : 0 ;
		$mFLA = isset($_POST['mFLA']) ? 1 : 0 ;
		$mHOU = isset($_POST['mHOU']) ? 1 : 0 ;
		$mKAN = isset($_POST['mKAN']) ? 1 : 0 ;
		$mLAA = isset($_POST['mLAA']) ? 1 : 0 ;
		$mLAD = isset($_POST['mLAD']) ? 1 : 0 ;
		$mMIL = isset($_POST['mMIL']) ? 1 : 0 ;
		$mMIN = isset($_POST['mMIN']) ? 1 : 0 ;
		$mNYM = isset($_POST['mNYM']) ? 1 : 0 ;
		$mNYY = isset($_POST['mNYY']) ? 1 : 0 ;
		$mOAK = isset($_POST['mOAK']) ? 1 : 0 ;
		$mPHI = isset($_POST['mPHI']) ? 1 : 0 ;
		$mPIT = isset($_POST['mPIT']) ? 1 : 0 ;
		$mSD = isset($_POST['mSD']) ? 1 : 0 ;
		$mSF = isset($_POST['mSF']) ? 1 : 0 ;
		$mSEA = isset($_POST['mSEA']) ? 1 : 0 ;
		$mSTL = isset($_POST['mSTL']) ? 1 : 0 ;
		$mTB = isset($_POST['mTB']) ? 1 : 0 ;
		$mTEX = isset($_POST['mTEX']) ? 1 : 0 ;
		$mTOR = isset($_POST['mTOR']) ? 1 : 0 ;
		$mWAS = isset($_POST['mWAS']) ? 1 : 0 ;

		//CHECK TO SEE IF CUSTOMER EXISTS 
		$name_check = $conn->query("SELECT user_name,member_id FROM members_v0 where user_name = '$user_name'");
		$email_check = $conn->query("SELECT email FROM members_v0 where email = '$email'");
	
		$name_check = $name_check->fetch_assoc();	
		$email_check = $email_check->fetch_assoc();	

		$conn->close();
	
		//IF CUSTOMER DOESN'T EXIST THEN ADD TO DATABASE
		if(isset($name_check['user_name'])) {
			$name_dup = "var";
			echo "User Name already exists";
		} else if(isset($email_check['email'])) {
			$email_dup = "var";
			echo "Email already exists";
		} else {
			/////ADD CUSTOMER TO MYSQL DATABASE
			$conn = new mysqli("mysql.crowd-scout.net", "ca_elo_games", "cprice31!","crowdscout_main");

			$cust_insert = $conn->query("INSERT INTO members_v0 (user_name,email,password,city,state,country,zip,football,hockey,baseball,basketball,soccer,
										nfl,ncaafSEC,ncaafPAC12,ncaafACC,ncaafBIG10,ncaafBIG12,ncaafamerican,footballother,nhl,ahl,whl,ohl,ncaah,qmjhl,
										sel,smliiga,extraliga,hockeyother,mlb,iaaa,paaa,mxaaa,bbrk,ncaabase,baseballother,nba,nbadl,ncaabbPAC12,ncaabbACC,ncaabbBIGE,
										ncaabbBIG10,ncaabbBIG12,eurobb,basketballother,hANA,hBOS,hBUF,hCAR,hCBJ,hCGY,hCHI,hCOL,
										hDAL,hDET,hEDM,hFLA,hLAK,hMIN,hMTL,hNJD,hNSH,hNYI,hNYR,hOTT,
										hPHI,hPHO,hPIT,hSJS,hSTL,hTBL,hTOR,hVAN,hWPG,hWSH,fARI,fATL,
										fBAL,fBUF,fCAR,fCHI,fCIN,fCLE,fDAL,fDEN,fDET,fGB,fHOU,fIND,
										fJAC,fKC,fMIA,fMIN,fNE,fNO,fNYG,fNYJ,fOAK,fPHI,fPIT,fSD,
										fSEA,fSF,fSTL,fTB,fTEN,fWSH,bATL,bBKN,bBOS,bCHA,bCHI,bCLE,
										bDAL,bDEN,bDET,bGSW,bHOU,bIND,bLAC,bLAL,bMEM,bMIA,bMIL,bMIN,
										bNOP,bNYK,bOKC,bORL,bPHI,bPHX,bPOR,bSAC,bSAS,bTOR,bUTA,bWAS,
										mARI,mATL,mBAL,mBOS,mCHC,mCHW,mCIN,mCLE,mCOL,mDET,mFLA,mHOU,
										mKAN,mLAA,mLAD,mMIL,mMIN,mNYM,mNYY,mOAK,mPHI,mPIT,mSD,mSF,
										mSEA,mSTL,mTB,mTEX,mTOR,mWAS)					
								VALUES ('$user_name','$email','$password','$city','$state','$country','$zip','$football','$hockey','$baseball','$basketball','$soccer',
								'$nfl','$ncaafSEC','$ncaafPAC12','$ncaafACC','$ncaafBIG10','$ncaafBIG12','$ncaafamerican','$footballother','$nhl','$ahl','$whl','$ohl','$ncaah','$qmjhl',
									'$sel','$smliiga','$extraliga','$hockeyother','$mlb','$iaaa','$paaa','$mxaaa','$bbrk','$ncaabase','$baseballother','$nba','$nbadl','$ncaabbPAC12','$ncaabbACC', 
									'$ncaabbBIGE','$ncaabbBIG10','$ncaabbBIG12','$eurobb','$basketballother','$hANA','$hBOS','$hBUF','$hCAR','$hCBJ','$hCGY', 
									'$hCHI','$hCOL','$hDAL','$hDET','$hEDM','$hFLA','$hLAK','$hMIN','$hMTL','$hNJD','$hNSH', 
									'$hNYI','$hNYR','$hOTT','$hPHI','$hPHO','$hPIT','$hSJS','$hSTL','$hTBL','$hTOR','$hVAN', 
									'$hWPG','$hWSH','$fARI','$fATL','$fBAL','$fBUF','$fCAR','$fCHI','$fCIN','$fCLE','$fDAL', 
									'$fDEN','$fDET','$fGB','$fHOU','$fIND','$fJAC','$fKC','$fMIA','$fMIN','$fNE','$fNO', 
									'$fNYG','$fNYJ','$fOAK','$fPHI','$fPIT','$fSD','$fSEA','$fSF','$fSTL','$fTB','$fTEN', 
									'$fWSH','$bATL','$bBKN','$bBOS','$bCHA','$bCHI','$bCLE','$bDAL','$bDEN','$bDET','$bGSW', 
									'$bHOU','$bIND','$bLAC','$bLAL','$bMEM','$bMIA','$bMIL','$bMIN','$bNOP','$bNYK','$bOKC', 
									'$bORL','$bPHI','$bPHX','$bPOR','$bSAC','$bSAS','$bTOR','$bUTA','$bWAS','$mARI','$mATL', 
									'$mBAL','$mBOS','$mCHC','$mCHW','$mCIN','$mCLE','$mCOL','$mDET','$mFLA','$mHOU','$mKAN', 
									'$mLAA','$mLAD','$mMIL','$mMIN','$mNYM','$mNYY','$mOAK','$mPHI','$mPIT','$mSD','$mSF', 
									'$mSEA','$mSTL','$mTB','$mTEX','$mTOR','$mWAS')");
					
		//add league of interest, team of interests
		
		$user_id = $conn->query("select member_id from members_v0 where user_name = '$user_name'");		
		$user_id = $user_id->fetch_assoc();	
		$user_id = $user_id['member_id'] ;

		$_SESSION['login_user'] = $user_name;
		$_SESSION['user_id'] = $user_id;
		$_POST['getid'] = $_GET['scout'] ; 
		$getid = $_POST['getid'] - 12000 ;
		$_SESSION['getid'] = $getid ;
		//echo $getid  ;
		header('Location: profile.php');
		exit;
		
		$conn->close();
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
  
 <html>
<head>
	<meta charset="UTF-8">
	<meta name="description" content="Crowd Scouting Player Rankings">
	<meta name="keywords" content="NFL,NHL,NBA,MLB,Player,Rankings,Scout,Scouting">
		<title>Join CrowdScout</title>
		<link rel="shortcut icon" type="image/x-icon" href="images/cs-sm.ico"/>
	
		<?php include('header.php');?>
</head>
	
	
  <body>
    <div class="container">
      <div class="header">
        <h2 class="text-muted">Join the Crowd - Beat the Crowd</h2>
	
		<?php 
	if(isset($name_dup)) {
		echo    "<h3 class='bg-danger'>User name is already registered. Please try again.</h3>";
	} else if (isset($email_dup)) {
		echo    "<h3 class='bg-danger'>Email is already registered. Please try again.</h3>";
		}
	?>

      </div>

   <div class="row marketing">
        <div class="col-lg-12">
		 <form role="form" method="post" action="register.php">
			<div class="form-group">
				<label>User Name</label>
				<input name="user_name" type="text" class="form-control" placeholder="Enter User Name">
			</div>
			<div class="form-group">
				<label>Email address</label>
				<input name="email" type="email" class="form-control" placeholder="Enter Email">
			</div>
			<div class="form-group">
				<label>Password</label>
				<input name="password" type="password" class="form-control" placeholder="Enter Password">
			</div>
			<div class="form-group">
				<label>City</label>
				<input name="city" type="text" class="form-control" placeholder="Enter City">
			</div>
			<div class="form-group">
			<label for="state">State/Province</label><br>
			<select name="state">
				<option value="">Select State/Province...</option>
				<option value='AL'>Alabama</option>
				<option value='AK'>Alaska</option>
				<option value='AZ'>Arizona</option>
				<option value='AR'>Arkansas</option>
				<option value='CA'>California</option>
				<option value='CO'>Colorado</option>
				<option value='CT'>Connecticut</option>
				<option value='DE'>Delaware</option>
				<option value='DC'>District of Columbia</option>
				<option value='FL'>Florida</option>
				<option value='GA'>Georgia</option>
				<option value='GU'>Guam</option>
				<option value='HI'>Hawaii</option>
				<option value='ID'>Idaho</option>
				<option value='IL'>Illinois</option>
				<option value='IN'>Indiana</option>
				<option value='IA'>Iowa</option>
				<option value='KS'>Kansas</option>
				<option value='KY'>Kentucky</option>
				<option value='LA'>Louisiana</option>
				<option value='ME'>Maine</option>
				<option value='MD'>Maryland</option>
				<option value='MA'>Massachusetts</option>
				<option value='MI'>Michigan</option>
				<option value='MN'>Minnesota</option>
				<option value='MS'>Mississippi</option>
				<option value='MO'>Missouri</option>
				<option value='MT'>Montana</option>
				<option value='NE'>Nebraska</option>
				<option value='NV'>Nevada</option>
				<option value='NH'>New Hampshire</option>
				<option value='NJ'>New Jersey</option>
				<option value='NM'>New Mexico</option>
				<option value='NY'>New York</option>
				<option value='NC'>North Carolina</option>
				<option value='ND'>North Dakota</option>
				<option value='OH'>Ohio</option>
				<option value='OK'>Oklahoma</option>
				<option value='OR'>Oregon</option>
				<option value='PW'>Palau</option>
				<option value='PA'>Pennsylvania</option>
				<option value='PR'>Puerto Rico</option>
				<option value='RI'>Rhode Island</option>
				<option value='SC'>South Carolina</option>
				<option value='SD'>South Dakota</option>
				<option value='TN'>Tennessee</option>
				<option value='TX'>Texas</option>
				<option value='UT'>Utah</option>
				<option value='VT'>Vermont</option>
				<option value='VA'>Virginia</option>
				<option value='VI'>Virgin Islands</option>
				<option value='WA'>Washington</option>
				<option value='WV'>West Virginia</option>
				<option value='WI'>Wisconsin</option>
				<option value='WY'>Wyoming</option>
				<option value='AB'>Alberta</option>
				<option value='BC'>British Columbia</option>
				<option value='MB'>Manitoba</option>
				<option value='NB'>New Brunswick</option>
				<option value='NF'>Newfoundland</option>
				<option value='NT'>Northwest Territories</option>
				<option value='NS'>Nova Scotia</option>
				<option value='NU'>Nunavut </option>
				<option value='ON'>Ontario</option>
				<option value='PE'>Prince Edward Island</option>
				<option value='QC'>Quebec</option>
				<option value='SK'>Saskatchewan</option>
				<option value='YT'>Yukon</option>
				<option value='OTHER'>Other</option>
				</select>

			</div>		
			<div class="form-group">
			<label for="country_name">Country</label><br>
				<select name="country">
					<option value="">Select Country...</option>
					<option value="CA">Canada</option>
					<option value="US">United States</option>
					<option value="AU">Australia</option>
					<option value="AT">Austria</option>
					<option value="BR">Brazil</option>
					<option value="CN">China</option>
					<option value="CZ">Czech Republic</option>
					<option value="DK">Denmark</option>
					<option value="FI">Finland</option>
					<option value="FR">France</option>
					<option value="IT">Italy</option>
					<option value="JP">Japan</option>
					<option value="MX">Mexico</option>
					<option value="NL">Netherlands</option>
					<option value="NZ">New Zealand</option>
					<option value="RU">Russia</option>
					<option value="SK">Slovakia</option>
					<option value="SI">Slovenia</option>
					<option value="ES">Spain</option>
					<option value="SE">Sweden</option>
					<option value="CH">Switzerland</option>
					<option value="TW">Taiwan</option>
					<option value="GB">United Kingdom</option>
					<option value="OTHER">Other</option>
					</select>
			</div>
			<div class="form-group">
				<label>Zip/Postal Code</label>
				<input name="zip" type="text" class="form-control" placeholder="Enter Zip">
			</div>
			
			<!--league selector-->

			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>Followed Sports - optional</h4>
				</div>
					<div class="panel-body">
						
						<label class="checkbox-inline"><input type="checkbox" name="football" value="">Football</label>
						<label class="checkbox-inline"><input type="checkbox" name="hockey" value="">Hockey</label>
						<label class="checkbox-inline"><input type="checkbox" name="baseball" value="">Baseball</label>
						<label class="checkbox-inline"><input type="checkbox" name="basketball" value="">Basketball</label>
						<label class="checkbox-inline"><input type="checkbox" name="soccer" value="">Soccer</label>
						
					</div>
			</div>

		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  <div class="panel panel-primary">
		    <div class="panel-heading" role="tab" id="headingTwo">
		      <h4 class="panel-title">
			<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			  Followed Leagues - optional (Click to Expand)
			</a>
		      </h4>
		    </div>
		    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
		      <div class="panel-body">
				<div class="purple col-sm-3">
					<div class="panel panel-primary">
						<div class="panel-heading">Football Leagues</div>
							<div class="panel-body">
								<ul>
									<li><label class="checkbox"><input type="checkbox" name="nfl" value="">NFL</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaafSEC" value="">SEC(NCAAF)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaafPAC12" value="">PAC-12 (NCAAF)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaafACC" value="">ACC (NCAAF)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaafBIG10" value="">Big Ten (NCAAF)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaafBIG12" value="">Big 12 (NCAAF)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaafamerican" value="">American(NCAAF)</label></li>
									<input type="text" class="form-control" id="footballother" placeholder="Other (Football)">
									</ul>	
							</div>
 				</div>
  				</div>
				<div class="purple col-sm-3">
					<div class="panel panel-primary">
						<div class="panel-heading">Hockey Leagues</div>
							<div class="panel-body">
								<ul>
									<li><label class="checkbox"><input type="checkbox" name="nhl" value="">NHL</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ahl" value="">AHL</label></li>
									<li><label class="checkbox"><input type="checkbox" name="whl" value="">WHL</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ohl" value="">OHL</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaah" value="">NCAA (Hockey)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="qmjhl" value="">QMJHL</label></li>
									<li><label class="checkbox"><input type="checkbox" name="khlrus" value="">Russia (KHL, Junior)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="sel" value="">Sweden (SEL, Junior)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="smliiga" value="">Finland (SM-liiga, Junior)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="extraliga" value="">Czech (Extraliga, Junior)</label></li>
									<input type="text" class="form-control" id="hockeyother" placeholder="Other (Hockey)">
								</ul>	
							</div>
  					</div>
  				</div>  				
				<div class="purple col-sm-3">
					<div class="panel panel-primary">
						<div class="panel-heading">Baseball Leagues</div>
							<div class="panel-body">
								<ul>
									<li><label class="checkbox"><input type="checkbox" name="mlb" value="">MLB</label></li>
									<li><label class="checkbox"><input type="checkbox" name="iaaa" value="">International (AAA)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="paaa" value="">Pacific Coast (AAA)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="mxaaa" value="">Mexican (AAA)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="bbrk" value="">Rookie Leagues</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaabase" value="">NCAA (Baseball)</label></li>
									<input type="text" class="form-control" id="baseballother" placeholder="Other (Baseball)">
								</ul>	
							</div>	
  					</div>
  				</div>
				<div class="purple col-sm-3">
					<div class="panel panel-primary">
						<div class="panel-heading">Basketball Leagues</div>
							<div class="panel-body">
								<ul>
									<li><label class="checkbox"><input type="checkbox" name="nba" value="">NBA</label></li>
									<li><label class="checkbox"><input type="checkbox" name="nbadl" value="">NBADL</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaabbPAC12" value="">PAC-12 (NCAABB)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaabbACC" value="">ACC (NCAABB)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaabbBIGE" value="">Big East (NCAABB)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaabbBIG10" value="">Big Ten (NCAABB)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="ncaabbBIG12" value="">Big 12 (NCAABB)</label></li>
									<li><label class="checkbox"><input type="checkbox" name="eurobb" value="">Euroleague</label></li>
									<input type="text" class="form-control" id="basketballother" placeholder="Other (Basketball)">
								</ul>	
							</div>	
  					</div>
  				</div>	
	      </div>
		    </div>
		  </div>
		  <div class="panel panel-primary">
		    <div class="panel-heading" role="tab" id="headingThree">
		      <h4 class="panel-title">
			<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			  Followed Professional Teams - optional (Click to Expand)
			</a>
		      </h4>
		    </div>
		    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
		      <div class="panel-body">
			<div class="purple col-sm-3">
					<div class="panel panel-primary">
						<div class="panel-heading">NFL Teams</div>
							<div class="panel-body">
								<ul>
									<li><label class='checkbox'><input type='checkbox' name='fARI' value=''>ARI</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fATL' value=''>ATL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fBAL' value=''>BAL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fBUF' value=''>BUF</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fCAR' value=''>CAR</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fCHI' value=''>CHI</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fCIN' value=''>CIN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fCLE' value=''>CLE</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fDAL' value=''>DAL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fDEN' value=''>DEN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fDET' value=''>DET</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fGB' value=''>GB</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fHOU' value=''>HOU</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fIND' value=''>IND</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fJAC' value=''>JAC</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fKC' value=''>KC</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fMIA' value=''>MIA</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fMIN' value=''>MIN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fNE' value=''>NE</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fNO' value=''>NO</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fNYG' value=''>NYG</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fNYJ' value=''>NYJ</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fOAK' value=''>OAK</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fPHI' value=''>PHI</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fPIT' value=''>PIT</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fSD' value=''>SD</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fSEA' value=''>SEA</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fSF' value=''>SF</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fSTL' value=''>STL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fTB' value=''>TB</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fTEN' value=''>TEN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='fWSH' value=''>WSH</label></li>
								</ul>	
							</div>
  					</div>
  				</div>
				<div class="purple col-sm-3">
					<div class="panel panel-primary">
						<div class="panel-heading">NHL Teams</div>
							<div class="panel-body">
								<ul>
								<li><label class='checkbox'><input type='checkbox' name='hANA' value=''>ANA</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hBOS' value=''>BOS</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hBUF' value=''>BUF</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hCAR' value=''>CAR</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hCBJ' value=''>CBJ</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hCGY' value=''>CGY</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hCHI' value=''>CHI</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hCOL' value=''>COL</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hDAL' value=''>DAL</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hDET' value=''>DET</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hEDM' value=''>EDM</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hFLA' value=''>FLA</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hLAK' value=''>LAK</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hMIN' value=''>MIN</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hMTL' value=''>MTL</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hNJD' value=''>NJD</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hNSH' value=''>NSH</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hNYI' value=''>NYI</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hNYR' value=''>NYR</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hOTT' value=''>OTT</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hPHI' value=''>PHI</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hPHO' value=''>PHO</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hPIT' value=''>PIT</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hSJS' value=''>SJS</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hSTL' value=''>STL</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hTBL' value=''>TBL</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hTOR' value=''>TOR</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hVAN' value=''>VAN</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hWPG' value=''>WPG</label></li>
								<li><label class='checkbox'><input type='checkbox' name='hWSH' value=''>WSH</label></li>
								</ul>	
							</div>
  					</div>
  				</div> 
				<div class="purple col-sm-3">
					<div class="panel panel-primary">
						<div class="panel-heading">MLB Teams</div>
							<div class="panel-body">
								<ul>
									<li><label class='checkbox'><input type='checkbox' name='mARI' value=''>ARI</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mATL' value=''>ATL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mBAL' value=''>BAL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mBOS' value=''>BOS</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mCHC' value=''>CHC</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mCHW' value=''>CHW</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mCIN' value=''>CIN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mCLE' value=''>CLE</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mCOL' value=''>COL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mDET' value=''>DET</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mFLA' value=''>FLA</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mHOU' value=''>HOU</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mKAN' value=''>KAN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mLAA' value=''>LAA</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mLAD' value=''>LAD</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mMIL' value=''>MIL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mMIN' value=''>MIN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mNYM' value=''>NYM</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mNYY' value=''>NYY</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mOAK' value=''>OAK</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mPHI' value=''>PHI</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mPIT' value=''>PIT</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mSD' value=''>SD</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mSF' value=''>SF</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mSEA' value=''>SEA</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mSTL' value=''>STL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mTB' value=''>TB</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mTEX' value=''>TEX</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mTOR' value=''>TOR</label></li>
									<li><label class='checkbox'><input type='checkbox' name='mWAS' value=''>WAS</label></li>
								</ul>	
							</div>	
  				</div>	
				</div>
				<div class="purple col-sm-3">
					<div class="panel panel-primary">
						<div class="panel-heading">NBA Teams</div>
							<div class="panel-body">
								<ul>
									<li><label class='checkbox'><input type='checkbox' name='bATL' value=''>ATL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bBKN' value=''>BKN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bBOS' value=''>BOS</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bCHA' value=''>CHA</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bCHI' value=''>CHI</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bCLE' value=''>CLE</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bDAL' value=''>DAL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bDEN' value=''>DEN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bDET' value=''>DET</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bGSW' value=''>GSW</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bHOU' value=''>HOU</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bIND' value=''>IND</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bLAC' value=''>LAC</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bLAL' value=''>LAL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bMEM' value=''>MEM</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bMIA' value=''>MIA</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bMIL' value=''>MIL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bMIN' value=''>MIN</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bNOP' value=''>NOP</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bNYK' value=''>NYK</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bOKC' value=''>OKC</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bORL' value=''>ORL</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bPHI' value=''>PHI</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bPHX' value=''>PHX</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bPOR' value=''>POR</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bSAC' value=''>SAC</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bSAS' value=''>SAS</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bTOR' value=''>TOR</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bUTA' value=''>UTA</label></li>
									<li><label class='checkbox'><input type='checkbox' name='bWAS' value=''>WAS</label></li>

								</ul>	
							</div>	
  					</div>
  				</div>
				</div>
		    </div>
		  </div>
		</div>	
			<!--submit button-->
			<div>
			<input type="submit" class="btn btn-success btn-lg" value="Join the Crowd!" />
			</div>	
		</form>
		
		<br> 
			
        </div>
      </div>

	<br>

	<?php include('footer.php'); ?>

    </div> <!-- /container -->

			<!--Google Analytics-->
			<script>
				  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
				  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

				  ga('create', 'UA-66223508-1', 'auto');
				  ga('send', 'pageview');

			</script>

			<!--Google Adwords-->
			<!-- Google Code for CSSRegister Conversion Page -->
			<script type="text/javascript">
				/* <![CDATA[ */
				var google_conversion_id = 959885755;
				var google_conversion_language = "en";
				var google_conversion_format = "3";
				var google_conversion_color = "ffffff";
				var google_conversion_label = "d3TLCL-6l2wQu-PayQM";
				var google_remarketing_only = false;
				/* ]]> */
				</script>
				<script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
				</script>
				<noscript>
				<div style="display:inline;">
				<img height="1" width="1" style="border-style:none;" alt="" src="//www.googleadservices.com/pagead/conversion/959885755/?label=d3TLCL-6l2wQu-PayQM&amp;guid=ON&amp;script=0"/>
				</div>
			</noscript>

    
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>