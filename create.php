<?php
//$servername = "localhost";
//$username = "username";
//$password = "password";
//$dbname = "myDB";
//
//// Create connection
//$conn = new mysqli($servername, $username, $password, $dbname);
//// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
//
//$sql = "INSERT INTO track (title, artist, track_path, track_img)
//VALUES ('Lemon Tree', 'Doe', './tracks/song3.mp3','./')";
//
//if ($conn->query($sql) === TRUE) {
//    echo "New record created successfully";
//} else {
//    echo "Error: " . $sql . "<br>" . $conn->error;
//}
//
//$conn->close();
//?>
<!---->
<!---->


<?php
//// Include file config.php
//require_once "config.php";
//
//// Xác định các biến và khởi tạo các giá trị trống
//$name = $address = $salary = "";
//$name_err = $address_err = $salary_err = "";
//
//// Xử lý dữ liệu biểu mẫu khi biểu mẫu được gửi
//if($_SERVER["REQUEST_METHOD"] == "POST"){
//    // Xác thực tên
//    $input_name = trim($_POST["name"]);
//    if(empty($input_name)){
//        $name_err = "Please enter a name.";
//    } elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
//        $name_err = "Please enter a valid name.";
//    } else{
//        $name = $input_name;
//    }
//
//    // Xác thực địa chỉ
//    $input_address = trim($_POST["address"]);
//    if(empty($input_address)){
//        $address_err = "Please enter an address.";
//    } else{
//        $address = $input_address;
//    }
//
//    // Xác thực lương
//    $input_salary = trim($_POST["salary"]);
//    if(empty($input_salary)){
//        $salary_err = "Please enter the salary amount.";
//    } elseif(!ctype_digit($input_salary)){
//        $salary_err = "Please enter a positive integer value.";
//    } else{
//        $salary = $input_salary;
//    }
//
//    // Kiểm tra lỗi đầu vào trước khi chèn vào cơ sở dữ liệu
//    if(empty($name_err) && empty($address_err) && empty($salary_err)){
//        // Chuẩn bị một câu lệnh insert
//        $sql = "INSERT INTO employees (name, address, salary) VALUES (?, ?, ?)";
//
//        if($stmt = mysqli_prepare($link, $sql)){
//            // Liên kết các biến với câu lệnh đã chuẩn bị
//            mysqli_stmt_bind_param($stmt, "sss", $param_name, $param_address, $param_salary);
//
//            // Thiết lập tham số
//            $param_name = $name;
//            $param_address = $address;
//            $param_salary = $salary;
//
//            // Cố gắng thực thi câu lệnh đã chuẩn bị
//            if(mysqli_stmt_execute($stmt)){
//                // Tạo bản ghi thành công. Chuyển hướng đến trang đích
//                header("location: index.php");
//                exit();
//            } else{
//                echo "Oh, no. Có gì đó sai sai. Vui lòng thử lại.";
//            }
//        }
//
//        // Đóng câu lệnh
//        mysqli_stmt_close($stmt);
//    }
//
//    // Đóng kết nối
//    mysqli_close($link);
//}
//?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>

<div class="wrapper form_box">

    <form action="" method="post" enctype="multipart/form-data">

        <table>

            <tr>
                <td colspan="7">
                    <h2>Add Song</h2>
                    <div class="border_bottom"></div>
                </td>
            </tr>

            <tr>
                <td><b>Song ID:</b></td>
                <td><input type="text" name="song_id" size="60" required/></td>
            </tr>

            <tr>
                <td><b>Song Title:</b></td>
                <td><input type="text" name="song_name" size="60" required/></td>
            </tr>

            <tr>
                <td><b>Song Image: </b></td>
                <td><input type="file" name="song_image" /></td>
            </tr>

            <tr>
                <td><b>Song File: </b></td>
                <td><input type="file" name="song_file" /></td>
            </tr>

            <tr>
                <td valign="top"><b>Lyrics:</b></td>
                <td><textarea name="song_desc"  rows="10"></textarea></td>
            </tr>


            <tr>
                <td><b>Product Keywords: </b></td>
                <td><input type="text" name="keyword" required/></td>
            </tr>

            <tr>
                <td></td>
                <td colspan="7"><input type="submit" name="insert_post" value="Add Song"/></td>
            </tr>
        </table>

    </form>

</div>

<?php
require_once "temp_config.php";

$song_id = "";
$song_title = "";
$song_desc = "";
$song_image = "";
$song_file = "";
$keyword = "";


//Lấy giá trị POST từ form vừa submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["song_id"])) { $song_id = $_POST['song_id']; }
    if(isset($_POST["song_name"])) { $song_title = $_POST['song_name']; }
    if(isset($_POST["song_desc"])) { $song_desc = $_POST['song_desc']; }
    if(isset($_POST["song_image"])) { $song_image = $_POST['song_image']; }
    if(isset($_POST["song_file"])) { $song_file = $_POST['song_file']; }
    if(isset($_POST["keyword"])) { $keyword = $_POST['keyword']; }
    //Code xử lý, insert dữ liệu vào table
    $sql = " insert into song (song_id,song_name,song_desc,song_image,song_file,keyword) 
            values ('$song_id','$song_title','$song_desc','$song_image','$song_file','$keyword') ";

    if ($link->query($sql) == TRUE) {
        echo "<script>alert('Song Has Been Added Successfully!')</script>";
    } else {
        echo "<script>alert(Error')</script>: " . $sql . "<br>" . $link->error;
    }
}


