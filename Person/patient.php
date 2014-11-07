<?php
    session_start();
    if(isset($_SESSION['adminornot'])) {
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
                <h3>Patient Manage</h3>
            </div>
            <div class="row">
                <p>
                   <a href="inpatient.php" class="btn btn-success btn-block">IN Patients</a>
                </p>
                <p>
                   <a href="outpatient.php" class="btn btn-info btn-block">OUT Patients</a>
                </p>
                <p>
                </p>
                <table class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Gender</th>
                      <th>Phone</th>
                    <!--  <th>Action</th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once('../connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $query = 'Select * from Persons inner join Patient on Patient.PId=Persons.Id';
                   $result = mysqli_query($dbc, $query);
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                    
                            echo '<tr>';
                            echo '<td>'. $row['Fname'] .' '. $row['Mname']. ' '. $row['Lname'] .'</td>';
                            echo '<td>'. $row['Address'] . '</td>';
                            echo '<td>'. $row['Gender'] . '</td>';
                            echo '<td>'. $row['Phone'] . '</td>';
                      //      echo '<td width=250>';
                      /*      echo '<a class="btn" href="readp.php?id='.$row['ID'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="updatep.php?id='.$row['ID'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="deletep.php?id='.$row['ID'].'">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                       */
                   }
                   }
                   mysqli_close($dbc);
                  ?>
                  </tbody>
            </table>
               <p>
                 <a href="../index2.php" class="btn btn-block">Go Back</a>
               </p>
        </div>
    </div> 
  </body>
</html>
<?php
 }
}
?>
