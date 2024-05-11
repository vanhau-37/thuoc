<?php
include 'connect_db.php';

if (isset($_GET['tenThuoc'])) {
    $tenThuoc = mysqli_real_escape_string($data, $_GET['tenThuoc']);

    $result = mysqli_query($data, "SELECT tenthuoc FROM thuoc WHERE tenthuoc LIKE '$tenThuoc%' LIMIT 10");

    $suggestions = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $suggestions[] = $row['tenthuoc'];
    }

    echo json_encode($suggestions);
}
?>


