<?php require_once __DIR__ . '/../../controllers/HocPhanController.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Học Phần</title>
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
            max-width: 800px;
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
            background-color: #28a745;
            border: none;
            padding: 8px 12px;
            color: white;
            font-size: 14px;
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
        <h2>Danh Sách Học Phần</h2>

        <!-- Hiển thị thông báo -->
        <?php if (!empty($_GET['message'])): ?>
            <p class="message <?= $_GET['status'] == 'success' ? 'success' : 'error' ?>">
                <?= htmlspecialchars($_GET['message']) ?>
            </p>
        <?php endif; ?>

        <table>
            <tr>
                <th>Mã HP</th>
                <th>Tên Học Phần</th>
                <th>Số Tín Chỉ</th>
                <th>Đăng Ký</th>
            </tr>
            <?php foreach ($hocPhans as $hp): ?>
            <tr>
                <td><?= htmlspecialchars($hp['MaHP']) ?></td>
                <td><?= htmlspecialchars($hp['TenHP']) ?></td>
                <td><?= htmlspecialchars($hp['SoTinChi']) ?></td>
                <td>
                    <form method="POST" action="/controllers/HocPhanController.php">
                        <input type="hidden" name="maHP" value="<?= htmlspecialchars($hp['MaHP']) ?>">
                        <button type="submit">Đăng Ký</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>

        <a href="/views/dangky/index.php" class="back-link">Xem học phần đã đăng ký →</a>
    </div>
</body>
</html>
