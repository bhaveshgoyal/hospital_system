<?php
  ob_start();
  session_start();  
   if(isset($_SESSION['adminornot'])) {
          if($_SESSION['adminornot'] == '1') { 
  require_once('connectvars.php');
 
    $id = null;
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
     
    if ( null==$id ) {
        header("Location: mylabs.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        $nameError = null;
         $testError = null;
        // keep track post values
        $name = $_POST['name'];
         
        // validate input
        $valid = true;
        if (empty($name)) {
            $nameError = 'Please enter Name';
            $valid = false;
        }
        $count = $_POST['count'];
        if($count >= '1') {
            $flag = 0;
            $count = (int)$count;
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            $query = "Select * from Test where LId='$id'";
            $result3 = mysqli_query($dbc, $query);
            while($row = mysqli_fetch_array($result3)) {
              $testname = $_POST[$row['Id']];
                if(empty($testname)) {
                  $flag = 1;
                }
              }
                if($flag == 1) {
                    $testError = 'Some Fields have been left Empty';
                    $valid = false;
                    $query = "Select * from Test where LId='$id'";
                    $result2 = mysqli_query($dbc, $query);
                    mysqli_close($dbc);
                  }
        } 
         
        // update data
        if ($valid) {
         echo 'yes';
         $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
         $query = "UPDATE Lab SET Name='$name' WHERE Id='$id'";
         mysqli_query($dbc, $query);
        $query = "Select * from Test where LId='$id'";
        $result3 = mysqli_query($dbc, $query);
        while($row = mysqli_fetch_array($result3)) {
         $send = $_POST[$row['Id']];
         $send2 = $row['Id'];
         $query = "UPDATE Test SET TName='$send' where Id='$send2'";
         mysqli_query($dbc, $query);
         }
         mysqli_close($dbc);
         header("Location: mylabs.php");
      }
    } else {
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
        $query = "SELECT * from Lab where Id='$id'";
        $result = mysqli_query($dbc, $query);
        $data = mysqli_fetch_array($result);
        $query = "SELECT * from Test where LId='$id'";
        $result2 = mysqli_query($dbc, $query);
 //       $data2 = mysqli_fetch_array($result);
        $name = $data['Name'];
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
                                <i class="fa fa-table"></i> Manage Laboratory
                            </li>
                        </ol>
                    </div>
                </div>
                <!-- /.row -->
                
    <div class="container" style="display:none;">
     
                <div class="span10 offset1">
                    <div class="row">
                        <h3>Update Tests In <?php echo !empty($name)?$name:'';?></h3>
                    </div>
             
                    <form class="form-horizontal" action="myupdatelab.php?id=<?php echo $id?>" method="post">
                     <div class="control-group <?php echo !empty($nameError)?'error':'';?>">
                        <label class="control-label">Lab Name</label>
                        <div class="controls">
                            <input name="name" type="text" class="form-control" placeholder="Lab Name" value="<?php echo !empty($name)?$name:'';?>">
                            <?php if (!empty($nameError)): ?>
                                <span class="help-block" style="color:red;"><?php echo $nameError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <?php
                        if(!empty($result2)) {
                              $i = 1;
                            if(!empty($testError)) {
                               $add  = 'error';
                            }
                            else {
                              $add = null;
                            }
                          while($row = mysqli_fetch_array($result2)) {
                        echo '<div class="control-group '.$add.'">
                         <label class="control-label">Test Name '.$i.' :</label>
                             <div class="controls">
                            <input name="'.$row['Id'].'" type="text" class="form-control" placeholder="Test Name" value="'.$row['TName'].'">
                              </div>
                      </div>';
                             $i++;
                           }
                         echo '<input type="hidden" name="count" value="'.$i.'">';
                          }
                         ?>

                          <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn btn-primary" href="mylabs.php">Back</a>
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

    $(".container").toggle("slide"); 
     });
</script>
</body>

</html>
<?php
  }
}
?>
