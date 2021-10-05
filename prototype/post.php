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
      <form action = "include/script_post.php" method="POST">
      <div class="form-group">
      <label for="exampleFormControlInput1">Title</label>
      <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Enter Title for Post" name="title">
      </div>
      <div class="form-group">
      <label for="exampleFormControlTextarea1">Content</label>
      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name = "content"></textarea>
      </div>
      <label for="d">Who can view this post.</label>
      <select class="form-select" aria-label="Default select example" id="d" name="postLevel">
      <option value="0">community</option>
      <option value="1">friends only</option>
      <option value="2">best friends</option>
      </select>
      <br>
    <button type="postSubmit" name = "postSubmit" class="btn btn-dark">Submt</button>  
    
    </form>
    
    <br>  
   </div>
    <div class="container footer"><p class="footer">.</p></div>
</div>

<?php
  include_once 'footer.php';
?>