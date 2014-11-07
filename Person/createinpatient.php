<?php
  ob_start();
  session_start();
  require_once('../connectvars.php');   
  if(isset($_SESSION['adminornot'])) {
    if($_SESSION['adminornot'] == '1') {
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
        $addError = null;
        $phoneError = null;
         
        // keep track post values
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $date = $_POST['dob'];
        $aadhar = $_POST['aadha'];
        $dis = $_POST['dis'];
        $doct = $_POST['doct'];
        $comment = $_POST['comment'];
        $charge = $_POST['charge'];
        $doad = $_POST['doad'];
        $dodis = $_POST['dodis'];
        
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
        if (empty($dodis)) {
            $dodis = '0000-00-00';
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
            $query = "INSERT INTO Patient Values(0, '$x', '$charge', '$dis', '$doct', '$comment')";
            echo $x;
            $result = mysqli_query($dbc, $query);
            $query2 = "SELECT * FROM Patient where PId='$z'";
            $result2 = mysqli_query($dbc, $query2);
            $row2 = mysqli_fetch_array($result2);
            $y = $row2['Id'];
            echo $y;
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "INSERT INTO Inpatient Values(0, '$y', '$dodis', '$doad')";
            $result = mysqli_query($dbc, $query);
         
            mysqli_close($dbc);
            header("Location: inpatient.php");
        }
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
            
                $('#example3').datepicker({
                   format: "yyyy-mm-dd"
                });
            
                $('#example4').datepicker({
                   format: "yyyy-mm-dd"
                });
            });

        </script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Create an IN Patients</h3>
                    </div>
             
                    <form class="form-horizontal" action="createinpatient.php" method="post">
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
                            <input name="mname" type="text"  placeholder="Middle Name">
                            
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
                            <input name="gender" type="radio" value="Male"> Male
                           <input name="gender" type="radio" value="Female">Female
                        </div>
                      </div>
                    <div class="control-group">
                      <label class="control-label">Date Of Birth</label>
                      <div class="controls">
                         <input  type="text" name="dob" placeholder="click to show datepicker"  id="example1">
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Aadhar Number</label>
                        <div class="controls">
                            <input name="aadha" type="text"  placeholder="Aadhar Card Number">
                            
                        </div>
                      </div>
                     <div class="control-group">
                        <label class="control-label">Disease Complaint Of</label>
                        <div class="controls">
                            <input name="dis" type="text"  placeholder="Disease Complaint Of">
                            
                        </div>
                      </div>
                     <div class="control-group">
                      <label class="control-label">Date of Contact</label>
                      <div class="controls">
                         <input  type="text" name="doct" placeholder="click to show datepicker"  id="example2">
                      </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Charges</label>
                        <div class="controls">
                            <input name="charge" type="text"  placeholder="Charge">
                            
                        </div>
                      </div>
 
                     <div class="control-group">
                        <label class="control-label">Comments</label>
                        <div class="controls">
                            <input name="comment" type="text"  placeholder="Comments">
                            
                        </div>
                      </div>
                      <div class="control-group">
                      <label class="control-label">Date of Admission</label>
                      <div class="controls">
                         <input  type="text" name="doad" placeholder="click to show datepicker"  id="example3">
                      </div>
                    </div>
                   <div class="control-group">
                      <label class="control-label">Date of Discharge</label>
                      <div class="controls">
                         <input  type="text" name="dodis" placeholder="click to show datepicker"  id="example4">
                      </div>
                    </div>
  




 
                          <button type="submit" class="btn btn-success">Create</button>
                          <a class="btn" href="inpatient.php">Back</a>
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
