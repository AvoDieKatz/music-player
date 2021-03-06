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
</head>

<body>
<div style="padding-bottom: 80px;padding-top: 56px;">
    <div class="topbar">
        <div class="topbar-search">
            <div class="search-wrapper">
                <form class="d-flex align-items-center">
                    <button class="btn btn-primary topbar-search-submit"
                            type="submit" style="background: rgba(13,110,253,0);border: none;"><i
                                class="fa fa-search"></i></button>
                    <input class="form-control topbar-search-input"
                           type="search" placeholder="Search">
                    <button class="btn btn-primary topbar-search-clear"
                            type="button" style="background: rgba(13,110,253,0);"><i class="fa fa-close"></i></button>
                </form>
            </div>
        </div>
        <div class="topbar-account">
            <a href="admin.php">
            <button class="btn btn-primary topbar-profile" type="button"
                    style="background: rgba(13,110,253,0);border: none;"><i class="fa fa-user-circle"></i></button></a>
        </div>
    </div>
    <div class="sidebar">
        <div class="logo" style="margin-bottom: 10px;"><a class="logo" href="#"
                                                          style="text-decoration: none;font-size: 2em;color: #333333;">TuneSource</a>
        </div>
        <div class="sidebar-banner" style="margin: 0 23px 50px;">
            <h4>We sell old, rare, hard-to-find music in classic CD form and now, in digital form</h4>
        </div>
        <div class="sidebar-content">
            <ul class="sidebar-list">
                <li><i class="fas fa-music"></i><a class="sidebar__main-link" href="#">Music</a></li>
                <li><i class="far fa-list-alt"></i><a class="sidebar__main-link" href="#">Categories</a></li>
                <li><i class="far fa-heart"></i><a class="sidebar__main-link" href="#">Your lists</a>
                    <ul class="sidebar-sublist">
                        <li><a href="#">Liked</a></li>
                        <li><a href="#">Purchased</a></li>
                        <li><a href="#"></a></li>
                        <li><a href="#">Playlists</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <main class="page-main">
        <div class="page-wrapper">
            <div class="page-content">
                <div class="page-section">
                    <section class="section">
                        <div class="section-wrapper">
                            <div class="section-name">
                                <h1>Trendings</h1>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="card"><img class="card-img w-100 d-block"
                                                           src="assets/img/frank.jpeg">
                                        <div class="card-img-overlay"><span style="color: #ffffff;">50s'</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card"><img class="card-img w-100 d-block"
                                                           src="assets/img/disc.jpeg">
                                        <div class="card-img-overlay"><span style="color: #ffffff;">CLASSIC</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card"><img class="card-img w-100 d-block"
                                                           src="assets/img/orchestra.jpeg">
                                        <div class="card-img-overlay"><span style="color: #ffffff;">ORCHESTRA</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card"><img class="card-img w-100 d-block"
                                                           src="assets/img/reagae.jpeg">
                                        <div class="card-img-overlay"><span style="color: #ffffff;">REGGAE</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


                    <div class="table-responsive">
                        <table class="table track-table">
                            <thead>
                            <tr>
                                <th class="track-heading"><span>TRACK</span></th>
                                <th class="track-song"></th>
                                <th class="track-artist"><span>ARTIST</span></th>
