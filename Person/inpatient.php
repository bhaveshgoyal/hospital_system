<?php
session_start();
if(isset($_SESSION['adminornot'])){
   if($_SESSION['adminornot'] == '1') {
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
            <div class="row">
                <h3>Manage IN Patients</h3>
            </div>
            <div class="row">
                <p>
                   <a href="createinpatient.php" class="btn btn-warning">Create IN Patient</a>
                   <a href="patient.php" class="btn btn-primary">Back to Patient</a>
                </p>
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Aadhar No.</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once('../connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $query = 'Select * from Persons inner join Patient on Patient.PId=Persons.Id inner join Inpatient on Inpatient.PtId=Patient.Id';
                   $result = mysqli_query($dbc, $query);
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                    
                            echo '<tr>';
                            echo '<td>'. $row['Fname'] .' '. $row['Mname']. ' '. $row['Lname'] .'</td>';
                            echo '<td>'. $row['Address'] . '</td>';
                            echo '<td>'. $row['Gender'] . '</td>';
                            echo '<td>'. $row['Phone'] . '</td>';
                            echo '<td>'. $row['SSN']. '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn" href="readinpatient.php?id='.$row['PId'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="updateinpatient.php?id='.$row['PId'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="deleteinpatient.php?id='.$row['PId'].'">Delete</a>';
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
  </body>
</html>
<?php
 }
}
?>
