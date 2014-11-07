<?php
  ob_start();
  session_start();   
  require_once('connectvars.php');
 
   if(isset($_SESSION['adminornot'])) {
     if($_SESSION['adminornot'] == '1') {
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: inpatient.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addError = null;
        $phoneError = null;
        $aadharError = null;
        $dobError = null;
        $dhError = null;
        $depError = null; 
        // keep track post values
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $aadhar = $_POST['aadhar'];
        $doad = $_POST['doad'];
        $dodis = $_POST['dodis'];
        $comment = $_POST['comment'];
        $charge = $_POST['charge'];
        $dis = $_POST['dis'];
        $doct = $_POST['doct'];

        // validate input
        $valid = true;
        if (empty($fname)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
         
        if (empty($address)) {
            $addError = 'Please enter Email Address';
            $valid = false;
        }
         
        if (empty($phone)) {
            $phoneError = 'Please enter Mobile Number';
            $valid = false;
        }
        if (empty($dob)) {
           $dobError = 'Please enter the Date of Birth';
           $valid = false;    
        }
        if (empty($aadhar)) {
           $aadharError = 'Please enter the aadhar number';
        }
        if (empty($dodis)) {
           $dodis = '0000-00-00';
        }
                 
        // update data
        if ($valid) {
         $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
         $query = "UPDATE Persons SET Fname='$fname', Mname='$mname', Lname='$lname', Address='$address', Gender='$gender', Phone='$phone', DOB='$dob', SSN='$aadhar' WHERE Id='$id'";
         mysqli_query($dbc, $query);
         $query = "UPDATE Patient SET Charges='$charge', Disease='$dis', ContactDate='$doct' , Comments='$comment' WHERE PId='$id'";
         mysqli_query($dbc, $query);
         $query = "Select * from Patient where PId='$id'";
         $result = mysqli_query($dbc, $query);
         $row = mysqli_fetch_array($result);
         $x = $row['Id'];
         $query = "UPDATE Inpatient SET AdmissionDate='$doad', DischargeDate='$dodis' where PtId = '$x'";
         mysqli_query($dbc, $query);
         mysqli_close($dbc);
         header("Location: inpatient.php");
      }
    } else {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * from Persons where Id='$id'";
        $result = mysqli_query($dbc, $query);
        $data = mysqli_fetch_array($result);
        $query = "SELECT * from Patient where PId='$id'";
        $result = mysqli_query($dbc, $query);
        $data2 = mysqli_fetch_array($result);
        $fname = $data['Fname'];
        $mname = $data['Mname'];
        $lname = $data['Lname'];
        $address = $data['Address'];
        $phone = $data['Phone'];
        $gender = $data['Gender'];
        $dob = $data['DOB'];
        $aadhar = $data['SSN'];
        $charge = $data2['Charges'];
        $dis = $data2['Disease'];
        $comment = $data2['Comments'];
        $doct = $data2['ContactDate'];
        $y = $data2['Id'];
        $query = "SELECT * from Inpatient where PtId='$y'";
        $result2 = mysqli_query($dbc, $query);
        $data3 = mysqli_fetch_array($result2);
        $doad = $data3['AdmissionDate'];
        $dodis = $data3['DischargeDate'];
        if($gender == 'Male') {
        $genm = 'checked="checked"';
        $genf = '';
        }
        else {
        $genm = '';
        $genf = 'checked="checked"';
        } 
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

        <?php include_once('header.php') ?>

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
                        <h3>Update the Person</h3>
                    </div>
             
                    <form class="form-horizontal" action="updateinpatient.php?id=<?php echo $id?>" method="post">
                     <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">First Name</label>
                        <div class="controls">
                            <input name="fname" type="text"  placeholder="First Name" value="<?php echo !empty($fname)?$fname:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-inline"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Middle Name</label>
                        <div class="controls">
                            <input name="mname" type="text"  placeholder="Middle Name" value="<?php echo !empty($lname)?$mname:'';?>">
                            
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Last Name</label>
                        <div class="controls">
                            <input name="lname" type="text"  placeholder="Last Name" value="<?php echo !empty($lname)?$lname:'';?>">
                        </div>
                      </div>
                     

                      <div class="control-group <?php echo !empty($addError)?'error':'';?>">
                        <label class="control-label">Address</label>
                        <div class="controls">
                            <input name="address" type="text" placeholder="Address" value="<?php echo !empty($address)?$address:'';?>">
                            <?php if (!empty($addError)): ?>
                                <span class="help-inline"><?php echo $addError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($phoneError)?'error':'';?>">
                        <label class="control-label">Phone Number</label>
                        <div class="controls">
                            <input name="phone" type="text"  placeholder="Phone Number" value="<?php echo !empty($phone)?$phone:'';?>">
                            <?php if (!empty($phoneError)): ?>
                                <span class="help-inline"><?php echo $phoneError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Gender</label>
                        <div class="controls">
                            <input name="gender" type="radio" value="Male" <?php echo $genm;?>>Male
                           <input name="gender" type="radio" value="Female" <?php echo $genf;?>>Female
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($aadharError)?'error':'';?>">
                        <label class="control-label">Aadhar No.</label>
                        <div class="controls">
                            <input name="aadhar" type="text"  placeholder="Aadhar Card No." value="<?php echo !empty($aadhar)?$aadhar:'';?>">
                            <?php if (!empty($aadharError)): ?>
                                <span class="help-inline"><?php echo $aadharError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($dobError)?'error':'';?>">
                       <label class="control-label">Date Of Birth</label>
                       <div class="controls">
                          <input  type="text" name="dob" placeholder="click to show datepicker"  id="example1" value="<?php echo !empty($dob)?$dob:'';?>">
                       </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label">Disease Complaint Of</label>
                         <div class="controls">
                             <input name="dis" type="text"  placeholder="Disease Complaint Of" value="<?php echo !empty($dis)?$dis:'';?>">
 
                         </div>
                       </div>
                      <div class="control-group">
                       <label class="control-label">Date of Contact</label>
                       <div class="controls">
                          <input  type="text" name="doct" placeholder="click to show datepicker"  id="example2" value="<?php echo !empty($doct)?$doct:'';?>">
                       </div>
                     </div>
                     <div class="control-group">
                         <label class="control-label">Charges</label>
                        <div class="controls">
                             <input name="charge" type="text"  placeholder="Charge" value="<?php echo !empty($charge)?$charge:'';?>">
 
                         </div>
                       </div>
 
                      <div class="control-group">
                         <label class="control-label">Comments</label>
                        <div class="controls">
                             <input name="comment" type="text"  placeholder="Comments" value="<?php echo !empty($comment)?$comment:'';?>">
 
                         </div>
                       </div>
                       <div class="control-group">
                       <label class="control-label">Date of Admission</label>
                       <div class="controls">
                          <input  type="text" name="doad" placeholder="click to show datepicker"  id="example3" value="<?php echo !empty($doad)?$doad:'';?>">
                       </div>
                     </div>
                    <div class="control-group">
                       <label class="control-label">Date of Discharge</label>
                       <div class="controls">
                          <input  type="text" name="dodis" placeholder="click to show datepicker"  id="example4" value="<?php echo !empty($dodis)?$dodis:'';?>">
                       </div>
                     </div>
  

                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="mypatients.php">Back to Patients</a>
                        </div>
                    </form>
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
    $(".container").toggle("slide"); 
     });
</script>
</body>

</html>
<?php
 }
}
?>