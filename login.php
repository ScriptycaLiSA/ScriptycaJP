<?php
// Initialize the session
session_start();

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: index.php");
    exit;
}

// Include config file
require_once "php_action/php-configs.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users_auth WHERE username = ?";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();

                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){
                    // Bind result variables
                    $stmt->bind_result($id, $username, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: index.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $mysqli->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Welcome Weeb! | Scriptyca, #1 Online Japanese Language Platform</title>
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
    </header>
    <div class="col-sm-4 col-md col-lg">
      <div class="wrapper text-center lead" style="margin-left: 20%; margin-right: 20%;">
          <h2>Login</h2>
          <p>Please fill in your credentials to login.</p>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
              <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control text-center" value="<?php echo $username; ?>" placeholder="@Username here">
                  <span class="help-block"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control text-center" placeholder="Password Here">
                  <span class="help-block"><?php echo $password_err; ?></span>
              </div>
              <div class="form-group">
                  <input type="submit" class="btn btn-primary" value="Login">
              </div>
              <p>Don't have an account? <a href="signUp.php">Sign up now</a>.</p>
          </form>
      </div>
    </div>
    <div class="container text-center">
      <div class="row">
        <div class="col-sm-4">
          <span><img src="assets\resources\images\hiragana.png" alt="hiragana" class="rounded"></span>
          <p class="display-5">HIRAGANA</p>
        </div>
        <div class="col-sm-4">
          <span><img src="assets\resources\images\katakana.png" alt="katakana" class="rounded"></span>
          <p class="display-5">KATAKANA</p>
        </div>
        <div class="col-sm-4">
          <span><img src="assets\resources\images\kanji.png" alt="kanji" class="rounded"></span>
          <p class="display-5">KANJI</p>
        </div>
      </div>
    </div>
</body>
</html>
