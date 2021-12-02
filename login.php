<?php
// session_start();
// if (isset($_SESSION['id'])){
//      header("location:admin.php");
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .box-content{
            margin: 0 auto;
            width: 800px;
            border: 1px solid #ccc;
            text-align: center;
            padding: 20px;
        }
        #user_login form{
            width: 200px;
            margin: 40px auto;
        }
        #user_login form input{
            margin: 5px 0;
        }
    </style>
    <title>Login Page</title>
</head>
<body>
<div id="user_login" class="box-content">
    <h1>Imformation Login</h1>
    <form action="" method="Post" >
        <label>Username</label></br>
        <input type="text" name="username" placeholder="username" /><br/>
        <label>Password</label></br>
        <input type="password" name="password" placeholder="password" /></br>
        <br>
        <input type="submit" name="submit" value="Đăng nhập" />
    </form>
</div>
<?php
include 'config.php';
$sql = "SELECT * FROM `admin`";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result);
$_SESSION['id'] = $row['id'];
if (isset($_POST['submit'])) {
    if(
        $row['userName'] == $_POST['username']  && $row['password'] == $_POST['password']
    ){
        header("location:admin.php");
    }else{
        echo "Information login incorrect , Please try again !";
    }
}

?>
</body>
</html>