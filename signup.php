<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Hospital - Sign Up</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css " />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" />
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
  filter : blur(5px);
   background-position:0% 28%;
  -webkit-filter: blur(5px);
   -moz-filter: blur(5px);
  -o-filter: blur(5px);
  -ms-filter: blur(5px);
  z-index: 0;
}
h1{
  font-family: 'Exo', sans-serif;
  margin-top: 1.4em;
 font-weight: 400;
  margin-left: 1.3em;
 color: #FFFFFF;
}
.sub{
  font-family: 'Exo', sans-serif;
  margin-top: 1.4em;
 font-weight: 400;
 color: #FFFFFF;
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
  top: calc(50% - 120px);
  left: calc(50% - 50px);
  height: 150px;
  width: 350px;
  padding: 10px;
  z-index: 2;
}

.login input[type=text]{
  width: 250px;
  height: 40px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #fff;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding: 4px;
  padding-bottom: 15px;
  padding-top: 15px;
}

.login input[type=password]{
  width: 250px;
  height: 40px;
  background: transparent;
  border: 1px solid rgba(255,255,255,0.6);
  border-radius: 2px;
  color: #FFFFFF;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
  font-weight: 400;
  padding-top : 15px;
  padding-bottom: 15px;
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
#frame{
  position: absolute;
  top: calc(50% - 400px);
  vertical-align: top !important;
  border-style: none; 
  width: 50%; 
  height: 100px;
}
.login input[type=submit]:hover, input[type=button]:hover{
  opacity: 0.8;
}

.login input[type=submit]:active, input[type=button]:active{
  opacity: 0.6;
}

.login input[type=text]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}

.login input[type=password]:focus{
  outline: none;
  border: 1px solid rgba(255,255,255,0.9);
}
.entire{
  display: none;
}
.login input[type=submit]:focus, input[type=button]:focus{
  outline: none;
}
.selectlabel{
  font-weight: 400;
  font-family: 'Exo', sans-serif;
  font-size: 16px;
}
.empsel{
  width : 16px;
  font-size: 16px;
  font-family: 'Exo' , sans-serif;
  font-weight: 400;
}
::-webkit-input-placeholder{
   color: rgba(255,255,255,0.6) !important;
}

::-moz-input-placeholder{
   color: rgba(255,255,255,0.6) !important;
}
</style>
</head>
<body>
  <h3>Hospital - Sign Up</h3>

<?php
  require_once('connectvars.php');

  // Connect to the database
  $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

  if (isset($_POST['submit'])) {
    // Grab the profile data from the POST
    $username = mysqli_real_escape_string($dbc, trim($_POST['username']));
    $password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
    $type = $_POST['emptype'];


    if (!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
      // Make sure someone isn't already registered using this username
      $query = "SELECT * FROM users WHERE user_name = '$username'";
      $data = mysqli_query($dbc, $query);
      if (mysqli_num_rows($data) == 0) {
        // The username is unique, so insert the data into the database
        $query = "INSERT INTO users VALUES ('0','$username', SHA('$password1'), '$type', '0', '0')";
        mysqli_query($dbc, $query);

        // Confirm success with the user
        // echo '<div class="alert alert-info" role="alert" style="width:auto;height:auto;">Your new account has been successfully created. You\'re now ready to <a href="login.php">Log in</a>.</div>';
        header('Location: login.php ');
        mysqli_close($dbc);
        exit();
      }
      else {
        // An account already exists for this username, so display an error message
        echo '<p class="error">An account already exists for this username. Please use a different address.</p>';
        $username = "";
      }
    }
    else {
      echo '<p class="error">You must enter all of the sign-up data, including the desired password twice.</p>';
    }
  }

  mysqli_close($dbc);
?>

  <div class="body"></div>
    <div class="grad"><h1>Columbia Asia<span class="sub"> Management Portal</span></h1></div></div>
    <div class="entire">
    <div class="header">
      <div>Sign<span>&nbsp;Up</span></div>
    </div>
    <br>
    <div class="login">
  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" autocomplete="off">
      <input type="text" id="username" placeholder = "username" name="username" value="<?php if (!empty($username)) echo $username; ?>" /><br />

      <input type="password" id="password1" placeholder="password" name="password1" /><br />
      <input type="password" id="password2" placeholder="confirm password" name="password2" /><br /> <br />
      <label for="type" class = "selectlabel" >Select Employee Type</label>
      <table><tr><td><input type="radio" id="emptype" class="empsel" name="emptype" value="admin"></td><td><label class="selectlabel">Admin</label></td></tr>
      <tr><td><input type="radio" id="emptype" class="empsel" name="emptype" value="emp"></td><td><label class="selectlabel">Employee</label></td></tr></table>

    <input type="submit" value="Sign Up" name="submit" /><br /><br />
        <label for="type" class = "selectlabel" >Already Registered ?</label>
        <input type="button" value="Login" onclick="location.href = 'login.php';" />
  </form>
</div>
<iframe id = "frame" name="myIframe" frameborder="0" border="0" align="top"></iframe>
</div>
<script src='http://codepen.io/assets/libs/fullpage/jquery.js'></script>

<script src='js/bootstrap.min.js'></script> 

<script src='js/bootstrap.js'></script> 
<script>

$(document).ready(function(){
    // to fade in on page load
    // $(".entire").css("display", "none");
    $(".entire").fadeIn(); 
     });
</script>
</body> 
</html>
