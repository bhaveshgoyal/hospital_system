<?php
  ob_start();
  session_start();

  if(isset($_SESSION['adminornot'])) {
    if($_SESSION['adminornot'] == '1') {
  require_once('connectvars.php');

 $id = null; 
 if ( !empty($_GET['id'])) {
          $id = $_REQUEST['id'];
      }

     if ( null==$id ) {
        header("Location: mylabs.php");   
     }
 
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
         
        if ($valid) {
            echo $id;
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO Test Values(0, '$id', '$name')";
            $result = mysqli_query($dbc, $query);
            mysqli_close($dbc);
            header("Location: mycreatetest.php");
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
                            Tables
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


                 <div class="container" id="containerman" style="display:none;">
            <div class="row">
                <h3>Manage Tests for the Lab</h3>
            </div>
            <div class="row">
                <p>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Test Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once('connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                   $query = "SELECT * FROM Test where LId='$id'";
                   $result = mysqli_query($dbc, $query);
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                    
                            echo '<tr>';
                            echo '<td>'. $row['TName'] . '</td>';
                            echo '<td width=300>';
                            echo '<a class="btn btn-danger" href="mydeletetest.php?id='.$row['Id'].'">Delete</a>';
                            echo ' ';


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
          
      <div class="container" id="containeradd" style="display:none;">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create Test</h3>
                    </div>
             
                    <form class="form-horizontal" action="mycreatetest.php?id=<?php echo $id?>" method="post">
                     <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Test Name</label>
                        <div class="controls">
                            <input name="name" type="text" class="form-control" placeholder="Test Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-block" style="color:red;"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>

                      <div class="form-actions" style="float:left;">
                          <button type="submit" class="btn btn-success">Create</button>
                        </div>
                    </form>&nbsp; &nbsp;
                    <button class="btn btn-danger" id="createnews">Cancel</button>
                </div>
             
                 </div>

              <button class="btn btn-primary" id="createnew">Create New Test</button>
              <a class="btn" href="mylabs.php">Back To Labs</a>
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

    $("#containerman").toggle("slide"); 
     });


$("#createnew").click(function(){

    $("#containerman").toggle("slide");
  $("#containeradd").toggle("slide");

  $("#createnew").toggle("slide");
});

$("#createnews").click(function(){

    $("#containerman").toggle("slide");
  $("#containeradd").toggle("slide");

  $("#createnew").toggle("slide");
});
</script>
</body>

</html>
<?php
  }
}
?>
