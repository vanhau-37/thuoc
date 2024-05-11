<?php session_start(); ?>
<?php
include 'connect_db.php';
include 'style.php';

$s_BHYT =$s_tenbn= $s_gioitinh = $s_tuoi = $s_cannang = $s_ngaykham=$s_idbacsi= '';
$fields = ['BHYT', 'tenbn', 'gioitinh', 'tuoi', 'cannang', 'ngaykham', 'idbacsi'];

if (!empty($_POST)) {
   
    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            ${'s_' . $field} = $_POST[$field];
        }
    }

    //insert
    $checkBHYTQuery = mysqli_query($data, "SELECT COUNT(*) as count FROM benhnhan WHERE BHYT = '$s_BHYT'");
    $checkBHYTResult = mysqli_fetch_assoc($checkBHYTQuery);

    if ($checkBHYTResult['count'] == 0) {

        $insertOrder = mysqli_query($data, "INSERT INTO `benhnhan`(`BHYT`, `tenbn`, `gioitinh`, `tuoi`, `cannang`) 
        VALUES ('$s_BHYT','$s_tenbn','$s_gioitinh','$s_tuoi','$s_cannang');");
    }

    if($s_BHYT>0){
        $insertOrder = mysqli_query($data,"INSERT INTO `kedonthuoc`(`iddonthuoc`, `BHYT`, `idbacsi`, `ngaykham`) 
        VALUES ('null','$s_BHYT','$s_idbacsi','$s_ngaykham');");
        $orderID = $data->insert_id;
    }
  
    if (isset($_SESSION["ct"]) && !empty($_SESSION["ct"])) {
        $insertString = "";
        
        foreach ($_SESSION["ct"] as $tenThuoc => $thongTin) {
            $iddonthuoc ='' . $orderID . '';
            $tansuat = mysqli_real_escape_string($data, $thongTin['tansuat']);
            $lieudon = mysqli_real_escape_string($data, $thongTin['lieudon']);
            $ngaydieutri = mysqli_real_escape_string($data, $thongTin['ngaydieutri']);

            $insertString .= "('$iddonthuoc', '$tenThuoc', '$tansuat', '$lieudon', '$s_ngaykham'),";
        }

        // Remove the trailing comma
        $insertString = rtrim($insertString, ',');
        // var_dump($insertString);exit;
        $insertOrder = mysqli_query($data, "INSERT INTO `chitietdonthuoc` (`iddonthuoc`, `tenthuoc`, `tansuat`, `lieudon`, `ngaydieutri`) VALUES " . $insertString . ";");
        
    }
    unset($_SESSION['ct']);
    header('Location: ./chitietdonthuoc.php');exit;
}    
elseif (isset($_GET['action']) && $_GET['action'] == 'rest'){
    unset($_SESSION['ct']);
}
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
 <div class="container">
    <div class="header" >
       <h1 class="fas fa-pills">Đơn Thuốc</h1> 
       <button><a href="./index.php">Trang chủ</a></button>
    </div>
    <div class="border">
        <form method="POST" >
            <div class="left">
                <span>Tên bệnh nhân : <input type="text" name="tenbn"class="box" value="<?=$s_tenbn?>" ></span>
                <span>Tuổi         : <input type="text" name="tuoi"class="box"  value="<?=$s_tuoi?>"></span>
                <span>Cân nặng :<input type="text" name="cannang"class="box" value="<?=$s_cannang?>" ></span>
                <span>Thuốc điều trị:
                    <?php
                    // Kiểm tra xem mảng $_SESSION["ct"] có tồn tại không
                        if (isset($_SESSION["ct"])) {
                            $tenThuocStr = ''; // Chuỗi để lưu các tên thuốc

                            // Lặp qua mảng để lấy tên thuốc
                            foreach ($_SESSION["ct"] as $tenThuoc => $thongTin) {
                                // Thêm tên thuốc vào chuỗi
                                $tenThuocStr .= '' . $tenThuoc . ', ';
                            }

                            // Loại bỏ dấu ',' cuối cùng
                            $tenThuocStr = rtrim($tenThuocStr, ', ');

                            // Hiển thị chuỗi tên thuốc
                            echo $tenThuocStr;
                        }
                    ?>
                    <a href="thuocdieutri.php"><i class="fa fa-plus-circle"></i></a> 
                </span>

                <span>Ngày khám :<input type="date" name="ngaykham"class="box"  value="<?=$s_ngaykham?>"></span>
            </div>
            <div class="right">
                <span>Giới tính : <input type="text" name="gioitinh"class="box" value="<?=$s_gioitinh?>" ></span>
                <span>Mã BHYT : <input type="text" name="BHYT"class="box" value="<?=$s_BHYT?>" ></span>
                <span>ID bác sĩ :<input type="text" name="idbacsi"class="box" value="<?=$s_idbacsi?>"></span>
            </div>

            <div class="roat" >
                <button>Kê đơn</a></button>
                <button><a href="donthuoc.php?action=rest"> Nhập lại</a></button>
            </div>
        </form>
    </div>


    </div>


</body>
</html>