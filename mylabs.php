<?php
  session_start();
 include 'permission.php';

   if(isset($_SESSION['adminornot'])) {
    if($_SESSION['adminornot'] == '1') {
?>
<?php
  ob_start();

  require_once('connectvars.php');
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
         
        // keep track post values
        $name = $_POST['name'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
        if (!empty($name)) {
          $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
          $query = "Select * from Lab where Name='$name'";
          $result = mysqli_query($dbc, $query);
          if(mysqli_num_rows($result) != 0) {
           $nameError = 'Name already exists';
           $valid = false;
          }
        }
         
        if ($valid) {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO Lab Values(0, '$name')";
            $result = mysqli_query($dbc, $query);
            mysqli_close($dbc);
            header("Location: mylabs.php");
        }
    }
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
                            Lab Section
                        </h1>
                        <ol class="breadcrumb">
                            <li>
                                <i class="fa fa-dashboard"></i>  <a href="admin_index.php">Dashboard</a>
                            </li>
                            <li class="active">
                                <i class="fa fa-flask"></i> Manage Laboratory
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
   <div class="container">
            <div class="containerlab" style="overflow:hidden;">
            <div class="row" style="margin-left:1em;">
                <h3>Manage Laboratory Center</h3>
            </div>
            <div class="row">
                <p>
                   <button id="addlab" class="btn btn-success" style="margin-left:2em;">Add a Laboratory</button><hr>
                </p>
              </div>
            </div>  

             <div class="containeradd" style="display:none;">
                 <div class="row" style="margin-left:1em;">
                  <div class="span10 offset1">
             
                    <form class="form-horizontal" action="mylabs.php" method="post">
                     <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                      <h2><label class="control-label label label-default" style="width:auto;">Lab Name</label><h2>
                        <div class="controls">
                            <input name="name" type="text" class="form-control" style="width:75%;" placeholder="Name Of The Lab" value="<?php echo !empty($name)?$name:'';?>">
                     <!--        <?php if (!empty($nameError)): ?>
                                <span class="help-block" style="color:red;"><?php echo $nameError;?></span>
                            <?php endif; ?> -->
                        </div>
                      </div>

                      <div class="form-actions" style="float:left;">
                          <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>&nbsp; &nbsp;
                    <button class="btn btn-danger" id="cancel">Cancel</button>
                </div>
                </div><hr>
              </div>

                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Laboratory Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once('connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                   $query = 'SELECT * FROM Lab';
                   $result = mysqli_query($dbc, $query);
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                    
                            echo '<tr>';
                            echo '<td>'. $row['Name'] . '</td>';
                            echo '<td width=450>';
                            echo '<a class="btn" href="myreadlab.php?id='.$row['Id'].'">Read</a>';
                            echo ' &nbsp; &nbsp;&nbsp; &nbsp;';
                            echo '<a class="btn btn-warning" href="myupdatelab.php?id='.$row['Id'].'">Update</a>';
                            echo '&nbsp; &nbsp;&nbsp; &nbsp;    ';

                            echo '<a class="btn btn-info" href="mycreatetest.php?id='.$row['Id'].'">Manage Tests</a>';
                            echo ' &nbsp; &nbsp;&nbsp; &nbsp;   ';
                            echo '<a class="btn btn-danger" href="mydeletelab.php?id='.$row['Id'].'">Delete</a>';
                            echo '    ';


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
<script>
$(document).ready(function(){

$("#addlab").click(function(){
  $(".containerlab").toggle("slide");

  $(".containeradd").toggle("slide");
});


$("#cancel").click(function(){

  $(".containeradd").toggle("slide");
    $(".containerlab").toggle("slide");

});
});
</script>

</body>

</html>
<?php
}
}
else {
    echo 'You are not authorized to view this page';
}
?>