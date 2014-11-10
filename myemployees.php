<?php
  session_start();
 include 'permission.php';

   if(isset($_SESSION['adminornot'])) {
    if($_SESSION['adminornot'] == '1') {
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
<style>
#nurse, #tech, #phys, .overall , .container-fluid{
  -webkit-backface-visibility: hidden;
}
#nurse, #tech, #phys, .overall, #page-wrapper, .container-fluid{
-webkit-transform-style: preserve-3d;
}
</style>
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
<div class="container overall" style="height:auto; overflow:hidden;">
            <div class="row">
                <h3>Employee Manage</h3>
            </div>
            <div class="row">
                <p>
                   <button id="techbtn" class="btn btn-success btn-block">Manage Techician(s)</button>
                </p>
                <p>
                   <button id="nursebtn" class="btn btn-info btn-block">Manage Nurse(s)</button>
                </p>
                <p>
                   <button id="physbtn" class="btn btn-primary btn-block">Manage Doctor(s)</button>
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
                   require_once('connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $query = 'Select * from Persons inner join Employee on Employee.PId=Persons.Id';
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
        </div>
    </div> 

<!-- TECHNICIANS -->
  <div class="container" id="tech" style="display:none; height:auto;overflow:hidden;">
            <div class="row">
                <h3>Technician Manage</h3>
            </div>
            <div class="row">
                <p>
                   <a href="mytechcreate.php" class="btn btn-warning">Create Technician</a>
                   <button id="backtech" class="btn btn-primary back">Back to Employee(s)</button>
                </p>
                <table class="table table-striped table-bordered">
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
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $query = 'Select * from Persons inner join Employee on Employee.PId=Persons.Id inner join Technician on Technician.EId=Employee.Id';
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
                            echo '<a class="btn" href="myreadtech.php?id='.$row['PId'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="myupdatetech.php?id='.$row['PId'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="mydeletetech.php?id='.$row['PId'].'">Delete</a>';
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

<!-- NURSE -->

 <div class="container" id="nurse" style="display:none; height:auto; overflow:hidden;">
            <div class="row">
                <h3>Nurse Manage</h3>
            </div>
            <div class="row">
                <p>
                   <a href="mynursecreate.php" class="btn btn-warning">Create Nurse</a>
                   <button id="backnurse" class="btn btn-primary back">Back to Employee(s)</button>
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
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $query = 'Select * from Persons inner join Employee on Employee.PId=Persons.Id inner join Nurse on Nurse.EId=Employee.Id';
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
                            echo '<a class="btn" href="myreadnurse.php?id='.$row['PId'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="myupdatenurse.php?id='.$row['PId'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="mydeletenurse.php?id='.$row['PId'].'">Delete</a>';
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

<!-- PHYSICIAN -->
  <div class="container physc" id="phys" style="display:none; height:auto; overflow:hidden;">
            <div class="row">
                <h3>Physician Manage</h3>
            </div>
            <div class="row">
                <p>
                   <a href="myphyscreate.php" class="btn btn-warning">Create Physician</a>
                  <button id="backphys" class="btn btn-primary back">Back to Employee(s)</button>
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
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $query = 'Select * from Persons inner join Employee on Employee.PId=Persons.Id inner join Physician on Physician.EId=Employee.Id';
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
                            echo '<a class="btn" href="myreadphys.php?id='.$row['PId'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="myupdatephys.php?id='.$row['PId'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="mydeletephys.php?id='.$row['PId'].'">Delete</a>';
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
 
 
function setContainerHeightph() {
    var heightnow=$(".overall").height();
    var heightfull=$(".physc").css({height:'auto'}).height();
     // alert("here");
     $(".overall").css({height:heightnow}).animate({
        height: heightfull
    }, 200);

     }

function setContainerHeightnu() {
    var heightnow=$(".overall").height();
    var heightfull=$("#nurse").css({height:'auto'}).height();
     // alert("here");
     $(".overall").css({height:heightnow}).animate({
        height: heightfull
    }, 200);
     }
function setContainerHeighttech() {
    var heightnow=$(".overall").height();
    var heightfull=$("#tech").css({height:'auto'}).height();
     // alert("here");
     $(".overall").css({height:heightnow}).animate({
        height: heightfull
    }, 200);
     }
function setContainerHeightback(str) {
    var heightnow=$(str).height();
    var heightfull=$(".overall").css({height:'auto'}).height();
     // alert("here");
     $(str).css({height:heightnow}).animate({
        height: heightfull,
    }, 200);
      }
$('#physbtn').on('click', function(){
    
    setContainerHeightph();
});

$('#nursebtn').on('click', function(){
    setContainerHeightnu();
});
$('#techbtn').on('click', function(){
    setContainerHeighttech();
});

$('#backphys').on('click', function(){
    setContainerHeightback(".physc");
});

$('#backnurse').on('click', function(){
    setContainerHeightback("#nurse");
});
$('#backtech').on('click', function(){
    setContainerHeightback("#tech");
});
    $(document).ready(function(){
  
  $("#physbtn").click(function(){
    $(".overall").fadeOut("200");
// 
      setTimeout(function() {
    $("#phys").fadeIn("200");
    }, 610);

  });

  $(".back").click(function(){
    // alert("ready");
    $("#phys").fadeOut("20");
    $("#nurse").fadeOut("200");
    $("#tech").fadeOut("200");

      setTimeout(function() {
    $(".overall").fadeIn("200");
    }, 605);

  });


  $("#techbtn").click(function(){
    $(".overall").fadeOut("200");
      
      setTimeout(function() {
    $("#tech").fadeIn("200");
    }, 610);
  });

  $("#nursebtn").click(function(){
    $(".overall").fadeOut("200");
      
      setTimeout(function() {
    $("#nurse").fadeIn("200");
    }, 610);
  });
});
</script>
</body>

</html>
<?php
}
}
else {
    echo 'You are not authorized to view this page';
}
?>