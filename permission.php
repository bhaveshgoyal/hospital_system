<?php
  session_start();
?>

<html>
<title>Grant permissions</title>

</title>

<body>

<?php
   require_once('connectvars.php');
   if(isset($_SESSION['username'])) {
       if($_SESSION['adminornot'] = '1') {
           $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
           $query = "SELECT * from users WHERE permission = '0'";
           $data = mysqli_query($dbc, $query);
           $count = 0;
           echo '<table>';
           while ($row = mysqli_fetch_array($data)) {
           $count = $count + 1;
           echo '<tr class="scorerow"><td><strong>' . $row['user_name'] . '</strong></td>';
           echo '<td>' . $row['emp_type'] . '</td>';
           echo '<td><a href="grantornot.php?id=' . $row['user_name'] . '&amp;emp=' . $row['emp_type'] .'">Change Permissions</a></td></tr>';
           }
           echo '</table>';
       }
    }
  else {
  echo 'You do not have premissions to view this page';
  }
?>

</body>

</html>

