<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>TuneSource</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/fonts/fontawesome5-overrides.min.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/Navigation-with-Search.css">
    <link rel="stylesheet" href="assets/css/overwrite-bootstrap.css">
    <link rel="stylesheet" href="assets/css/player.css">
    <link rel="stylesheet" href="assets/css/Responsive-Card.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/tracks-table.css">
    <style>
        .wrapper{
            width: 600px;
            margin: -20px auto 40px auto;
        }
        #submit-btn {
            padding-left: 85%;
        }
        body {
            padding: 100px;
        }
    </style>
</head>

<body>

<div class="logo" style="margin-bottom: 10px;"><a class="logo" href="#"
                                                  style="text-decoration: none;font-size: 2em;color: #333333;">TuneSource</a>
    <a style="margin-left: 10px" href="index.php"><-- Back to Homepage</a>
</div>

<div class="wrapper form_box">

    <form action="" method="post" enctype="multipart/form-data">

        <table>

            <tr>
                <td colspan="7">
                    <h2 style="font-size: 36px; text-align: center; margin-bottom: 30px">Add Song</h2>
                    <div class="border_bottom"></div>
                </td>
            </tr>

            <tr>
                <td><b>Song Title:</b></td>
                <td><input type="text" name="song_name" size="60" required/></td>
            </tr>

            <tr>
                <td><b>Artist:</b></td>
                <td><input type="text" name="song_artist" size="60" required/></td>
            </tr>

            <tr>
                <td><b>Price:</b></td>
                <td><input type="text" name="song_price" size="60" required/></td>
            </tr>

            <tr>
                <td><b>Song Image: </b></td>
                <td><input type="file" name="song_image" /></td>
            </tr>

            <tr>
                <td><b>Song File: </b></td>
                <td><input type="file" name="song_audio" /></td>
            </tr>

            <tr>
                <td id="submit-btn" colspan="7"><input type="submit" name="insert_track" value="Add Track"/></td>
            </tr>

        </table>

    </form>
<!--    <button class="btn btn-primary" type="submit" name="insert_track" value="Add Track"></button>-->
</div>

<?php
require_once "config.php";

$song_title = "";
$song_artist = "";
$song_price = "";
$song_image = "";
$song_audio = "";

//Get POST value from FORM

//if ($_SERVER["REQUEST_METHOD"] == "POST") {
//    if(isset($_POST["song_name"])) { $song_title = $_POST['song_name']; }
//    if(isset($_POST["song_artist"])) { $song_artist = $_POST['song_artist']; }
//    if(isset($_POST["song_image"])) { $song_image = $_POST['song_image']; }
//    if(isset($_POST["song_audio"])) { $song_audio = $_POST['song_audio']; }

if (isset($_POST['insert_track'])) {
        $song_title = $_POST['song_name'];
        $song_artist = $_POST['song_artist'];
        $song_price = $_POST['song_price'];
        $song_image = $_FILES['song_image']['name'];
        $song_image_tmp = $_FILES['song_image']['tmp_name'];
        move_uploaded_file($song_image_tmp, "uploads/images/$song_image");
        $song_audio = $_FILES['song_audio']['name'];
        $song_audio_tmp = $_FILES['song_audio']['tmp_name'];
        move_uploaded_file($song_audio_tmp, "uploads/tracks/$song_audio");


    //Insert data to db

    $sql = "INSERT INTO track (title, artist, price, track_path, track_img)
            VALUES ('$song_title', '$song_artist', '$song_price', '$song_audio', '$song_image')";

    if ($link->query($sql) == TRUE) {
        echo "<script>alert('Song Has Been Added Successfully!')</script>";
    } else {
        echo "<script>alert(Error: )</script>: " . $sql . "<br>" . $link->error;
    }

}
?>


<div class="table-responsive">
    <table class="table track-table">
        <thead>
        <tr>
            <th class="track-heading"><span>TRACK</span></th>
            <th class="track-artist"><span>ARTIST</span></th>
            <th class="track-time"><span>PRICE</span></th>
        </tr>
        </thead>
        <tbody>

        <?php
        require_once "config.php";

        // Run query
        $sql = "SELECT * FROM track";
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_array($result)) {

                    echo "<tr>";
                    echo "<td>
                            <div class='d-flex align-items-center'>
                                <div style='width: 30px;height: 30px;margin-right: 20px;'>
                                    <img class='image-cd' src='./uploads/images/". $row['track_img'] ."'>
                                </div>
                                <span>". $row['title'] ."</span>
                            </div>
                            <div><audio controls><source src='./uploads/tracks/". $row['track_path']."'></audio></div>
                           </td>";
                    echo "<td>" . $row['artist'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "</tr>";

                }
                // free result
                mysqli_free_result($result);
            } else {
                echo "<p class='lead'><em>Something wrong!</em></p>";
            }
        } else {
            echo "ERROR: $sql. " . mysqli_error($link);
        }

        mysqli_close($link);
        ?>

        </tbody>
    </table>
</div>

</body>
</html>