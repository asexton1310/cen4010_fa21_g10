<?php
  include_once 'header.php';
?>



<?php
    require_once 'include/script_db_connection.php';
    require_once 'include/script_functions.php';

	if($_SERVER['REQUEST_METHOD'] == "POST"){
	
		$userName = $_POST['userName'];
		$password = $_POST['password'];
		$firstName = $_POST['firstName'];
		$lastName = $_POST['lastName'];
		$email = $_POST['email'];
	}
?>
      <div class="container-fluid">
      <div class="container-sm posts shadow p-3 mb-5 bg-white rounded">
      <div class="container title"><h3>post</h3></div>
      <div class="container content">

      <form action = "include/script_post.php" method="POST" enctype="multipart/form-data">
      <div class="form-group">
      <label for="exampleFormControlInput1">Title</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title for Post" name="title">
      </div>
      <div class="form-group">
      <label for="exampleFormControlTextarea1">Content</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "content"></textarea>
      </div>
      <br>
      <label>Select Image File:</label>
      <input type="file" name="image"  accept=".png,.jpg,.jpeg" value="upload"/>
      <br>
      <br>
      <label for="d">Who can view this post</label>
      <select class="form-select" aria-label="Default select example" id="d" name="postLevel">
      <option value="0">community</option>
      <option value="1">friends only</option>
      <option value="2">best friends</option>
      </select>
      <br>
      <button type="postSubmit" name = "postSubmit" class="btn btn-dark" value="Upload">Submit</button>  
      </form>
    
      <?php
        // display post error messages to user
        if(isset($_GET['error'])){
          if($_GET['error'] == "title_empty"){
            echo "<p>post missing title</p>";
            }
          else if($_GET['error'] == "content_empty"){
             echo "<p>post missing content</p>";
           }
          else if($_GET['error'] == "format_error"){
             echo "<p>file must be under 3 MB</p>";
         }
        }
      ?>

    <br>  
   </div>
    <div class="container footer"><p class="footer">.</p></div>
</div>

<?php
  include_once 'footer.php';
?>