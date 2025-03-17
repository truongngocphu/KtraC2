<?php
require_once __DIR__ . '/../models/HocPhan.php';
$hocPhanModel = new HocPhan();
$hocPhans = $hocPhanModel->getAll();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['maHP'])) {
    session_start();
    if (!isset($_SESSION['MaSV'])) {
        header("Location: /views/auth/login.php");
        exit;
    }

    $maSV = $_SESSION['MaSV'];
    $maHP = $_POST['maHP'];
    if ($hocPhanModel->register($maSV, $maHP)) {
        echo "<script>alert('Đăng ký thành công!');</script>";
    } else {
        echo "<script>alert('Lỗi khi đăng ký học phần!');</script>";
    }
}
?>
