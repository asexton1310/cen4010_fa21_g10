<?php
  include_once 'header.php';
?>


<?php
 if (isset($_SESSION["userName"])){
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $search_value=$_POST["search"];
    $current_reqest_row_num = 1;
   
        // table of returned user names
        echo '<div class="container-fluid">';
        echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
        echo '<div class="container title"><h3>searched for users</h3></div>';
        echo '<table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Username</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
          </tr>
        </thead>
        <tbody>';
        
        if($conn->connect_error){
          echo 'Connection Faild: '.$conn->connect_error;
        }
        else{
          $sql="select * from relay_user where userName like '%$search_value%' OR firstName like '%$search_value%' OR lastName like '%$search_value%'";
          $result=$conn->query($sql);
          while($row=$result->fetch_assoc()){
            echo '<tr>';
            echo '<th scope="row">' .$current_reqest_row_num. ' </th>';
            echo '<td><a href="user_profile.php?usrName=' .$row["userName"].'"> '.$row["userName"]. '</a></td>';
            echo '<td>'.$row["firstName"].'</td>';
            echo '<td>'.$row["lastName"].'</td>';
            echo '</tr>';
            $current_reqest_row_num = $current_reqest_row_num + 1;
          }
        }
      }
    else{
      header("location: login.php");
    }
?>
<?php
  include_once 'footer.php';
?>


