<?php
require_once __DIR__ . '/../../models/SinhVien.php';

if (!isset($_GET['id'])) {
    header("Location: index.php?message=Lỗi: Không tìm thấy sinh viên!&status=error");
    exit();
}

$model = new SinhVien();
$sinhVien = $model->getById($_GET['id']); // Hàm lấy thông tin sinh viên theo ID

if (!$sinhVien) {
    header("Location: index.php?message=Lỗi: Sinh viên không tồn tại!&status=error");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model->delete($_GET['id']);
    header("Location: index.php?message=Xóa thành công!&status=success");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xác nhận Xóa Sinh Viên</title>
    <link rel="stylesheet" href="/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 400px;
            text-align: center;
        }
        h2 {
            color: #dc3545;
        }
        p {
            font-size: 16px;
        }
        .actions {
            margin-top: 20px;
        }
        button, .cancel {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .delete-btn {
            background-color: #dc3545;
            color: white;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .cancel {
            background-color: #6c757d;
            color: white;
            text-decoration: none;
            display: inline-block;
            padding: 10px 15px;
        }
        .cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Xóa Sinh Viên?</h2>
        <p><strong>Mã SV:</strong> <?= htmlspecialchars($sinhVien['MaSV']) ?></p>
        <p><strong>Họ Tên:</strong> <?= htmlspecialchars($sinhVien['HoTen']) ?></p>
        <p><strong>Giới Tính:</strong> <?= htmlspecialchars($sinhVien['GioiTinh']) ?></p>
        <p><strong>Ngày Sinh:</strong> <?= htmlspecialchars($sinhVien['NgaySinh']) ?></p>

        <p style="color: red;">Bạn có chắc chắn muốn xóa sinh viên này?</p>

        <form method="POST" class="actions">
            <button type="submit" class="delete-btn">Xóa</button>
            <a href="index.php" class="cancel">Hủy</a>
        </form>
    </div>
</body>
</html>
