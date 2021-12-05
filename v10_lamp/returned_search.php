<?php
  include_once 'header.php';
?>

<?php
 if (isset($_SESSION["userName"])){
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

    $search_value=sanitizeString($_POST["search"]);
    $current_reqest_row_num = 1;
    echo '<div class="main_container">';
          
    if($conn->connect_error){
      echo 'Connection Faild: '.$conn->connect_error;
    }
    
    switch($_POST['results']){
      case "user":
        // table of returned user names
        echo '<div class="container-fluid">';
        echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
        echo '<div class="container_title"><h3>Results for "'?><?php echo $search_value;?><?php echo  '" </h3></div>';

          $sql="select * from relay_user where userName like '%$search_value%' OR firstName like '%$search_value%' OR lastName like '%$search_value%'";
          $result=$conn->query($sql);
          echo 'Search Total: ';
          echo $result->num_rows;

        if ($result->num_rows>0){
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
        else{
          echo '<br>';
          echo "No records found.";
        }

      break;

      case "post":
       // returned posts
       echo '<div class="container-fluid">';
       echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
       echo '<div class="container title"><h3>searched for posts</h3></div>';
       echo '<table class="table">

       <tbody>';
         $currentUser = $_SESSION["userName"];
         //ugly query that returns public posts that match search criteria, or friends/best friends only posts that meet criteria 
         // AND the post author is a friend of the user who performed the search
         $sql="SELECT * from posts, (SELECT currentUser, relationship_level FROM relationship_table 
                                    WHERE otherUser='$currentUser' AND relationship_level >= 0) AS relationship_results  
                where (posts.title like '%$search_value%' AND posts.postLevel = 0) OR (posts.content like '%$search_value%' AND posts.postLevel = 0)
                OR (posts.title like '%$search_value%' AND posts.postLevel <= relationship_results.relationship_level AND posts.usrName = relationship_results.currentUser)
                OR (posts.content like '%$search_value%' AND posts.postLevel <= relationship_results.relationship_level AND posts.usrName = relationship_results.currentUser)";

         $result=$conn->query($sql);
       
         echo 'Search results: ';
         echo $search_value;

         if ($result->num_rows>0){
          while ($row = $result->fetch_assoc()) {
            
            if($row["postLevel"] >= 0){
              echo '<div class="container-fluid">';
              echo '<div class="container-sm posts shadow p-3 mb-5 bg-white rounded">';
              echo '<div class="container_title" ><h3>'; echo '<a href="user_profile.php?usrName='.$row["usrName"].'">'; echo $row["usrName"]; echo '</a>'; echo " // "; echo $row["title"];  echo " // "; echo $row["postDate"]; echo '</h3></div>';
              echo '<div class="container teaser">';
              echo $row["teaser"]; 
              echo '<br>';
              if ($row["image"]){
              ?>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" style='height: 100%; width: 100%; object-fit: cover' /> 
              <?php }
              echo '<br>';
              echo '<br>';
              echo '</div>';
              echo '<div class="container footer"><p class="footer">'; echo '<a href="include/script_add_likes.php?id='.$row["id"].'&likes='.$row["likes"].'">'; echo 'like  </a> // '; echo $row["likes"]; echo '</p></div>';
              echo '</div>';
              echo '</div>';
          }
          }
         }
         else{
             echo '<br>';
             echo "No records found";
         }
         break;
       }
      }
?>
<?php
  
  

  include_once 'footer.php';
?>


