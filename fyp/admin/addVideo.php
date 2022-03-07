<!DOCTYPE html>
<html lang="en">

<head>
	<!-- FAVICONS ICON ============================================= -->
	<link rel="icon" href="../error-404.html" type="image/x-icon" />
	
	<!-- PAGE TITLE HERE ============================================= -->
	<title>Add course</title>
	
	<!-- All PLUGINS CSS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/assets.css">
	<link rel="stylesheet" type="text/css" href="assets/vendors/calendar/fullcalendar.css">
	
	<!-- TYPOGRAPHY ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/typography.css">
	
	<!-- SHORTCODES ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/shortcodes/shortcodes.css">
	
	<!-- STYLESHEETS ============================================= -->
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/dashboard.css">
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
<body class="ttr-opened-sidebar ttr-pinned-sidebar">
	
	<!-- header start -->
		<header class="ttr-header">
		<div class="ttr-header-wrapper">
			<!--sidebar menu toggler start -->
			<div class="ttr-toggle-sidebar ttr-material-button">
				<i class="ti-close ttr-open-icon"></i>
				<i class="ti-menu ttr-close-icon"></i>
			</div>
			<!--sidebar menu toggler end -->
			<div class="ttr-header-menu">
				<!-- header left menu start -->
				<ul class="ttr-header-navigation">
					<li>
						<a href="adminIndex.php" class="ttr-material-button ttr-submenu-toggle">HOME</a>
					</li>			
				</ul>
				<!-- header left menu end -->
			</div>
			<div class="ttr-header-right ttr-with-seperator">
				<!-- header right menu start -->
				<ul class="ttr-header-navigation">			
					<li>
						<a href="#" class="ttr-material-button ttr-submenu-toggle"><span class="ttr-user-avatar"><img alt="" src="assets/images/testimonials/pic3.jpg" width="32" height="32"></span></a>
						<div class="ttr-header-submenu">
							<ul>
								<li><a href="logout.php">Logout</a></li>
							</ul>
						</div>
					</li>					
				</ul>
				<!-- header right menu end -->
			</div>
			<!--header search panel start -->
			<div class="ttr-search-bar">
				<form class="ttr-search-form">
					<div class="ttr-search-input-wrapper">
						<input type="text" name="qq" placeholder="search something..." class="ttr-search-input">
						<button type="submit" name="search" class="ttr-search-submit"><i class="ti-arrow-right"></i></button>
					</div>
					<span class="ttr-search-close ttr-search-toggle">
						<i class="ti-close"></i>
					</span>
				</form>
			</div>
			<!--header search panel end -->
		</div>
	</header>
	<!-- header end -->
	<!-- Left sidebar menu start -->
		<div class="ttr-sidebar">
		<div class="ttr-sidebar-wrapper content-scroll">
			<!-- side menu logo start -->
			<div class="ttr-sidebar-logo">
				<div class="ttr-sidebar-toggle-button">
					<i class="ti-arrow-left"></i>
				</div>
			</div>
			<!-- side menu logo end -->
			<!-- sidebar menu start -->
			<nav class="ttr-sidebar-navi">
				<ul>
					<li>
						<a href="adminIndex.php" class="ttr-material-button">
							<span class="ttr-icon"><i class="ti-home"></i></span>
		                	<span class="ttr-label">Dashboard</span>
		                </a>
		            </li>
					<li>
						<a href="bookmark.php" class="ttr-material-button">
							<span class="ttr-icon"><i class="ti-book"></i></span>
		                	<span class="ttr-label">Courses</span>
		                </a>
		            </li>
					<li>
						<a href="userAddCourse.php" class="ttr-material-button">
							<span class="ttr-icon"><i class="ti-book"></i></span>
		                	<span class="ttr-label">User Add Course</span>
		                </a>
		            </li>	
		            <li class="ttr-seperate"></li>
				</ul>
				<!-- sidebar menu end -->
			</nav>
			<!-- sidebar menu end -->
		</div>
	</div>
	<!-- Left sidebar menu end -->

	<!--Main container start -->
	<main class="ttr-wrapper">
		<div class="container-fluid">
			<div class="db-breadcrumb">
				<h4 class="breadcrumb-title">Add Video</h4>
				<ul class="db-breadcrumb-list">
					<li><a href="adminIndex.php"><i class="fa fa-home"></i>Dashboard</a></li>
					<li>Courses</li>
					<li>Add Video</li>
				</ul>
			</div>	
			<div class="row">
				<!-- Your Profile Views Chart -->
				<div class="col-lg-12 m-b30">
					<div class="widget-box">
						<div class="wc-title">
							<h4>Add Video<?php echo $ID;
							?></h4>
							
						</div>									
						<?php
								if(isset($_POST['submit']))
								{
									$maxsize = 52428800; // 5MB
									if(isset($_FILES['file']['name']) && $_FILES['file']['name'] != '')
									{
										$courseID = $ID;									
										$videoName = $_POST['videoName'];
										$videoDes = $_POST['videoDes'];
										$name = $_FILES['file']['name'];
										$target_dir = "videos/";
										$target_file = $target_dir . $_FILES["file"]["name"];
								 
										// Select file type
										$extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
								 
										// Valid file extensions
										$extensions_arr = array("mp4","avi","3gp","mov","mpeg");
								 
										// Check extension
										if( in_array($extension,$extensions_arr) )
										{
								  
										   // Check file size
										   if(($_FILES['file']['size'] >= $maxsize) || ($_FILES["file"]["size"] == 0))
										   {
											  $_SESSION['message'] = "File too large. File must be less than 5MB.";
										   }
										   else
										   {
											  // Upload
											  if(move_uploaded_file($_FILES['file']['tmp_name'],$target_file)){
												// Insert record
												$query = "INSERT INTO coursecontent(name,location, videoName, videoDes, courseID) VALUES('".$name."','".$target_file."', '$videoName', '$videoDes', '$courseID')";
								 
												mysqli_query($conn,$query);
												$_SESSION['message'] = "Upload successfully.";
											  }
										   }
								 
										}else
										{
										   $_SESSION['message'] = "Invalid file extension.";
										}
									}
									else
									{
										$_SESSION['message'] = "Please select a file.";
									}
									echo "<script> alert('Video Added!');
									window.location=\"addVideo.php\";
									</script>;";
									
									exit;
								 } 
						?>
						<div class="widget-inner">
							<form class="edit-profile m-b30" method="post" action="" enctype="multipart/form-data">
								<div class="row">
									<div class="col-12">
										<div class="ml-auto">
											<h3>1. Video title</h3>
										</div>
									</div>
									<div class="form-group col-6">
										<div>
											<input class="form-control" type="text" value="" name="videoName" required>
										</div>
									</div>								
									<div class="seperator"></div>
									<div class="col-12">
										<div class="ml-auto">
											<h3>2. Video Description</h3>
										</div>
									</div>									
									<div class="form-group col-6">								
										<div>
											<input class="form-control" type="text" value="" name="videoDes" required>
										</div>
									</div>								
									<div class="col-12 m-t20">
										<div class="ml-auto m-b5">
											<h3>3. Course Video</h3>
										</div>
									</div>
									<input type="file" name="file" class="btn-secondry add-item m-r5" required>
									<br>
									<br>																		
									<div class="col-12 m-t20">
										<button type="submit" class="btn-secondry add-item m-r5" name="submit"><i class="fa fa-fw fa-plus-circle"></i>Add Video</button>
									</div>


								</div>
							</form>
						</div>
					</div>
				</div>
				<!-- Your Profile Views Chart END-->
			</div>
		</div>
	</main>
	<div class="ttr-overlay"></div>

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
<script src='assets/vendors/scroll/scrollbar.min.js'></script>
<script src="assets/js/functions.js"></script>
<script src="assets/vendors/chart/chart.min.js"></script>
<script src="assets/js/admin.js"></script>
</body>

</html>