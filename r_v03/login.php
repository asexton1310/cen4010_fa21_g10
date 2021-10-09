<?php
  include_once 'header.php';
?>

<div class="container-fluid">
    <div class="container-sm posts shadow p-3 mb-5 bg-white rounded">
    <div class="container title"><h3>login</h3></div>
    <form action = "include/script_login.php" method="post">
        <div class="form-group">
          <label for="email">Email address</label>
          <input type="text" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" name="userName">

        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" id="password" placeholder="Password" name="passd">
        </div>
        <br>
        <button type="submit" name = "login" class="btn btn-dark">Login</button>
      </form>
      <br>
    <div class="container footer"><p class="footer">.</p></div>
</div>>


<?php
  include_once 'footer.php';
?>