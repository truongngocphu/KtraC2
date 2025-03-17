<?php require_once __DIR__ . '/../../controllers/HocPhanController.php'; ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký Học Phần</title>
    <link rel="stylesheet" href="/styles.css">
</head>
<body>
    <h2>Danh Sách Học Phần</h2>
    <table border="1">
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
                <form method="POST">
                    <input type="hidden" name="maHP" value="<?= htmlspecialchars($hp['MaHP']) ?>">
                    <button type="submit">Đăng Ký</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
