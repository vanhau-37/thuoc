<?php
include 'connect_db.php';
require_once ('style.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
  
</head>
<body>
    <?php
        if(isset($_GET['action'])) {
            // Lấy giá trị từ biến $_GET['action']
            $orderID = $_GET['action'];
        }

        $sql = "SELECT kedonthuoc.*, benhnhan.* 
        FROM kedonthuoc 
        INNER JOIN benhnhan ON kedonthuoc.BHYT = benhnhan.BHYT 
        WHERE kedonthuoc.iddonthuoc = $orderID";

        // Thực hiện câu truy vấn
        $result = mysqli_query($data, $sql);

        // Kiểm tra và xử lý kết quả
        if ($result) {
            // Lấy dòng dữ liệu từ kết quả
            $row = mysqli_fetch_assoc($result);

            // Kiểm tra xem có dữ liệu hay không
            if ($row) {

               
            // var_dump($orderID);exit;

    ?>
            <div class="container">
                <div class="header" >
                    <h1 class="fas fa-pills">Chi tiết trang thuốc</h1> 
                    <button><a href="./index.php">Trang chủ</a></button>
                </div>
            <div class="border">
        <?php
        // In thông tin ra HTML
            echo '<div class="chitiet-left">';
            echo '<a>Mã đơn thuốc: ' . $row['iddonthuoc'] . '</a>';
            echo '<a>BHYT: ' . $row['BHYT'] . '</a>';
            echo '</div>';

            echo '<div class="chitiet-right">';
            echo '<a>Tên bệnh nhân: ' . $row['tenbn'] . '</a>';
            echo '<a>Giới tính: ' . $row['gioitinh'] . '</a>';
            echo '</div>';
    
            }

           

        }?> 
        <?php
           $sql = "SELECT tn.benhdieutri, ct.tenthuoc, ct.lieudon, ct.tansuat, ct.ngaydieutri
           FROM chitietdonthuoc ct
           JOIN thuoc tn ON ct.tenthuoc = tn.tenthuoc
           WHERE ct.iddonthuoc = $orderID";
            

            // Thực hiện câu truy vấn
            $result = mysqli_query($data, $sql);
           
                
            
            
        ?>
            <div class="bang">
                <table>
                <tr>
                    <th>Triệu chứng bệnh</th>
                    <th>Tên thuốc</th>
                    <th>Liều đơn</th>
                    <th>Tần suất(ngày)</th>
                    <th>Thời gian điều trị(ngày)</th>
                </tr>
        <?php if ($result) {
                
                    // Lặp qua kết quả và in ra từng dòng dữ liệu
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>';
                        echo '<td>' . $row['benhdieutri'] . '</td>';
                        echo '<td>' . $row['tenthuoc'] . '</td>';
                        echo '<td>' . $row['lieudon'] . '</td>';
                        echo '<td>' . $row['tansuat'] . '</td>';
                        echo '<td>' . $row['ngaydieutri'] . '</td>'; 
                        echo '</tr>';
                    }?>
               
                </table>

            </div>
        <?php   }?>
            <div class="btn">
                <button><a href="./index.php">Xác nhận</a></button>
            </div>
            </div>
        </div>


    </div>


</body>
</html>