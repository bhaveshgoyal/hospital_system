<?php
    ob_start();
    session_start();
    require_once('connectvars.php');
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: addperson.php");
    } else {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * from Persons where Id = '$id'";
        $result = mysqli_query($dbc, $query);
        $data = mysqli_fetch_array($result);
        $query = "Select * from Persons inner join Employee on Employee.PId=Persons.Id inner join Nurse on Nurse.EId=Employee.Id where PId='$id'";
        $result = mysqli_query($dbc, $query);
        $data2 = mysqli_fetch_array($result);
        mysqli_close($dbc);
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

<link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css " />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-responsive.min.css" />
   <link rel="stylesheet" type="text/css" href="css/bootstrap.css.map " />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css" />
   <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.css.map " />
  <link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css" />

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/bootstrap.js"></script>
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<style>
    .form-horizontal .control-group{margin-bottom:20px;*zoom:1}.form-horizontal .control-group:before,.form-horizontal .control-group:after{display:table;line-height:0;content:""}.form-horizontal .control-group:after{clear:both}.form-horizontal .control-label{float:left;width:160px;padding-top:5px;text-align:right}.form-horizontal .controls{*display:inline-block;*padding-left:20px;margin-left:180px;*margin-left:0}.form-horizontal .controls:first-child{*padding-left:180px}.form-horizontal .help-block{margin-bottom:0}.form-horizontal input+.help-block,.form-horizontal select+.help-block,.form-horizontal textarea+.help-block,.form-horizontal .uneditable-input+.help-block,.form-horizontal .input-prepend+.help-block,.form-horizontal .input-append+.help-block{margin-top:10px}.form-horizontal .form-actions{padding-left:180px}table{max-width:100%;background-color:transparent;border-collapse:collapse;border-spacing:0}
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

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
                                <i class="fa fa-table"></i> Manage Database
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->


   <div class="container" style="display:none;">
     
       <div class="span10 offset1">
                    <div class="row">
                        <h3>Nurse's Information</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      
                      <div class="control-group">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Fname'].' '. $data['Mname'] .' '. $data['Lname'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Address'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Gender</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Gender'];?>
                            </label>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Date Of Birth</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['DOB'];?>
                            </label>
                        </div>
                      </div>
                        <div class="control-group">
                        <label class="control-label">Gender</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Gender'];?>
                            </label>
                        </div>
                      </div>


                      <div class="control-group">
                        <label class="control-label">Phone</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['Phone'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Aadhar Card Number</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['SSN'];?>
                            </label>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Date Of Joining</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['DateHired'];?>
                            </label>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Department Assigned</label>
                        <div class="controls">
                                       <label class="checkbox">
                                  <?php
                                   $id2 = $data2['DepW'];
                                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                                   $query = "SELECT Name from Department where Id='$id2'";
                                   $result2 = mysqli_query($dbc, $query);
                                  $result2 = mysqli_fetch_array($result2);
                                   echo $result2['Name'];
                                   mysqli_close($dbc);
                                ?>

                            </label>
                        </div>
                      </div>

                        <div class="form-actions">
                          <a class="btn" href="myemployees.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div>

                 </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <script>
$(document).ready(function(){

    $(".container").toggle("slide"); 
     });
</script>
</body>

</html>