<!--                                <th class="track-time">&nbsp;<i class="fa fa-clock-o"-->
<!--                                                                style="color: rgba(33,37,41,0.6);"></i></th>-->

                                <th class="track-action"><i class="fa fa-cart-plus"
                                                            style="color: rgba(33,37,41,0.6);"></i></th>
                            </tr>
                            </thead>
                            <tbody>


                            <!-- Insert PHP code here to replace row based on data from db -->

                            <?php
                            require_once "config.php";

                            $sql = "SELECT * FROM track";
                            if ($result = mysqli_query($link, $sql)) {
                                if (mysqli_num_rows($result) > 0) {

                                    while ($row = mysqli_fetch_array($result)) {

                                        echo "<tr>";
                                        echo "<td>
                                                <div class='d-flex align-items-center track-heading-row'>
                                                    <div class='image-container'>
                                                        <img class='image-cd' src='./uploads/images/". $row['track_img'] ."'>
                                                    </div>
                                                    <div class='track-title'>
                                                        <span>". $row['title'] ."</span>
                                                    </div>
                                                    
                                                </div>
                                              </td>";
                                        echo "<td>
                                                   <audio controls ontimeupdate='restrictAudio(this)'><source src='./uploads/tracks/". $row['track_path']."'></audio>
                                               </td>";
                                        echo "<td>" . $row['artist'] . "</td>";
//                                        echo "<td><div class='d-flex align-items-center'><span>3:00</span></div></td>";
//                                        echo "<td><div class='d-flex align-items-center'><input type='checkbox'></div></td>";
                                        echo "<td><div class='d-flex align-items-center'>
                                                    <form action='cart.php' method='POST'>
                                                        <input type='hidden' value='".$row['id']."' name='track_id'/>
                                                        <input name='quantity' type='hidden' min='1' max='10' value='1' />
                                                        <input type='submit' value='Buy' name='addcart'/>
                                                        <input type='hidden' value='".$row['title']."' name='track_title'/>
                                                        <input type='hidden' value='".$row['price']."' name='track_price'/>
                                                        <input type='hidden' value='./uploads/images/".$row['track_img']."' name='track_img'/>
                                                        <input type='hidden' value='".$row['artist']."' name='track_artist'/>
                                                    </form>
                                                </div></td>";
                                        echo "</tr>";

                                    }
                                    // Free result
                                    mysqli_free_result($result);
                                } else {
                                    echo "<p class='lead'><em>No tracks found</em></p>";
                                }
                            } else {
                                echo "ERROR: Kh??ng th??? th???c thi $sql. " . mysqli_error($link);
                            }

                            mysqli_close($link);
                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div class="page-player">
        <div class="d-flex justify-content-center align-items-center page-player-bottom" id="music-player">
            <div>
                <ul class="list-inline d-flex align-items-center" style="margin-bottom: 0;">
                    <li class="list-inline-item">
                        <div class="control-button-wrapper">
                            <button id="prev" class="btn btn-primary" type="button"><i
                                        class="fa fa-step-backward"></i></button>
                        </div>
                    </li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item">
                        <div class="control-button-wrapper">
                            <button id="play" class="btn btn-primary" type="button"><i
                                        class="fa fa-play"></i></button>
                        </div>
                    </li>
                    <li class="list-inline-item"></li>
                    <li class="list-inline-item">
                        <div class="control-button-wrapper">
                            <button id="next" class="btn btn-primary" type="button"><i
                                        class="fa fa-step-forward"></i></button>
                        </div>
                    </li>
                </ul>
            </div>
            <audio src="" id="audio"></audio>
            <div class="player-track">
                <div class="track-container">
                    <div class="d-flex justify-content-center">
                        <div class="track-title"><span id="title" style="font-size: 20px;font-weight: 400;">Hello World</span>
                        </div>
                    </div>
                    <div class="track-seekbar">
                        <div class="slider">
                            <div class="slider-counter slider-counter-current" style="padding-right: 20px;">
                                <span>00:00</span></div>
                            <div class="slider-track">
                                <div class="slider-track-default"></div>
                            </div>
                            <div class="slider-counter slider-counter-max" style="padding-left: 20px;">
                                <span>00:00</span></div>
                        </div>
                    </div>

                </div>
            </div>
            <div>
                <div><i class="fas fa-volume-up" style="margin-right: 12px;"></i><i class="fa fa-heart-o"
                                                                                    style="margin-right: 12px;"></i><i
                            class="fas fa-cart-plus"></i></div>
            </div>
        </div>
    </div>
</div>
<script src="script.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script>
    function restrictAudio(event) {
        // Trying to stop the player if it goes above 10 second
        if (event.currentTime > 15) {
            alert("You need to purchase this song to listen fully.")
            event.pause();
            event.currentTime = 13;
        }
    }
</script>
</body>

</html>