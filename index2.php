<?php
   session_start();
   if(isset($_SESSION['adminornot'])) {
    if($_SESSION['adminornot'] == '1') {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Add a person to the Database</h3>
            </div>
            <div class="row">
                <p>
                   <a href="Person/employee.php" class="btn btn-success btn-block">Employee</a>
                </p>
                <p>
                  <a href="Person/patient.php" class="btn btn-success btn-block">Patient</a>
                </p>
                  </tbody>
            </table>
        </div>
    </div> 
  </body>
</html>
<?php
}
}
else {
    echo 'You are not authorized to view this page';
}
?>
