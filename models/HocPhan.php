<?php
require_once __DIR__ . '/../config/Database.php';

class HocPhan {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
        $this->checkAndAddColumn(); // Kiểm tra và thêm cột nếu chưa có
    }

    // Kiểm tra nếu chưa có cột SoLuongDuKien thì thêm vào
    private function checkAndAddColumn() {
        $sql = "SHOW COLUMNS FROM HocPhan LIKE 'SoLuongDuKien'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $columnExists = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$columnExists) {
            $sqlAddColumn = "ALTER TABLE HocPhan ADD COLUMN SoLuongDuKien INT DEFAULT 50";
            $this->conn->exec($sqlAddColumn);
        }
    }

    // Lấy danh sách học phần
    public function getAll() {
        $sql = "SELECT MaHP, TenHP, SoTinChi, SoLuongDuKien FROM HocPhan";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy mã đăng ký của sinh viên (hoặc tạo mới nếu chưa có)
    private function getMaDK($maSV) {
        $sql = "SELECT MaDK FROM DangKy WHERE MaSV = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$maSV]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            return $result['MaDK'];
        } else {
            // Kiểm tra xem MaSV có tồn tại không
            $sqlCheckSV = "SELECT * FROM sinhvien WHERE MaSV = ?";
            $stmtCheckSV = $this->conn->prepare($sqlCheckSV);
            $stmtCheckSV->execute([$maSV]);
            if (!$stmtCheckSV->fetch()) {
                throw new Exception("Lỗi: Mã sinh viên không tồn tại trong hệ thống!");
            }
    
            // Nếu tồn tại, tạo mới MaDK
            $sqlInsert = "INSERT INTO DangKy (MaSV) VALUES (?)";
            $stmtInsert = $this->conn->prepare($sqlInsert);
            $stmtInsert->execute([$maSV]);
            return $this->conn->lastInsertId();
        }
    }
    
    

    // Đăng ký học phần
    public function register($maSV, $maHP) {
        $maDK = $this->getMaDK($maSV);

        // Kiểm tra số lượng sinh viên còn chỗ trống
        $sqlCheck = "SELECT SoLuongDuKien FROM HocPhan WHERE MaHP = ?";
        $stmtCheck = $this->conn->prepare($sqlCheck);
        $stmtCheck->execute([$maHP]);
        $result = $stmtCheck->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['SoLuongDuKien'] > 0) {
            // Thêm đăng ký vào bảng ChiTietDangKy
            $sql = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$maDK, $maHP]);

            // Cập nhật số lượng dự kiến
            $sqlUpdate = "UPDATE HocPhan SET SoLuongDuKien = SoLuongDuKien - 1 WHERE MaHP = ?";
            $stmtUpdate = $this->conn->prepare($sqlUpdate);
            $stmtUpdate->execute([$maHP]);

            return true;
        }
        return false;
    }
}
?>
