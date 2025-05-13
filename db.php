<?php
// ข้อมูลการเชื่อมต่อ
$host = 'localhost';  // หรือ IP ของ PostgreSQL Server
$dbname = 'login_register';
$user = 'postgres';
$pass = 'P@ssw0rd';

try {
    // สร้างการเชื่อมต่อกับ PostgreSQL
    $dsn = "pgsql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $user, $pass);

    // ตั้งค่าการแสดงข้อผิดพลาดของ PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    //echo "เชื่อมต่อ PostgreSQL สำเร็จ!";
} catch (PDOException $e) {
    // ถ้าเชื่อมต่อไม่สำเร็จ
    //echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}
?>