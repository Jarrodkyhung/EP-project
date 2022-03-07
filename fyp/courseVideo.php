<!DOCTYPE html>
<html lang="en">

<head>

	<!-- META ============================================= -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>Course Detail</title>
	
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
<?php
    session_start();

	$ID = $_GET['id'];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "lms";
    
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
?>
<body id="bg">
<div class="page-wraper">
<div id="loading-icon-bx"></div>
<!-- Header Top ==== -->
    <header class="header rs-nav">
		<div class="top-bar">
			<div class="container">
				<div class="row d-flex justify-content-between">
					<div class="topbar-left">
					</div>
					<div class="topbar-right">
						<ul>					
							<li><a href="admin/logout.php">Logout</a></li>						
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="sticky-header navbar-expand-lg">
            <div class="menu-bar clearfix">
                <div class="container clearfix">
					<!-- Header Logo ==== -->
					<div class="menu-logo">
						<a href="index.html"><img src="" alt=""></a>
					</div>
	
					<!-- Author Nav ==== -->
                    <div class="secondary-menu">
                        <div class="secondary-inner">
                            <ul>
								<!-- Search Button ==== -->
								<li class="search-btn"><button id="quik-search-btn" type="button" class="btn-link"><i class="fa fa-search"></i></button></li>
							</ul>
						</div>
                    </div>
					<!-- Navigation Menu ==== -->
                    <div class="menu-links navbar-collapse collapse justify-content-start" id="menuDropdown">
						
                        <ul class="nav navbar-nav">	
							<li class="active"><a href="profile.php">Home</a>							
							</li>																		
						</ul>					
                    </div>
					<!-- Navigation Menu END ==== -->
                </div>
            </div>
        </div>
    </header>
    <!-- header END ==== -->
    <!-- Content -->
    <div class="page-content bg-white">
        <!-- inner page banner -->
        <div class="page-banner ovbl-dark">
            <div class="container">
                <div class="page-banner-entry">
                    <h1 class="text-white">Video</h1>
				 </div>
            </div>
        </div>
        <!-- inner page banner END -->
		<div class="content-block">
            <!-- About Us -->
			<?php
				$fetchVideos = mysqli_query($conn, "SELECT * FROM coursecontent WHERE videoID = $ID");
				while($row = mysqli_fetch_assoc($fetchVideos)){
				$location = $row['location'];
				$name = $row['name'];
				$getStatus = $row['status'];
				$courseID = $row['courseID'];
			?>
			<div class="section-area section-sp1">
                <div class="container">
					 <div class="row d-flex flex-row-reverse">
						
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="courses-post">
								<div class="video_alignment">
									<?php
										echo "<video src='".$location."' controls width='900px' height='900px' ></video>";
									?>
									<form action="#" method="post">
									<input type="submit" value="Complete" name="complete" class="btn">
									</form>
									<?php
									if(isset($_POST['complete']))
									{
										$a = "UPDATE coursecontent SET status='Completed' WHERE videoID = '$ID'";
										$b = mysqli_query($conn, $a);
										echo "<script> alert('Video Completed!'); window.location=\"courses-details.php?id=$courseID\";</script>"; 
									
									}
									?>
								</div>							
							</div>																		
						</div>				
					</div>
				</div>
            </div>
        </div>
		<?php
			}
		?>
		<!-- contact area END -->
		
    </div>
    <!-- Content END-->
	<!-- Footer ==== -->
   <footer>
        <div class="footer-top">
			<div class="pt-exebar">
				<div class="container">
					<div class="d-flex align-items-stretch">
						<div class="pt-logo mr-auto">
							<a href="index.html"><img src="" alt=""/></a>
						</div>
					
				
					</div>
				</div>
			</div>
        </div>
    </footer>
    <!-- Footer END ==== -->
    <button class="back-to-top fa fa-chevron-up" ></button>
</div>
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
<script src="assets/js/jquery.scroller.js"></script>
<script src="assets/js/functions.js"></script>
<script src="assets/js/contact.js"></script>
<script>

</script>
</body>

</html>
