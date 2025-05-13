<?php
  session_start();
  require_once 'config/db.php';


  //Check when cilck sign up
  if(isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $urole = 'user';

  //Check not empty
  if(empty($firstname)) {
    $_SESSION['error'] = 'กรุณากรอกชื่อจริง';
    header("location: index.php");
  } else if(empty($lastname)) {
    $_SESSION['error'] = 'กรุณากรอกนามสกุล';
    header("location: index.php");
  } else if(empty($email)) {
    $_SESSION['error'] = 'กรุณากรอกอีเมล์';
    header("location: index.php");
  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'รูปแบบอีเมล์ไม่ถูกต้อง';
    header("location: index.php");
  } else if (empty($password)) {
    $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
    header("location: index.php");
  } else if (strlen($password) > 9 || strlen($password)  < 3) {
    $_SESSION['error'] = 'รหัสผ่านต้องมีความยาวระหว่าง 4 ถึง 8 ตัว';
    header("location: index.php");
  } else if (empty($c_password)) {
    $_SESSION['error'] = 'กรุณากรอกรหัสผ่าน';
    header("location: index.php");
  } else if ($password != $c_password) {
    $_SESSION['error'] = 'รหัสผ่านไม่ตรงกัน';
    header("location: index.php");
  } // Check Email ซ้ำ
  else {
    try {
      $check_email = $pdo->prepare("SELECT email FROM login_register WHERE email = :email");
      $check_email->bindParam(":email", $email);
      $check_email->execute();
      $row = $check_email->fetch(PDO::FETCH_ASSOC);

      if($row['email'] == $email) {
        $_SESSION['warning'] = "มีอีเมล์นี้อยู่ในระบบแล้ว<a href='signin.php'>คลิ๊กที่นี่</a>เพื่อเข้าสู่ระบบ";
        header("location: index.php");
      } else if (!isset($_SESSION['error'])) {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO login_register(firstname, lastname, email, password, urole)
                VALUES (:firstname, :lastname, :email, :password, :urole)");
        $stmt->bindParam(":firstname",  $firstname);
        $stmt->bindParam(":lastname",  $lastname);
        $stmt->bindParam(":email",  $email);
        $stmt->bindParam(":password",  $passwordHash);
        $stmt->bindParam(":urole",  $urole);
        $stmt->execute();
        $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว<a href='signin.php'>คลิ๊กที่นี่</a>เพื่อเข้าสู่ระบบ";
        header("location: index.php");
      } else {
        $_SESSION['error'] = "มีบางอย่างผิดพลาด";
        header("location: index.php");
      }
    } catch(PDOException $e) {
      echo $e->getMessage();
    }
  }
}
?>
