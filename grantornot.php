<?php
   session_start();
?>

<html>

<title>Grant them their permissions</title>


<body>

<?php
    require_once('connectvars.php');

     if(isset($_SESSION['username']) && ($_SESSION['adminornot']) == '1')
    {

      if(isset($_GET['emp']) && isset($_GET['id'])) {
      $id = $_GET['id'];
      $emp = $_GET['emp'];
    }
    else if (isset($_POST['id']) && isset($_POST['emp'])) {
      // Grab the score data from the POST
      $id = $_POST['id'];
      $emp = $_POST['emp'];
    }
    else {
      echo '<p class="error">Sorry, no name was specified.</p>';
   }

    if (isset($_POST['submit'])) {
     if ($_POST['confirm'] == 'Yes') {
  
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "UPDATE users SET permission = '1' where user_name = '$id'"; 
        mysqli_query($dbc, $query);
        mysqli_close($dbc);
  
        // Confirm success with the user
        echo '<p>The user with username'. $id .'was granted permissions';
      }
      else {
        echo '<p class="error">The user was not granted permission.</p>';
      }
    }
    else if (isset($id) && isset($emp)) {
      echo '<p>Are you sure you want to grant permission to the one here ??</p>';
      echo '<form method="post" action="grantornot.php">';
      echo '<input type="radio" name="confirm" value="Yes" /> Yes ';
      echo '<input type="radio" name="confirm" value="No" checked="checked" /> No <br />';
      echo '<input type="submit" value="Submit" name="submit" />';
      echo '<input type="hidden" name="id" value="' . $id . '" />';
      echo '<input type="hidden" name="emp" value="' . $emp . '" />';
      echo '</form>';
    }
  
    echo '<p><a href="index.php">&lt;&lt; Back to index of  admin page</a></p>';
    }
?>
  
  </body>


