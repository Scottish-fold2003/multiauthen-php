<?php
  session_start();
  require_once 'config/db.php';


  //Check when cilck sign up
  if(isset($_POST['signin'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

  //Check not empty
   if(empty($email)) {
    $_SESSION['error'] = 'กรุณากรอกอีเมล์';
    header("location: signin.php");
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'รูปแบบอีเมล์ไม่ถูกต้อง';
    header("location: signin.php");
  } else if (empty($password)) {
    $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
    header("location: signin.php");
  } else if (strlen($password) > 9 || strlen($password)  < 3) {
    $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 4 ถึง 8 ตัว';
    header("location: signin.php");
  }  // Check Email ซ้ำ
  else {
    try {
      $check_data = $pdo->prepare("SELECT * FROM login_register WHERE email = :email");
      $check_data->bindParam(":email", $email);
      $check_data->execute();
      $row = $check_data->fetch(PDO::FETCH_ASSOC);

      //Check ว่ามีข้อมูลในระบบมั้ย
      if($check_data->rowCount() > 0) {
        if ($email == $row['email']) {
          if (password_verify($password, $row['password'])) {
            if ($row['urole'] == 'admin') {
                $_SESSION['admin_login'] = $row['id'];
                header("location: admin.php");
            } else {
              $_SESSION['user_login'] = $row['id'];
              header("location: user.php");
            }
          } else {
            $_SESSION['error'] = "กรอกรหัสผ่านผิด";
            header("location: signin.php");
          }
        } else {
          $_SESSION['error'] = "กรอกอีเมล์ผิด";
          header("location: signin.php");
        }
      } else {
        $_SESSION['error'] = "ไม่มีข้อมูลในระบบ";
        header("location: signin.php");
      }
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
}
?>
