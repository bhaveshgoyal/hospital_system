<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                <h3>Person Add</h3>
            </div>
            <div class="row">
                <p>
                   <a href="createp.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                  <thead>
                    <tr>
                      <th>Name</th>
                      <th>Address</th>
                      <th>Gender</th>
                      <th>Phone</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                   require_once('connectvars.php');
                   $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
                   $query = 'SELECT * FROM Person';
                   $result = mysqli_query($dbc, $query);
                   if(!empty($result)) {
                   while($row = mysqli_fetch_array($result)) {
                    
                            echo '<tr>';
                            echo '<td>'. $row['fname'] .' '. $row['mname']. ' '. $row['lname'] .'</td>';
                            echo '<td>'. $row['address'] . '</td>';
                            echo '<td>'. $row['gender'] . '</td>';
                            echo '<td>'. $row['Phone'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn" href="readp.php?id='.$row['ID'].'">Read</a>';
                            echo ' ';
                            echo '<a class="btn btn-success" href="updatep.php?id='.$row['ID'].'">Update</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="deletep.php?id='.$row['ID'].'">Delete</a>';
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
