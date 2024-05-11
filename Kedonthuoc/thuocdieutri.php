<?php include 'header.php';?>
        <?php
            if (isset($_GET['action']) && ($_GET['action'] == 'check')) {
                if (!isset($_SESSION["ct"])) {
                    $_SESSION["ct"] = array();
                }

                if (isset($_POST['namedose']) && !empty($_POST['namedose']) 
                && isset($_POST['lieudon']) && !empty($_POST['lieudon']) 
                && isset($_POST['ngaydieutri']) && !empty($_POST['ngaydieutri']) 
                && isset($_POST['tansuat']) && !empty($_POST['tansuat'])) {
                  
                    $namedose = mysqli_real_escape_string($data, $_POST['namedose']);
                    $thuoc = mysqli_query($data, "SELECT * FROM `thuoc` WHERE `tenthuoc` = '$namedose'");
                    $row=mysqli_fetch_array($thuoc);
                    // var_dump($_SESSION["ct"]);exit;
                    if (intval($row['mindose']) <= intval($_POST['lieudon']) && intval($_POST['lieudon']) <= intval($row['maxdose'] )
                    && intval($_POST['tansuat']) <= intval($row['tansuatdose'] )
                    && intval($_POST['lieudon'])*intval($_POST['tansuat']) >= intval($row['summin']) && intval($_POST['lieudon'])*intval($_POST['tansuat']) <= intval($row['summax'])) {
                        // $result = mysqli_query($data, "INSERT INTO `chitietdonthuoc` (`iddontuoc`, `tenthuoc`, `tansuat`, `lieudon`, `ngaydieutri`) VALUES (NULL, '" . $_POST['namedose'] . "','" . $_POST['tansuat'] . "','" . $_POST['lieudon'] . "', " . time() . ");");

                        foreach ($_POST as $key => $value) {
                            $_SESSION["ct"][$namedose][$key] = $value;
                        }
                        
                                        
                    }
                    else {
                        $error = "Liều lượng không hợp lệ.";
                    }   

                } else {
                    $error = "Bạn chưa nhập thông tin.";
                }?>
                <div class="border"><?= isset($error) ? $error : "Thêm thuốc thành công" ?>
                    <a href = "donthuoc.php">Quay lại kê đơn thuốc</a></div>
        <?php    
            }
            else 
            {
        ?>    

                <div class="container">
                        <div class="border">
                            <form id="form" method="POST" action="?action=check"  enctype="multipart/form-data">
                                <div class="sun-left">
                                <span>Tên thuốc : <input type="text" id="namedose" class="box" name="namedose"></span>
                                    <span>Bệnh điều trị :<span id="benhDieuTri"></span></span>
                                    <span>Liều đơn :<input type="text" name="lieudon"class="box" value=""></span>
                                    <span>Thời gian điều trị:<input type="text" name="ngaydieutri" class="box" value=""></span>
                                </div>
                                <div class="sun-right">
                                    <span> Tần suất : <input type="text" name="tansuat" class="box" value=""></span>
                                    
                                </div>
                                <div class="roat" >
                                    <input type="submit" title="Xác nhận" value="Xác nhận" />
                                </div>
                        </div>
                </div>
    <?php   }?>
        <script>
            
            $(document).ready(function() {
                $("#namedose").on("input", function() {
                    // Lấy giá trị từ ô namedose
                    var tenThuoc = $(this).val();
                    
                    // Thực hiện AJAX để gửi giá trị lên server và nhận kết quả
                    $.ajax({
                        type: "GET",
                        url: "getData.php", // Thay đổi thành tên file PHP xử lý truy vấn
                        data: { tenThuoc: tenThuoc },
                        dataType: "json",
                        success: function(response) {
                            if (response.success) {
                                // Cập nhật giá trị của span bệnhDieuTri với thông tin từ cơ sở dữ liệu
                                $("#benhDieuTri").text(response.benhdieutri);
                                
                            } 
                           
                        },
                        // error: function(xhr, status, error) {
                        //     console.error("Lỗi AJAX: " + error);
                        // }
                    });
                });
            });

            $(document).ready(function() {
            // Sử dụng jQuery UI Autocomplete
                $("#namedose").autocomplete({
                    source: function(request, response) {
                        // Gửi AJAX request để lấy danh sách gợi ý từ server
                        $.ajax({
                            url: "getSuggestions.php",
                            dataType: "json",
                            data: {
                                tenThuoc: request.term
                            },
                            success: function(data) {
                                // Trả về danh sách gợi ý
                                // console.log(data);
                                response(data);
                            }
                        });
                    },
                    minLength: 1,
                    select: function(event, ui) {
                        // Xử lý sự kiện khi chọn một phần tử từ danh sách gợi ý
                        console.log("Selected: " + ui.item.value);
                        // Điền giá trị đã chọn vào ô input
                        $(this).val(ui.item.value);
                        return false; // Ngăn chặn mặc định của sự kiện
                    }
                });
            });



        </script>

    </body>
</html>