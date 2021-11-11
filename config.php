<?php
/* Thông tin CSDL. Giả sử bạn đang chạy MySQL Server với thiết lập mặc định (user 'root' và không có mật khẩu) */
define('DB_SERVER', '127.0.0.1');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', '@Tungta2001');
define('DB_NAME', 'TuneSource');

/* Cố gắng kết nối với cơ sở dữ liệu MySQL */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Kiểm tra kết nối
if($link === false){
    die("ERROR: Can't connect. " . mysqli_connect_error());
}
?>