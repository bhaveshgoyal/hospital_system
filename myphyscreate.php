<?php
  ob_start();
  session_start();
  require_once('connectvars.php');   
  if(isset($_SESSION['adminornot'])) {
    if($_SESSION['adminornot'] == '1') {
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addError = null;
        $phoneError = null;
        $depError = null;
           $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
           $query = "SELECT * FROM Department";
           $result2 = mysqli_query($dbc, $query);
           $result3 = mysqli_query($dbc, $query);
           mysqli_close($dbc);
         
        // keep track post values
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $date = $_POST['dob'];
        $dateofhire = $_POST['doth'];
        $depm = $_POST['depm'];
        if($depm != 'None') {
            $depm = explode(':', $depm);
            $depm = $depm[0];
        }
       
        $depw = $_POST['depw'];
        $depw = explode(':', $depw);
        $depw = $depw[0];

        $spec = $_POST['spec'];
        $deg = $_POST['deg']; 
        $aadhar = $_POST['aadha'];
        // validate input
        $valid = true;
        if (empty($fname)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($address)) {
            $addError = 'Please enter Address';
            $valid = false;
        } 
        if (empty($phone)) {
            $phoneError = 'Please enter  Number';
            $valid = false;
        }
        if (((!empty($depm)) && (!empty($depw))) || ((empty($depm)) && (!empty($depw))) || (empty($depw) && !empty($depm)) ) {    
          if($depm != $depw && ($depm != 'None')) {
            $depError = 'Department Managed and Working NOT SAME';
            $valid = false;
            }
        }
        if(!empty($depm) && ($depm != 'None')) {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "Select * from Physician where ManagesDep='$depm'";
            $result = mysqli_query($dbc, $query);
            if(mysqli_num_rows($result) >= 1) {
                $depError = 'A person already manages the dep';
                $valid = false;
            }
            mysqli_close($dbc);
         }
         
        // insert data
        if ($valid) {
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO Persons Values(0, '$fname', '$mname', '$lname', '$date', '$gender', '$phone','$address', '$aadhar')";
            mysqli_query($dbc, $query);
            $query = "SELECT * FROM Persons WHERE SSN='$aadhar'";
            $result = mysqli_query($dbc, $query);
            $row = mysqli_fetch_array($result);
            $x = $row['Id'];
            $z = $x;
            $query = "INSERT INTO Employee Values(0, '$dateofhire', '$x')";
            echo $x;
            $result = mysqli_query($dbc, $query);
            $query2 = "SELECT * FROM Employee where PId='$z'";
            $result2 = mysqli_query($dbc, $query2);
            $row2 = mysqli_fetch_array($result2);
            $y = $row2['Id'];
            echo $y;
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO Physician Values(0, '$y', '$depm', '$depw', '$deg', '$spec')";
            $result = mysqli_query($dbc, $query);
         
            mysqli_close($dbc);
            header("Location: myemployees.php");
        }
    }
  else {
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
         $query = "SELECT * FROM Department";
         $result2 = mysqli_query($dbc, $query);
         $result3 = mysqli_query($dbc, $query);
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

    <link href="css/datepicker.css" rel="stylesheet">

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

    </div>
    <!-- /#wrapper -->

  <div class="container" style="display:none;">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Add Physician</h3>
                    </div>
             
                    <form class="form-horizontal" action="myphyscreate.php" method="post">
                     <div class="control-group">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input name="fname" type="text" class="form-control"  placeholder="First Name" value="<?php echo !empty($fname)?$fname:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-block" style="color:red;"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Middle Name</label>
                        <div class="controls">
                            <input name="mname" class="form-control" type="text"  placeholder="Middle Name">
                            
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input name="lname" type="text" class="form-control" placeholder="Last Name" value="<?php echo !empty($lname)?$lname:'';?>">
                        </div>
                      </div>
                     

                      <div class="control-group">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <input name="address" type="text" class="form-control" placeholder="Address" value="<?php echo !empty($address)?$address:'';?>">
                            <?php if (!empty($addError)): ?>
                                <span class="help-block" style="color:red;"><?php echo $addError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Phone Number</label>
                        <div class="controls">
                            <input name="phone" type="text" class="form-control" placeholder="Phone Number" value="<?php echo !empty($phone)?$phone:'';?>">
                            <?php if (!empty($phoneError)): ?>
                                <span class="help-block" style="color:red;"><?php echo $phoneError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Gender</label>
                        <div class="controls">
                            <input name="gender" type="radio" value="Male"> Male
                           <input name="gender" type="radio" value="Female">Female
                        </div>
                      </div>
                    <div class="control-group">
                      <label class="control-label">Date Of Birth</label>
                      <div class="controls">
                         <input  type="text" name="dob"  class="form-control" placeholder="click to show datepicker"  id="example1">
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Aadhar Number</label>
                        <div class="controls">
                            <input name="aadha" type="text" class="form-control" placeholder="Aadhar Card Number">
                            
                        </div>
                      </div>

                     <div class="control-group">
                      <label class="control-label">Date of being Hired</label>
                      <div class="controls">
                         <input  type="text" name="doth" class="form-control" placeholder="click to show datepicker"  id="example2">
                      </div>
                    </div>
                    <div class="control-group">
                     <label class="control-label">Department Manages</label>
                     <div class="controls">
                       <!-- <input type="text" name="depm" placeholder="Department Managed"> -->
                        <?php if (!empty($depError)): ?>
                                <span class="help-block" style="color:red;"><?php echo $depError;?></span>
                            <?php endif;?>
         
                      <select class="form-control" name="depm">
                            <option>None</option>
                            <?php
                            while($row = mysqli_fetch_array($result3)) {
                                echo '<option>'.$row['Id'].':'.$row['Name'].'</option>';
                            }
                           ?>
                           </select>
                     </div>
                    </div>
                    <div class="control-group <?php echo !empty($depError)?'error':'';?>">
                     <label class="control-label">Department Works For</label>
                     <div class="controls">
<!--                        <input type="text" name="depw" placeholder="Department Works for"> -->
                        <?php if (!empty($depError)): ?>
                                <span class="help-block" style="color:red;"><?php echo $depError;?></span>
                            <?php endif;?>

                     <select class="form-control" name="depw">
                           <?php
                           while($row = mysqli_fetch_array($result2)) {
                               echo '<option>'.$row['Id'].':'.$row['Name'].'</option>';
                           }
                          ?>
                          </select>
                     </div>
                    </div>
                    <div class="control-group">
                     <label class="control-label">Degree</label>
                     <div class="controls">
                        <input type="text" class="form-control" name="deg" placeholder="Degree">
                     </div>
                    </div>
                    <div class="control-group">
                     <label class="control-label">Speciality</label>
                     <div class="controls">
                        <input type="text" class="form-control" name="spec" placeholder="Speciality">
                     </div>
                    </div>



 
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn btn-primary" href="myemployees.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div>
                 </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    <!-- jQuery Version 1.11.0 -->
    <script src="js/jquery-1.11.0.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    
    <script src="js/bootstrap-datepicker.js"></script>

    <script>
            // When the document is ready
            $(document).ready(function () {
                
                $('#example1').datepicker({
                    format: "yyyy-mm-dd"
                });  
                $('#example2').datepicker({
                   format: "yyyy-mm-dd"
                });

    $(".container").toggle("slide"); 
     });
</script>
</body>

</html>
<?php
  }
}
?>
