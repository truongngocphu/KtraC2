<?php require_once __DIR__ . '/../../controllers/DangKyController.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Học Phần Đã Đăng Ký</title>
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
            max-width: 600px;
            text-align: center;
        }
        h2 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
        td {
            background-color: #fff;
        }
        button {
            background-color: #ff4d4d;
            border: none;
            padding: 8px 12px;
            color: white;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }
        button:hover {
            background-color: #cc0000;
        }
        .delete-all {
            background-color: #333;
            margin-top: 15px;
        }
        .delete-all:hover {
            background-color: #000;
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
        <h2>Danh Sách Học Phần Đã Đăng Ký</h2>

        <?php if (!empty($registeredCourses)): ?>
            <table>
                <tr>
                    <th>Mã HP</th>
                    <th>Tên Học Phần</th>
                    <th>Số Tín Chỉ</th>
                    <th>Hành Động</th>
                </tr>
                <?php foreach ($registeredCourses as $course): ?>
                    <tr>
                        <td><?= htmlspecialchars($course['MaHP']) ?></td>
                        <td><?= htmlspecialchars($course['TenHP']) ?></td>
                        <td><?= htmlspecialchars($course['SoTinChi']) ?></td>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="maHP" value="<?= htmlspecialchars($course['MaHP']) ?>">
                                <button type="submit" name="deleteOne">Xóa</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <form method="POST">
                <button type="submit" name="deleteAll" class="delete-all" onclick="return confirm('Bạn có chắc muốn xóa tất cả học phần?')">
                    Xóa Tất Cả
                </button>
            </form>
        <?php else: ?>
            <p style="color: red;">Chưa đăng ký học phần nào.</p>
        <?php endif; ?>

        <a href="/views/hocphan/index.php" class="back-link">← Quay lại đăng ký học phần</a>
    </div>
</body>
</html>
