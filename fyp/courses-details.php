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
<body id="bg">
<?php
    session_start();

	$ID = $_GET['id'];

    $servername = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "lms";
    
    $conn = mysqli_connect($servername, $dbusername, $dbpassword, $dbname);
?>
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
						<div class="menu-logo">
							<a href="index.html"><img src="assets/images/logo.png" alt=""></a>
						</div>
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
                    <h1 class="text-white">Courses Details</h1>
				 </div>
            </div>
        </div>
		<!-- Breadcrumb row -->
		<div class="breadcrumb-row">
			<div class="container">
				<ul class="list-inline">
					<li><a href="profile.php">Home</a></li>
					<li>Courses Details</li>
				</ul>
			</div>
		</div>
		<!-- Breadcrumb row END -->
        <!-- inner page banner END -->
		<div class="content-block">
		<?php 
   		 	$res = mysqli_query($conn, "Select  courseID, courseName, courseDescript, courseImage from course WHERE courseID = '".$ID."'");
    		$queryResult = mysqli_num_rows($res);

    		if($queryResult > 0)
            {
                    while($row =mysqli_fetch_array($res))
                    {                                              
    	?>	
            <!-- About Us -->
			<div class="section-area section-sp1">
                <div class="container">
					 <div class="row d-flex flex-row-reverse">
						<div class="col-lg-3 col-md-4 col-sm-12 m-b30">			
						</div>
						<div class="col-lg-9 col-md-8 col-sm-12">
							<div class="courses-post">
								<div class="ttr-post-media media-effect">
									<?php echo '<img src="data:image;base64,'.base64_encode($row['courseImage']) .'" height="100" width="100">'; ?>
								</div>
								<div class="ttr-post-info">
									<div class="ttr-post-title ">
										<h2 class="post-title"><?php echo $row['courseName']?></h2>
									</div>
									<?php
									
									?>
									<div class="ttr-post-text">
										<p>Course Progress</p>
										<!--Value = where video status = done -->
										<!--Max = count all value WHERE courseID = $ID -->
										<?php
											$a = mysqli_query($conn, "SELECT COUNT(*) FROM coursecontent WHERE courseID = $ID");											
											while($row1 = mysqli_fetch_assoc($a))
											{											
												$getCount = $row1['COUNT(*)'];
												
												$b = mysqli_query($conn, "SELECT COUNT(*) FROM coursecontent WHERE courseID = $ID AND status = 'Completed'");
												while($row2 = mysqli_fetch_assoc($b))
												{
													$getCountCompleted = $row2['COUNT(*)'];									
										?>
												 <?php echo "Progress: $getCountCompleted / $getCount" ?>
												 <br>
												 <progress id="prog" value="<?php echo $getCountCompleted ?>" max="<?php echo $getCount; ?>"></progress> 
												 
										<?php
												}
												
											}																			
										?>                                    
									</div>
								</div>
							</div>
							<div class="courese-overview" id="overview">
								<h4>Overview</h4>
								<div class="row">
									<div class="col-md-12 col-lg-8">
										<h5 class="m-b5">Course Description</h5>
										<p><?php echo $row['courseDescript']?></p>									
									</div>
								</div>
							</div>
							<div class="m-b30" id="curriculum">
								<h4>Video</h4>
								<?php
									$fetchVideos = mysqli_query($conn, "SELECT * FROM coursecontent WHERE courseID = $ID");
									while($row = mysqli_fetch_assoc($fetchVideos)){						
									$videoName = $row['videoName'];
									$videoDes = $row['videoDes'];
									$getCourseStatus = $row['status'];
								?>
								<ul class="curriculum-list">
										<li>
											<ul>
												<li>
													<div class="curriculum-list-box">
														<?php echo $videoName;?>
														<br>
														<?php echo "Description: $videoDes";?>
													</div>
													<span><a href="courseVideo.php?id=<?php echo $row['videoID']?>" class="btn">Go</a></span>
													
													
												</li>
												<?php
														echo $getCourseStatus;
													?>
											</ul>
										</li>
									</ul>
								<?php
									}
								?>
							</div>										
						</div>				
					</div>
				</div>
            </div>
        </div>
		<!-- contact area END -->
		
    </div>
    <!-- Content END-->
	<?php
					}		
				}
	?>
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
</body>

</html>
