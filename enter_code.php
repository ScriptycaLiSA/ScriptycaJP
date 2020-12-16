<!--Coded by Montizon, Jake G.
	Bachelor of Science in Information Technology 3-B -->
	<?php
	// Initialize the session
	session_start();

	// Check if the user is logged in, if not then redirect him to login page
	if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
	    header("location: index.php");
	    exit;
	}
	?>

<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Put your Progress Code or Create one! | Scriptyca, #1 Online Japanese Language Platform</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="msapplication-config" content="path-to-browserconfig/browserconfig.xml/">

	<!-- Touch Icons - iOS and Android 2.1+ 180x180 pixels in size. -->
	<link rel="apple-touch-icon-precomposed" href="assets/favicon/apple-touch-icon.png">

	<!-- Firefox, Chrome, Safari, IE 11+ and Opera. 196x196 pixels in size. -->
	<link rel="icon" href="assets/favicon/android-chrome-192x192.png">

	<!--bootstrap.css implementation-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/scriptyca.css">

	<!--bootstrap.js implementation-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://use.fontawesome.com/releases/v5.0.8/js/all.js"></script>
</head>
<body>
	<nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          	<a class="navbar-brand" href="\ITPC-109-3B\index.php"><img class="rounded-circle" src="assets/resources/images/scriptyca.png" alt="navBrand"/ style="height: 50px; width: 50px;"></a>
		  	</div>
		  	<div class="rounded-circle">
			  	<img class="" src="assets/resources/images/hiragana.png" alt="userImg" style="height: 50px; width: auto;">
		  	</div>
      </div>
  </nav>
		<nav class="navbar navbar-expand-md navbar-dark sticky-top">
			<div class="container-fluid">
				<div class="navbar-header">
        	<a class="nav-link active" href="index.php" style="color: #a8d8f6;">
						Home
					</a>
		  	</div>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarResponsive">
						<ul class="navbar-nav ml-auto">
							<li class="nav-item dropdown">
	            	<a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Learn Japanese</a>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton"style="padding: 8px; padding-bottom: 10px; background-color: cyan;">
										<a class="dropdown-item" href="learn_japanese.php">Learn Japanese</a>
										<div class="dropdown-divider"></div>
    								<a class="dropdown-item disabled" href="#">HIRAGANA</a>
    								<a class="dropdown-item disabled" href="#">KATAKANA</a>
    								<a class="dropdown-item disabled" href="#">KANJI</a>
  								</div>
							<li class="nav-item">
								<a class="nav-link" href="about_community.php">About Community</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="contact_dev.php">Contact Developer</a>
							</li>
						</ul>
					</div>
			</div>
		</nav>
		<header>
			<div class="text text-center">
				<p class="h3 display-3">Welcome to Scriptyca</p>
				<p class="lead">#1 Online Japanese Language Platform</p>
			</div>
		</header>
			<div class="form-group" style="padding: 25px; padding-left: 4rem; padding-right: 4rem;">
				<input class="form-control form-control-lg text-center text-uppercase" id="cQuery" type="text" name="code" maxlength="6" placeholder="PLEASE ENTER 6 ALPHANUM CODE HERE!"><br>
			</div>
			<div class="container">
        <div class="btn btn-block btn-lg">
					<a href="toolsets/lesson_selector.php">
          	<input class="btn btn-primary" type="submit" id="btnWelcome" name="submit" value="ENTER">
					</a>
          <p class="lead">OR</p>
          <input class="btn btn-primary" type="submit" id="btnWelcome" name="submit" value="CREATE LESSONS NOW!">
        </div>
			</div>
			<div class="testing phase">
				<p class="lead text-center"></p>
			</div>
</body>
</html>