//if(isset($_POST['insert_post'])){
//    $song_title = $_POST['song_name'];
//    $genre_name = $_POST['genre_name'];
//    $song_image = $_POST['song_image'];
//    $song_file = $_POST['song_file'];
//    $song_desc = trim(mysqli_real_escape_string($link,$_POST['song_desc']));
//    $keyword = $_POST['keyword'];
//
//
//    // Getting the image from the field
//    $song_image  = $_FILES['song_image']['name'];
//    $song_image_tmp = $_FILES['song_image']['tmp_name'];
//    $song_file = $_FILES['song_file']['file'];
//    $song_file_tmp = $_FILES['song_file_tmp']['tmp_file'];
//
//    move_uploaded_file($song_image_tmp,"images/$song_image");
//    move_uploaded_file($song_file_tmp, "sounds/$song_file");
//
//    $add_song = " insert into song (song_name,song_desc,song_image,song_file,keyword)
//   values ('$song_title','$song_desc','$song_image','$song_file','$keyword') ";
//
//    $insert_song = mysqli_query($link, $add_song);
//
//    if($insert_song){
//        echo "<script>alert('New song has been added!')</script>";
//
//        //echo "<script>window.open('index.php?insert_product','_self')</script>";
//    }
//
//}
?>


<div class="table-responsive">
    <table class="table track-table">
        <thead>
        <tr>
            <th class="track-heading"><span>TRACK</span></th>
            <th class="track-artist"><span>ARTIST</span></th>
            <th class="track-time">&nbsp;<i class="fa fa-clock-o"
                                            style="color: rgba(33,37,41,0.6);"></i></th>
            <th class="track-action"><i class="fa fa-cart-plus"
                                        style="color: rgba(33,37,41,0.6);"></i></th>
        </tr>
        </thead>
        <tbody>


        <!-- Insert PHP code here to replace row based on data from db -->

        <?php
        // Include file config.php
        require_once "temp_config.php";

        // Cố gắng thực thi truy vấn
        $sql = "SELECT * FROM song";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {


                while ($row = mysqli_fetch_array($result)) {

                    echo $row['song_image'];
                    echo "<tr>";
                    echo "<td>
                                                <div class='d-flex align-items-center'>
                                                    <div style='width: 30px;height: 30px;margin-right: 20px;'>
                                                        <img class='image-cd' src='imgs/'". $row['song_image'] .">
                                                    </div>
                                                    <span>". $row['song_name'] ."</span>
                                                </div>
                                                <div><audio controls><source src='tracks/'". $row['song_file']."></audio></div>
                                              </td>";
                    echo "<td>" . $row['keyword'] . "</td>";
                    echo "<td><div><span>3:00</span></div></td>";
                    echo "<td><div><input type='checkbox'></div></td>";
                    echo "</tr>";


                }
                // Giải phóng bộ nhớ
                mysqli_free_result($result);
            } else {
                echo "<p class='lead'><em>Không tìm thấy bản ghi.</em></p>";
            }
        } else {
            echo "ERROR: Không thể thực thi $sql. " . mysqli_error($link);
        }

        // Đóng kết nối
        mysqli_close($link);
        ?>

        </tbody>
    </table>
</div>

<!--<div class="wrapper">-->
<!--    <div class="container-fluid">-->
<!--        <div class="row">-->
<!--            <div class="col-md-12">-->
<!--                <div class="page-header">-->
<!--                    <h2>Create Record</h2>-->
<!--                </div>-->
<!--                <p>Please fill this form and submit to add employee record to the database.</p>-->
<!--                <form action="--><?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?><!--" method="post">-->
<!--                    <div class="form-group --><?php //echo (!empty($name_err)) ? 'has-error' : ''; ?><!--">-->
<!--                        <label>Name</label>-->
<!--                        <input type="text" name="name" class="form-control" value="--><?php //echo $name; ?><!--">-->
<!--                        <span class="help-block">--><?php //echo $name_err;?><!--</span>-->
<!--                    </div>-->
<!--                    <div class="form-group --><?php //echo (!empty($address_err)) ? 'has-error' : ''; ?><!--">-->
<!--                        <label>Address</label>-->
<!--                        <textarea name="address" class="form-control">--><?php //echo $address; ?><!--</textarea>-->
<!--                        <span class="help-block">--><?php //echo $address_err;?><!--</span>-->
<!--                    </div>-->
<!--                    <div class="form-group --><?php //echo (!empty($salary_err)) ? 'has-error' : ''; ?><!--">-->
<!--                        <label>Salary</label>-->
<!--                        <input type="text" name="salary" class="form-control" value="--><?php //echo $salary; ?><!--">-->
<!--                        <span class="help-block">--><?php //echo $salary_err;?><!--</span>-->
<!--                    </div>-->
<!--                    <input type="submit" class="btn btn-primary" value="Submit">-->
<!--                    <a href="index.php" class="btn btn-default">Cancel</a>-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
</body>
</html>