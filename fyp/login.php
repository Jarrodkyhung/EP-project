<!DOCTYPE html>
<html lang="en">


<head>
	
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="assets/images/favicon.ico" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>Login</title>
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link class="skin" rel="stylesheet" type="text/css" href="assets/css/color/color-1.css">
	
</head>
<body id="bg">

<div class="page-wraper">
	<div id="loading-icon-bx"></div>
	<div class="account-form">
		<div class="account-head" >		
		</div>
		<div class="heading-bx left">					
			<h2 class="title-head">LMSExperience</h2>
			<h2 class="title-head">Learning Management System</h2>						
		</div>
		<div class="account-form-inner">
			<div class="account-container">
				<div class="heading-bx left">
					<h2 class="title-head">Login to your <span>Account</span></h2>					
				</div>
			<?php
			session_start();

			if(isset($_POST["login"]))
			{		
				$servername = "localhost";
				$username = "root";
				$password = "";
				$dbname = "lms";
				
				//Create connection
				$conn = mysqli_connect($servername, $username, $password, $dbname);
				
				//Check connection
				if(!$conn)
				{
					die("Connection failed: ".mysqli_connect_error());
				}
				else
				{
					$username = $_POST['username'];
					$password = $_POST['password'];
					
					$query ="SELECT * FROM account WHERE username='".$username."' AND password = '".$password."'";
					
					$results = mysqli_query($conn, $query);
					while($row = mysqli_fetch_assoc($results))
					{
						$getUserID = $row['id'];
						$getUserName = $row['username'];
						$getUserType = $row['user_type'];
						$getUserPassword = $row['password'];
					}
				
					if($getUserType == "admin")
					{
						$_SESSION['user'] = $logged_in_user;                     
						echo"<script> alert('Welcome $getUserName !');
						window.location=\"admin/adminIndex.php\";
									</script>";
					}	
					elseif($getUserType == "user")
					{
						$_SESSION['user']= $logged_in_user;
						$_SESSION['id'] = $getUserID;
						$_SESSION['username'] = $username;
						echo"<script> alert('Welcome $getUserName !');
						window.location=\"profile.php\";
									</script>";

					} 
					else 
					{
						echo "<script> alert('Wrong Username or Password!');
						window.location=\"login.php\";
									</script>";
					}           
									
					
                }
                mysqli_close($conn);
            }
            else
            {
        ?>	
				<form class="contact-bx" action="#" method="post">
					<div class="row placeani">
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group">
									<label>Username</label>
									<input name="username" type="text" class="form-control" Required>
								</div>
							</div>
						</div>
						<div class="col-lg-12">
							<div class="form-group">
								<div class="input-group"> 
									<label>Your Password</label>
									<input name="password" type="password" class="form-control" Required>
								</div>
							</div>
						</div>			
						<div class="col-lg-12 m-b30">
							<button name="login" type="submit" class="btn button-md">Login</button>
						</div>						
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
			<?php
			}
			?>
<!-- External JavaScripts -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/vendors/bootstrap/js/popper.min.js"></script>
<script src="assets/vendors/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/vendors/bootstrap-select/bootstrap-select.min.js"></script>
<script src="assets/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js"></script>
<script src="assets/vendors/magnific-popup/magnific-popup.js"></script>
<script src="assets/vendors/counter/waypoints-min.js"></script>
<script src="assets/vendors/counter/counterup.min.js"></script>
<script src="assets/vendors/imagesloaded/imagesloaded.js"></script>
<script src="assets/vendors/masonry/masonry.js"></script>
<script src="assets/vendors/masonry/filter.js"></script>
<script src="assets/vendors/owl-carousel/owl.carousel.js"></script>
<script src="assets/js/functions.js"></script>
<script src="assets/js/contact.js"></script>
</body>

</html>
