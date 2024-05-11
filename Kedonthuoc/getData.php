<?php
header('Content-Type: application/json');
// Kết nối CSDL
include 'connect_db.php';

// Lấy giá trị từ ô input1
$tenThuoc = mysqli_real_escape_string($data, $_GET['tenThuoc']);

// Thực hiện truy vấn để lấy thông tin từ cơ sở dữ liệu
$query = "SELECT benhdieutri FROM `thuoc` WHERE tenthuoc = '$tenThuoc'";
$result = mysqli_query($data, $query);

// Kiểm tra xem có kết quả trả về hay không
if ($result) {
    $row = mysqli_fetch_assoc($result);
    $benhdieutri = $row['benhdieutri'];
    echo json_encode(['success' => true, 'benhdieutri' => $benhdieutri]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_error($data)]);
}
// Đóng kết nối CSDL
mysqli_close($data);
?>
