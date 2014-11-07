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
#in, #out, #overall , body, #page-wrapper,  .container-fluid{
  -webkit-backface-visibility: hidden;
}
#in, #out, #overall, #page-wrapper,  .container-fluid{
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
 <div class="container" id="overall" style="height:auto;overflow:hidden;">
            <div class="row">
                <h3>Manage Patients</h3>
            </div>
            <div class="row">
                <p>
                  <button class="btn btn-success btn-block" id="inbtn" >IN Patients</button>
                </p>
                <p>
                   <button class="btn btn-info btn-block" id="outbtn" >OUT Patients</button>
                </p><hr><p>All Patients</p>
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
                   require_once('connectvars.php');
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
            </table><hr>
        </div>
    </div>           

<!-- IN PATIENTS -->
<div class="container" id="in" style="display:none;height:auto;overflow:hidden;">
            <div class="row">
                <h3>Manage IN Patients</h3>
            </div>
            <div class="row">
                <p>
                   <a href="createinpatient.php" class="btn btn-warning">Create IN Patient</a>
                   <button class="btn btn-primary" id="backin">Back to Patient</button>
                </p><hr>
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
                            echo '<a class="btn" href="myreadin.php?id='.$row['PId'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="myupdatein.php?id='.$row['PId'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="mydeletein.php?id='.$row['PId'].'">Delete</a>';
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

<!-- OUT -->
   <div class="container" id="out" style="display:none;height:auto;overflow:hidden;">
            <div class="row">
                <h3>Manage OUT Patients</h3>
            </div>
            <div class="row">
                <p>
                   <a href="createoutpatient.php" class="btn btn-warning">Create OUT Patient</a>
                   <button class="btn btn-primary" id="backout">Back to Patient</button>
                </p><hr>
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
                   // require_once('../connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                  // $query = 'SELECT * FROM Persons';
                   $query = 'Select * from Persons inner join Patient on Patient.PId=Persons.Id inner join Outpatient on Outpatient.PtId=Patient.Id';
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
                            echo '<a class="btn" href="myreadout.php?id='.$row['PId'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="myupdateout.php?id='.$row['PId'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="mydeleteout.php?id='.$row['PId'].'">Delete</a>';
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

function setContainerHeightin() {
    var heightnow=$("#overall").height();
    var heightfull=$("#in").css({height:'auto'}).height();
     // alert("here");
     $("#overall").css({height:heightnow}).animate({
        height: heightfull
    }, 200);

     }

function setContainerHeightout() {
    var heightnow=$("#overall").height();
    var heightfull=$("#out").css({height:'auto'}).height();
     // alert("here");
     $("#overall").css({height:heightnow}).animate({
        height: heightfull
    }, 200);
     }

function setContainerHeightback(str) {
    var heightnow=$(str).height();
    var heightfull=$("#overall").css({height:'auto'}).height();
     // alert("here");
     $(str).css({height:heightnow}).animate({
        height: heightfull,
    }, 200);
  }
  $('#inbtn').on('click', function(){
    setContainerHeightin();
});
$('#outbtn').on('click', function(){
    setContainerHeightout();
});

$('#backin').on('click', function(){
    setContainerHeightback("#in");
});

$('#backout').on('click', function(){
    setContainerHeightback("#out");
});

    $(document).ready(function(){

  $("#inbtn").click(function(){
    // alert("ready");
    $("#overall").fadeOut("200");
      
      setTimeout(function() {
    $("#in").fadeIn("200");
    }, 605);

  });

  $("#backin").click(function(){
    // alert("ready");
    $("#in").fadeOut("200");
    $("#out").fadeOut("200");

      setTimeout(function() {
    $("#overall").fadeIn("200");
    },605);

  });
    $("#backout").click(function(){
    // alert("ready");
    $("#in").fadeOut("200");
    $("#out").fadeOut("200");

      setTimeout(function() {
    $("#overall").fadeIn("200");
    }, 605);

  });

  $("#outbtn").click(function(){
    $("#overall").fadeOut("200");
      
      setTimeout(function() {
    $("#out").fadeIn("200");
    }, 605);
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