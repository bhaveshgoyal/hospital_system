<?php
  ob_start();
  session_start();   
  require_once('../connectvars.php');
 
   if(isset($_SESSION['adminornot'])) {
     if($_SESSION['adminornot'] == '1') {
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: technician.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addError = null;
        $phoneError = null;
        $aadharError = null;
        $dobError = null;
        $dhError = null;
         
        // keep track post values
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $dob = $_POST['dob'];
        $aadhar = $_POST['aadhar'];
        $dh = $_POST['dh'];
        $depm = $_POST['depm'];
        $depw = $_POST['depw'];
        $spec = $_POST['spec'];
        $deg = $_POST['deg'];

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
        // update data
        if ($valid) {
         $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
         $query = "UPDATE Persons SET Fname='$fname', Mname='$mname', Lname='$lname', Address='$address', Gender='$gender', Phone='$phone', DOB='$dob', SSN='$aadhar' WHERE Id='$id'";
         mysqli_query($dbc, $query);
         $query = "UPDATE Employee SET DateHired='$dh' WHERE PId='$id'";
         mysqli_query($dbc, $query);
         $query = "Select * from Employee where PId='$id'";
         $result = mysqli_query($dbc, $query);
         $row = mysqli_fetch_array($result);
         $x = $row['Id'];
         $query = "UPDATE Nurse SET DepW = '$dep' where EId = '$x'";
         mysqli_query($dbc, $query);
         mysqli_close($dbc);
         header("Location: nurse.php");
      }
    } else {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * from Persons where Id='$id'";
        $result = mysqli_query($dbc, $query);
        $data = mysqli_fetch_array($result);
        $query = "SELECT * from Employee where PId='$id'";
        $result = mysqli_query($dbc, $query);
        $data2 = mysqli_fetch_array($result);
        $fname = $data['Fname'];
        $mname = $data['Mname'];
        $lname = $data['Lname'];
        $address = $data['Address'];
        $phone = $data['Phone'];
        $gender = $data['Gender'];
        $dob = $data['DOB'];
        $dh = $data2['DateHired'];
        $aadhar = $data['SSN'];
        $y = $data2['Id'];
        $query = "SELECT * from Nurse where EId='$y'";
        $result2 = mysqli_query($dbc, $query);
        $data3 = mysqli_fetch_array($result2);
        $dep = $data3['DepW'];
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
    <link   href="../css/bootstrap.min.css" rel="stylesheet">
      <link   href="../css/datepicker.css" rel="stylesheet">
      <script src="../js/bootstrap.min.js"></script>
              <script src="../js/jquery-1.9.1.min.js"></script>
          <script src="../js/bootstrap-datepicker.js"></script>
          <script type="text/javascript">
              // When the document is ready
              $(document).ready(function () {
                  
                  $('#example1').datepicker({
                      format: "yyyy-mm-dd"
                  });  
                  $('#example2').datepicker({
                     format: "yyyy-mm-dd"
                  });
              });
          </script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update the Person</h3>
                    </div>
             
                    <form class="form-horizontal" action="updatenurse.php?id=<?php echo $id?>" method="post">
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
                     <div class="control-group <?php echo !empty($dhError)?'error':'';?>">
                       <label class="control-label">Date Of Hiring</label>
                       <div class="controls">
                          <input  type="text" name="dh" placeholder="click to show datepicker"  id="example2" value="<?php echo !empty($dh)?$dh:'';?>">
                       </div>
                     </div>
                     <div class="control-group">
                        <label class="control-label">Department assigned to</label>
                        <div class="controls">
                            <input name="dep" type="text"  placeholder="Dep. assigned" value="<?php echo !empty($dep)?$dep:'';?>">
                        </div>
                      </div>




                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="nurse.php">Back</a>
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
