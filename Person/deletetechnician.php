<?php
   ob_start();
   session_start();
    if(isset($_SESSION['adminornot'])){
        if($_SESSION['adminornot'] == '1') {
    require_once('../connectvars.php');
    $id = 0;
     
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( !empty($_POST)) {
        $id = $_POST['id'];
         
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * from Employee where PId = '$id'";
        $result = mysqli_query($dbc, $query);
        $row = mysqli_fetch_array($result);
        $empx = $row['Id'];
        $query = "DELETE FROM Technician where EId = '$empx'";
        mysqli_query($dbc, $query);
        $query = "DELETE FROM Employee where PId = '$id'";
        mysqli_query($dbc, $query);
        $query = "DELETE FROM Persons WHERE Id='$id'";
        mysqli_query($dbc, $query);
        header("Location: technician.php");
         
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
    <script src="../js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Delete Technician Entry</h3>
                    </div>
                     
                    <form class="form-horizontal" action="deletetechnician.php" method="post">
                      <input type="hidden" name="id" value="<?php echo $id;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="technician.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div>
  </body>
</html>
<?php
  }
}
?>
