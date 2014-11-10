<?php
  session_start();

   if(isset($_SESSION['adminornot'])) {
    if($_SESSION['adminornot'] == '1') {
?>
      <?php
                   require_once('connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $total = 0;
                   $query = 'Select * from Persons inner join Patient on Patient.PId=Persons.Id';
                   $result = mysqli_query($dbc, $query);
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                    
                 $total = $total + 1;
                   }
                   }
                   mysqli_close($dbc);
                  ?>

                   <?php
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $countin = 0;
                   $query = 'Select * from Persons inner join Patient on Patient.PId=Persons.Id inner join Inpatient on Inpatient.PtId=Patient.Id';
                   $result = mysqli_query($dbc, $query);
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                            $countin  = $countin + 1;
                   
                   }
                   }
                   mysqli_close($dbc);
                  ?> 

                   <?php
                   // require_once('../connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $query = 'Select * from Persons inner join Patient on Patient.PId=Persons.Id inner join Outpatient on Outpatient.PtId=Patient.Id';
                   $result = mysqli_query($dbc, $query);
                   $countout = 0;
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                            $countout = $countout + 1;
                      
                   }
                   }
                   mysqli_close($dbc);
                  ?> 
                  <?php
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $query = 'Select * from Persons inner join Employee on Employee.PId=Persons.Id inner join Technician on Technician.EId=Employee.Id';
                   $totalemp = 0;
                   $result = mysqli_query($dbc, $query);
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                    $totalemp  = $totalemp + 1;
                      
                   }
                   }
                   mysqli_close($dbc);
                  ?> 

                  <?php
}
}
?>