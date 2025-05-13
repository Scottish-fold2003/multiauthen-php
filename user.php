<?php 

session_start();
require_once 'config/db.php';
if (!isset($_SESSION['user_login'])) {
  $_SESSION['error'] ="กรุณาเข้าสู่ระบบ";
  header("location: signin.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User Page</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <?php 
      if(isset($_SESSION['user_login'])) {
        $user_id = $_SESSION['user_login'];
        $stmt = $pdo->query("SELECT * FROM login_register WHERE id = $user_id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
      }
    ?>
    <h3 class="mt-4">Welcome User, <?php echo $row['firstname'] . ' ' . $row['lastname'];?></h3>
    <a href="logout.php" class="btn btn-danger">Log Out</a>
  </div>
</body>
</html>