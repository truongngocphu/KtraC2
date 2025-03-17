<?php
require_once __DIR__ . '/../../models/SinhVien.php';
$model = new SinhVien();
$stmt = $model->getAll();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sinh Viên</title>
    <link rel="stylesheet" href="/styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 900px;
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
        .add-btn {
            display: inline-block;
            margin-bottom: 15px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .add-btn:hover {
            background-color: #218838;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007bff;
            color: white;
        }
        img {
            border-radius: 50%;
        }
        .actions a {
            text-decoration: none;
            padding: 5px 10px;
            border-radius: 5px;
            margin: 2px;
            display: inline-block;
        }
        .view-btn { background-color: #17a2b8; color: white; }
        .edit-btn { background-color: #ffc107; color: black; }
        .delete-btn { background-color: #dc3545; color: white; }
        .view-btn:hover { background-color: #138496; }
        .edit-btn:hover { background-color: #e0a800; }
        .delete-btn:hover { background-color: #c82333; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Danh Sách Sinh Viên</h2>

        <a href="create.php" class="add-btn">➕ Thêm sinh viên</a>

        <table>
            <tr>
                <th>Mã SV</th>
                <th>Họ Tên</th>
                <th>Giới Tính</th>
                <th>Ngày Sinh</th>
                <th>Hình Ảnh</th>
                <th>Ngành Học</th>
                <th>Hành Động</th>
            </tr>
            <?php while ($sv = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                <tr>
                    <td><?= htmlspecialchars($sv['MaSV']); ?></td>
                    <td><?= htmlspecialchars($sv['HoTen']); ?></td>
                    <td><?= htmlspecialchars($sv['GioiTinh']); ?></td>
                    <td><?= htmlspecialchars($sv['NgaySinh']); ?></td>
                    <td><img src="<?= htmlspecialchars($sv['Hinh']); ?>" width="50"></td>
                    <td><?= htmlspecialchars($sv['TenNganh']); ?></td>
                    <td class="actions">
                        <a href="detail.php?id=<?= $sv['MaSV']; ?>" class="view-btn">👁 Xem</a>
                        <a href="edit.php?id=<?= $sv['MaSV']; ?>" class="edit-btn">✏️ Sửa</a>
                        <a href="delete.php?id=<?= $sv['MaSV']; ?>" class="delete-btn" onclick="return confirm('Xóa sinh viên?')">🗑 Xóa</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>
</body>
</html>
