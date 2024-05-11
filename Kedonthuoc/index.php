<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Document</title>
  
    <?php
    require_once ('function.php');
    require_once ('style.php');
    include 'connect_db.php';
    ?>
</head>
<body>
 <div class="container">
    <div class="header" >
       <h1 class="fas fa-pills">Trang chủ</h1> 
       <button><a href="./donthuoc.php">Kê đơn thuốc</a></button>
    </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Mã BHYT</th>
                        <th>Họ & Tên</th>
                        <th>Giới tính</th>
                        <th>Tuổi</th>
                        <th>Cân nặng</th>
                        <th>Ngày khám</th>
                        <form method="GET">
					    <input type="text" name="s" class="form-control" placeholder="tìm kiếm">
                        </form>
                    </tr>   
                </thead>
                <tbody>
                <?php
if (isset($_GET['s']) && $_GET['s'] != ' '){
	$sql = 'select k.BHYT,tenbn,gioitinh,tuoi,cannang,ngaykham from benhnhan k,kedonthuoc n where k.BHYT=n.BHYT and tenbn like"%'.$_GET['s'].'%"';
}else{
	$sql = 'select k.BHYT,tenbn,gioitinh,tuoi,cannang,ngaykham from benhnhan k,kedonthuoc n where k.BHYT=n.BHYT';
}
$patientList = executeResult($sql);

foreach ($patientList as $std) {
	echo '<tr>
			<th>'.$std['BHYT'].'</th>
			<th>'.$std['tenbn'].'</th>
			<th>'.$std['gioitinh'].'</th>
            <th>'.$std['tuoi'].'</th>
            <th>'.$std['cannang'].'</th>
            <th>'.$std['ngaykham'].'</th>
            <th><button onclick=\'window.open("donthuoc.php?id='.$std['BHYT'].'","_self")\'>chi tiết</button></th>
		</tr>';
}
?> 
					</tbody>
				</table>
            </table>

        </div>


    </div>


</body>
</html>