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
        .wrapper {
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
<?php
if (isset($_GET['id'])) { ?>
    <?php
    require_once "config.php";

    $sql = "SELECT * FROM `track` WHERE `id` = " . $_GET['id'];
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result);
    ?>
    <div class="logo" style="margin-bottom: 10px;">
        <a class="logo" href="#" style="text-decoration: none;font-size: 2em;color: #333333;">TuneSource</a>
        <a style="margin-left: 10px" href="index.php"><-- Back to Homepage</a>
        <a style="margin-left: 10px" href="admin.php"><-- Back to Adminpage</a>
    </div>
    <div class="wrapper form_box">
        <form action="?action=edit&id=<?= $_GET['id'] ?>" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td colspan="7">
                        <h2 style="font-size: 36px; text-align: center; margin-bottom: 30px">Update Record</h2>
                        <div class="border_bottom"></div>
                    </td>
                </tr>
                <tr>
                    <td><b>Song Title:</b></td>
                    <td><input type="text" name="song_name" size="60" value="<?= $row['title'] ?>" required/></td>
                </tr>
                <tr>
                    <td><b>Artist:</b></td>
                    <td><input type="text" name="song_artist" size="60" value="<?= $row['artist'] ?>" required/></td>
                </tr>
                <tr>
                    <td><b>Price:</b></td>
                    <td><input type="text" name="song_price" size="60" value="<?= $row['price'] ?>" required/></td>
                </tr>
                <tr>
                    <td><b>Song Image:</b></td>
                    <td><input type="file" name="song_img" size="60" value="" required/></td>
                    <input type="hidden" name="song_img" value="<?= $row['track_img'] ?>"/>
                </tr>
                <tr>
                    <td><b>Song file:</b></td>
                    <td><input type="file" name="song_path" size="60" value="" required/></td>
                    <input type="hidden" name="song_path" value="<?= $row['track_path'] ?>"/>
                </tr>
                <tr>
                    <td id="submit-btn" colspan="7"><input type="submit" name="update_track" value="Update Track"/></td>
                </tr>
            </table>
        </form>
    </div>
    <?php if (!empty($_POST['update_track'])) { //Cập nhật lại sản phẩm
        $song_img = $_POST['song_img'];
        $song_path = $_POST['song_path'];
        $result = mysqli_query($link, "UPDATE `track` SET `title` = '" . $_POST['song_name'] . "',`track_path` = '" . $song_path . "',`track_img` = '" . $song_img . "', `price` = " . $_POST['song_price'] . " WHERE `track`.`id` = " . $_GET['id']);
        echo "Update Record Successed";
        echo "<br>
                <a href='admin.php'>Click Here To Back Admin Page</a>";
    }
    ?>

    <div class="table-responsive">
        <table class="table track-table">
            <thead>
            <tr>
                <th class="track-heading"><span>TRACK</span></th>
                <th class="track-artist"><span>ARTIST</span></th>
                <th class="track-time"><span>&nbsp;</span></th>
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
                                        <img class='image-cd' src='./uploads/images/" . $row['track_img'] . "'>
                                    </div>
                                    <span>" . $row['title'] . "</span>
                                </div>
                                <div><audio controls><source src='./uploads/tracks/" . $row['track_path'] . "'></audio></div>
                            </td>";
                        echo "<td>" . $row['artist'] . "</td>";
                        echo "<td><div><span>3:00</span></div></td>";
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
    <?php
} else {
    echo "Can't find your track to update";
}
?>
</body>
</html>