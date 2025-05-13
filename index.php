<?php
  session_start();
  require_once 'config/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
    <div class="container">
      <h3 class="mt-4">ลงทะเบียน</h3>
      <hr/>
      <form action="signup_db.php" method="POST">
        <?php if(isset($_SESSION['error'])) {?>
          <div class="alert alert-danger" role="alert">
            <?php 
              echo $_SESSION['error'];
              unset($_SESSION['error']);
            ?>
          </div>
        <?php }?>
        <?php if(isset($_SESSION['success'])) {?>
          <div class="alert alert-success" role="alert">
            <?php 
              echo $_SESSION['success'];
              unset($_SESSION['success']);
            ?>
          </div>
        <?php }?>
        <?php if(isset($_SESSION['warning'])) {?>
          <div class="alert alert-warning" role="alert">
            <?php 
              echo $_SESSION['warning'];
              unset($_SESSION['warning']);
            ?>
          </div>
        <?php }?>
  <div class="mb-3">
    <label for="firstname" class="form-label">First Name</label>
    <input type="text" class="form-control" id="firstname" name="firstname" aria-describedby="firstname">
  </div>
  <div class="mb-3">
    <label for="lastname" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="lastname" name="lastname" aria-describedby="lastname">
  </div>
  <div class="mb-3">
    <label for="email" class="form-label">email</label>
    <input type="email" class="form-control" id="email" name="email" aria-describedby="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <div class="mb-3">
    <label for="confirm password" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" id="c_password" name="c_password">
  </div>
  <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
</form>
<hr/>
<p>เป็นสมาชิกแล้วใช่มั้ย<a href="signin.php">เข้าสู่ระบบ</a></p>
    </div>
</body>
</html>