<?php
  session_start();
 include 'permission.php';

   if(isset($_SESSION['adminornot'])) {
    if($_SESSION['adminornot'] == '1') {
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<style>
#in, #out, #overall , body, #page-wrapper,  .container-fluid{
  -webkit-backface-visibility: hidden;
}
#in, #out, #overall, #page-wrapper,  .container-fluid{
-webkit-transform-style: preserve-3d;
}
</style>
</head>

<body>

    <div id="wrapper">


<?php include_once('header.php'); ?>

        <div id="page-wrapper">

            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Dept. Section
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="admin_index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-hospital-o"></i> Manage Departments
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
 
   <div class="container">
            <div class="row">
                <h3>Manage Department</h3>
            </div>
            <div class="row">
                <p>
                   <a href="mycreatedept.php" class="btn btn-success">Create New Department</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Department Name</th>
                      <th>Location</th>
                      <th>Phone</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once('connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                   $query = 'SELECT * FROM Department';
                   $result = mysqli_query($dbc, $query);
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                    
                            echo '<tr>';
                            echo '<td>'. $row['Name'] . '</td>';
                            echo '<td>'. $row['Location'] . '</td>';
                            echo '<td>'. $row['Phone'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn" href="myreaddept.php?id='.$row['Id'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="myupdatedept.php?id='.$row['Id'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="mydeletedept.php?id='.$row['Id'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                   }
                   }
                   mysqli_close($dbc);
                  ?>
                  </tbody>
            </table>
        </div>
    </div>

                 </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
<?php
}
}
?>