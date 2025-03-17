<?php
require_once __DIR__ . '/../../models/SinhVien.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = __DIR__ . "/../../images/";
    $fileName = basename($_FILES["Hinh"]["name"]);
    $uploadFile = $uploadDir . $fileName;
    $fileUrl = "/image/" . $fileName; // Đường dẫn lưu vào database

    // Kiểm tra và di chuyển file
    if (move_uploaded_file($_FILES["Hinh"]["tmp_name"], $uploadFile)) {
        $model = new SinhVien();
        $model->add($_POST['MaSV'], $_POST['HoTen'], $_POST['GioiTinh'], $_POST['NgaySinh'], $fileUrl, $_POST['MaNganh']);
        header("Location: index.php");
    } else {
        echo "Lỗi khi tải lên hình ảnh.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <link rel="stylesheet" href="/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
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
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            text-align: left;
            font-weight: bold;
            margin: 5px 0 2px;
        }
        input, select {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            width: 100%;
        }
        button {
            background-color: #28a745;
            border: none;
            padding: 10px;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            margin-top: 10px;
            padding: 10px;
            border-radius: 5px;
            font-weight: bold;
            text-align: center;
            width: 100%;
        }
        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .back-link {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #007BFF;
            font-weight: bold;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Thêm Sinh Viên</h2>

        <?php if (!empty($error)): ?>
            <p class="message error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data">
    Mã SV: <input type="text" name="MaSV" required><br>
    Họ Tên: <input type="text" name="HoTen" required><br>
    Giới Tính: 
    <select name="GioiTinh">
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select><br>
    Ngày Sinh: <input type="date" name="NgaySinh" required><br>
    Hình Ảnh: <input type="file" name="Hinh" required><br>
    Mã Ngành: <input type="text" name="MaNganh" required><br>
    <button type="submit">Thêm</button>
</form>

        <a href="index.php" class="back-link">Quay lại danh sách sinh viên</a>
    </div>
</body>
</html>
