<?php
session_start();
include 'connect.php';

// Lấy username từ session
$username = $_SESSION['username'] ?? '';
$row = null;

if ($username) {
    // Lấy thông tin người dùng + gói tập qua bảng dang_ky
    $stmt = $conn->prepare("
        SELECT nd.*, gt.ten_goi, gt.so_ngay_dung
        FROM nguoi_dung nd
        LEFT JOIN dang_ky dk ON nd.id = dk.nguoi_dung_id
        LEFT JOIN goi_tap gt ON dk.goi_tap_id = gt.id
        WHERE nd.tai_khoan = ?
        LIMIT 1
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
    <style>
        body {
            background: #000;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .nguoidung {
            width: 50%;
            margin: 40px auto;
            padding: 30px;
            background: #3a3a3a;
            border-radius: 12px;
        }
        .nguoidung h2 {
            text-align: center;
            font-size: 28px;
            color: #fff;
            margin-bottom: 25px;
        }
        .box {
            margin-bottom: 18px;
        }
        .box p {
            margin: 0 0 6px 0;
            font-size: 15px;
            color: #fff;
        }
        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 95%;
            padding: 11px 12px;
            border: 1px solid #666;
            border-radius: 6px;
            font-size: 15px;
            background: #4a4a4a;
            color: #fff;
        }
        .submit-btn {
            display: block;
            text-align: center;
            padding: 12px;
            background: #e60000;
            color: white;
            font-size: 16px;
            border-radius: 6px;
            text-decoration: none;
        }
        .submit-btn:hover {
            background: #c80000;
        }
        .note {
            color: #fff;
            font-style: italic;
        }
    </style>
</head>
<body>

<div class="nguoidung">
    <h2>Thông tin người dùng</h2>

<?php if ($row): ?>

    <div class="box">
        <p>Tài khoản</p>
        <input type="text" value="<?= htmlspecialchars($row['tai_khoan']); ?>" readonly>
    </div>

    <div class="box">
        <p>Họ và tên</p>
        <input type="text" value="<?= htmlspecialchars($row['ho_ten']); ?>" readonly>
    </div>

    <div class="box">
        <p>Số điện thoại</p>
        <input type="text" value="<?= htmlspecialchars($row['sdt']); ?>" readonly>
    </div>

    <div class="box">
        <p>Email</p>
        <input type="text" value="<?= htmlspecialchars($row['email']); ?>" readonly>
    </div>

    <div class="box">
        <p>Địa chỉ</p>
        <input type="text" value="<?= htmlspecialchars($row['dia_chi']); ?>" readonly>
    </div>

    <div class="box">
        <p>Ngày sinh</p>
        <input type="date" value="<?= $row['ngay_sinh']; ?>" readonly>
    </div>

    <div class="box">
        <p>Giới tính</p>
        <input type="text" value="<?= htmlspecialchars($row['gioi_tinh']); ?>" readonly>
    </div>

    <div class="box">
        <p>Gói tập</p>
        <input type="text" value="<?= $row['ten_goi'] ?? 'Chưa đăng ký'; ?>" readonly>
    </div>

    <div class="box">
        <p>Số ngày dùng</p>
        <input type="text" value="<?= $row['so_ngay_dung'] ?? '0'; ?>" readonly>
    </div>

    <div class="box">
        <a class="submit-btn" href="index.php?page_layout=capnhatthongtinnguoidung&id=<?= $row['id']; ?>">
            Sửa thông tin
        </a>
    </div>

<?php else: ?>
    <p class="note">Không tìm thấy thông tin người dùng</p>
<?php endif; ?>

</div>

</body>
</html>
