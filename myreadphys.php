<?php
    ob_start();
    session_start();
    require_once('connectvars.php');
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: physician.php");
    } else {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * from Persons where Id = '$id'";
        $result = mysqli_query($dbc, $query);
        $data = mysqli_fetch_array($result);
        $query = "Select * from Persons inner join Employee on Employee.PId=Persons.Id inner join Physician on Physician.EId=Employee.Id where PId='$id'";
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
                        <label class="control-label">Department Manages</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['ManagesDep'];?>
                            </label>
                        </div>
                      </div>
                        <div class="control-group">
                        <label class="control-label">Department Works For</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['WorksForDep'];?>
                            </label>
                        </div>
                      </div>
                        <div class="control-group">
                        <label class="control-label">Degree</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['Degree'];?>
                            </label>
                        </div>
                      </div>
                         <div class="control-group">
                        <label class="control-label">Speciality</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['Speciality'];?>
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

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <script>
$(document).ready(function(){
//   if ($.browser.webkit) {
//     $('input[name="password"]').attr('autocomplete', 'off');
//     $('input[name="username"]').attr('autocomplete', 'off');
// }
    // to fade in on page load
    // $(".entire").css("display", "none");
     // $('#example1').datepicker({
     //                format: "yyyy-mm-dd"
     //            });  
     //            $('#example2').datepicker({
     //               format: "yyyy-mm-dd"
     //            });
            

    $(".container").toggle("slide"); 
     });
</script>
</body>

</html>
