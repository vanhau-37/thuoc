<?php session_start(); ?>
<?php
include 'connect_db.php';
include 'style.php';
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <title>Kiểm tra liều dùng</title>
    </head>
    <body>
    <div class="container">
        <div class="header" >
                        <h1 class="fas fa-pills">Thuốc điều trị </h1> 
                        <button><a href="./index.php">Trang chủ</a></button>
        </div>
    </div>