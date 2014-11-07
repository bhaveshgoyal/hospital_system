<?php
  require_once('connectvars.php');

  // Start the session
  session_start();

  // Clear the error message
  $error_msg = "";

  // If the user isn't logged in, try to log them in
  if (!isset($_SESSION['user_id'])) {
    if (isset($_POST['submit'])) {
      // Connect to the database
      $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

      // Grab the user-entered log-in data
      $user_username = mysqli_real_escape_string($dbc, trim($_POST['username']));
      $user_password = mysqli_real_escape_string($dbc, trim($_POST['password']));

      if (!empty($user_username) && !empty($user_password)) {
        // Look up the username and password in the database
        $query = "SELECT * FROM users WHERE user_name = '$user_username' AND password = SHA('$user_password')";
        $data = mysqli_query($dbc, $query);

        if (mysqli_num_rows($data) == 1) {
          // The log-in is OK so set the user ID and username session vars (and cookies), and redirect to the home page
          $row = mysqli_fetch_array($data);
          if($row['permission'] == '1') {
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['user_name'];
          $_SESSION['emptype'] = $row['emp_type'];
          $_SESSION['adminornot'] = $row['admin_or_not'];
//          setcookie('user_id', $row['user_id'], time() + (60 * 60 * 24 * 30));    // expires in 30 days
//          setcookie('username', $row['user_name'], time() + (60 * 60 * 24 * 30));  // expires in 30 days
          $home_url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']) . '/index.php';
          header('Location: ' . $home_url);
         }
         else {
         $error_msg = 'Sorry, the admin hs not yet granted you the rights to log-in.';
        }
        }
        else {
          // The username/password are incorrect so set an error message
          $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
      }
      else {
        // The username/password weren't entered so set an error message
        $error_msg = 'Sorry, you must enter your username and password to log in.';
      }
    }
  }
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css " />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" />
  <title>Login | Hospital Portal</title>

    <style>
@import url(http://fonts.googleapis.com/css?family=Exo:100,200,400);
@import url(http://fonts.googleapis.com/css?family=Source+Sans+Pro:700,400,300);

body{
  overflow: hidden;
  margin: 0;
  padding: 0;
  background: #fff;

  color: #fff;
  font-family: Arial;
  font-size: 12px;
}

.body{
  position: absolute;
  top: -20px;
  left: -20px;
  right: -40px;
  bottom: -40px;
  width: auto;
  height: auto;
  background-image: url(img/Columbia.jpg);
  background-size: cover;

   background-position:0% 28%;
  -webkit-filter: blur(5px);
  z-index: 0;
}

.grad{
  position: absolute;
  top: -20px;
  left: -20px;
  right: -40px;
  bottom: -40px;
  width: auto;
  height: auto;
  background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(0,0,0,0)), color-stop(100%,rgba(0,0,0,0.65))); /* Chrome,Safari4+ */
  z-index: 1;
  opacity: 0.7;
}
.entire{
  display: none;
}
.header{
  position: absolute;
  top: calc(50% - 35px);
  left: calc(50% - 255px);
  z-index: 2;
}

.header div{
  float: left;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 35px;
  font-weight: 200;
}

.header div span{
  color: #3D352A !important;
}

.login{
  position: absolute;
  top: calc(50% - 75px);
  left: calc(50% - 50px);
  height: 150px;
  width: 350px;
  padding: 10px;
  z-index: 2;
}

.login input[type=text]{
  width: 250px;
  height: 30px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
}

.login input[type=password]{
  width: 250px;
  height: 30px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
  margin-top: 10px;
}

.login input[type=submit], input[type=button]{
  width: 260px;
  height: 35px;
  background: #fff;
  border: 1px solid #fff;
  cursor: pointer;
  border-radius: 2px;
  color: #a18d6c;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 6px;
  margin-top: 10px;
}

.login input[type=submit]:hover, input[type=button]:hover{
  opacity: 0.8;
}

.login input[type=submit]:active, input[type=button]:active{
  opacity: 0.6;
}
.selectlabel{
  font-weight: 400;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
}
.login input[type=text]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=submit]:focus, input[type=button]:focus{
  outline: none;
}
/*input:-webkit-autofill {
    -webkit-box-shadow: 0 0 0px 1000px rgba(255,255,255,0.6) inset;
}*/
 
::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6) !important;
}
::-moz-input-placeholder{
   color: rgba(255,255,255,0.6) !important;
}
</style>

    <script src="js/prefixfree.min.js"></script>

</head>

<body>
<?php
  // If the session var is empty, show any error message and the log-in form; otherwise confirm the log-in
  if (empty($_SESSION['user_id'])) {
    console.log($error_msg);
    echo '<p class="error">' . $error_msg . '</p>';
?>
  <div class="body"></div>
    <div class="grad"></div>
    <div class="entire">
    <div class="header">
      <div>Login<span>&nbsp;Here</span></div>
    </div>
    <br>
    <div class="login">
        
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off" >
        <input type="text" placeholder="username" name="username" value="" autocomplete="off"><br>
        <input type="password" placeholder="password" name="password" value="" autocomplete="off"><br>
        <input type="submit" value="Login" name="submit" /><br /><br />
        
        <label for="type" class = "selectlabel" >New User ?</label>
        <input type="button" value="Signup" onclick="location.href = 'signup.php';" />
      </form>
    </div>
  </div>
  <script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

<?php
  }
  else {
    // Confirm the successful log-in
    echo('<p class="login">You are logged in as ' . $_SESSION['username'] . '</p>');
  }
?>
   
</body>

</html>
 <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script src='js/bootstrap.js'></script> 
    <!-- Metis Menu Plugin JavaScript -->
    <script src="js/plugins/metisMenu/metisMenu.min.js"></script>

<script>
$(document).ready(function(){
//   if ($.browser.webkit) {
//     $('input[name="password"]').attr('autocomplete', 'off');
//     $('input[name="username"]').attr('autocomplete', 'off');
// }
    // to fade in on page load
    // $(".entire").css("display", "none");
    $(".entire").fadeIn(); 
     });
</script>
    <!-- Custom Theme JavaScript -->
