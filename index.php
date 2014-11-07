<?php
  session_start();

  // If the session vars aren't set, try to set them with a cookie
/*  if (!isset($_SESSION['user_id'])) {
    if (isset($_COOKIE['user_id']) && isset($_COOKIE['username'])) {
      $_SESSION['user_id'] = $_COOKIE['user_id'];
      $_SESSION['username'] = $_COOKIE['username'];

    }
  }
*/
?>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>

<?php
  require_once('connectvars.php');

  // Generate the navigation menu
  if (isset($_SESSION['username'])) {
    if($_SESSION['adminornot'] == '1') {
    // echo '&#10084; <a href="permission.php">Grant Permission</a><br />';
    // echo '&#10084; <a href="editprofile.php">Edit Profile</a><br />';
    // echo '&#10084; <a href="index2.php">ADD A PERSON</a><br />';
    // echo '&#10084; <a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
      header("Location: admin_index.php");
    }
    else {
    echo 'you are not an admin';
    echo '&#10084; <a href="logout.php">Log Out (' . $_SESSION['username'] . ')</a>';
    }
  }
  else {
    header("Location: login.php");
    // echo '&#10084; <a href="login.php">Log In</a><br />';
    // echo '&#10084; <a href="signup.php">Sign Up</a>';
  }

  // Connect to the database 
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME); 

  mysqli_close($dbc);
?>

</body> 
</html>
