<?php
require_once __DIR__ . '/../../models/SinhVien.php';
$model = new SinhVien();
$sv = $model->getById($_GET['id']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $model->update($_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'], $_POST['NgaySinh'], $_POST['Hinh'], $_POST['MaNganh']);
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Sinh Viên</title>
    <link rel="stylesheet" href="/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-update {
            background-color: #007bff;
            color: white;
        }
        .btn-update:hover {
            background-color: #0056b3;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Chỉnh Sửa Sinh Viên</h2>
        <form method="post">
            <div class="form-group">
                <label>Mã SV:</label>
                <input type="text" name="MaSV" value="<?= htmlspecialchars($sv['MaSV']) ?>" readonly>
            </div>
            <div class="form-group">
                <label>Họ Tên:</label>
                <input type="text" name="HoTen" value="<?= htmlspecialchars($sv['HoTen']) ?>" required>
            </div>
            <div class="form-group">
                <label>Giới Tính:</label>
                <input type="text" name="GioiTinh" value="<?= htmlspecialchars($sv['GioiTinh']) ?>" required>
            </div>
            <div class="form-group">
                <label>Ngày Sinh:</label>
                <input type="date" name="NgaySinh" value="<?= htmlspecialchars($sv['NgaySinh']) ?>" required>
            </div>
            <div class="form-group">
                <label>Hình Ảnh (URL):</label>
                <input type="text" name="Hinh" value="<?= htmlspecialchars($sv['Hinh']) ?>">
            </div>
            <div class="form-group">
                <label>Mã Ngành:</label>
                <input type="text" name="MaNganh" value="<?= htmlspecialchars($sv['MaNganh']) ?>" required>
            </div>
            <div class="btn-container">
                <button type="submit" class="btn btn-update">Cập Nhật</button>
                <a href="index.php" class="btn btn-back">Quay Lại</a>
            </div>
        </form>
    </div>
</body>
</html>
