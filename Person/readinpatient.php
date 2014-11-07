<?php
    ob_start();
    session_start();
    require_once('../connectvars.php');
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: inaptient.php");
    } else {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * from Persons where Id = '$id'";
        $result = mysqli_query($dbc, $query);
        $data = mysqli_fetch_array($result);
        $query = "Select * from Persons inner join Patient on Patient.PId=Persons.Id inner join Inpatient on Inpatient.PtId=Patient.Id where PId='$id'";
        $result = mysqli_query($dbc, $query);
        $data2 = mysqli_fetch_array($result);
        mysqli_close($dbc);
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
                        <h3>Patient's Information</h3>
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
                        <label class="control-label">Charges</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['Charges'];?>
                            </label>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Disease Complaint</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['Disease'];?>
                            </label>
                        </div>
                      </div>
                        <div class="control-group">
                        <label class="control-label">Contact Date</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['ContactDate'];?>
                            </label>
                        </div>
                      </div>
                        <div class="control-group">
                        <label class="control-label">Comments</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['Comments'];?>
                            </label>
                        </div>
                      </div>
                         <div class="control-group">
                        <label class="control-label">Date of Admission</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['AdmissionDate'];?>
                            </label>
                        </div>
                      </div>
                       <div class="control-group">
                        <label class="control-label">Date of Discharge</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data2['DischargeDate'];?>
                            </label>
                        </div>
                      </div>





                        <div class="form-actions">
                          <a class="btn" href="inpatient.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div>
  </body>
</html>
