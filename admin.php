<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style>
        .wrapper{
            margin: 0 auto;
            padding: 20px 100px;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
<!--    <script type="text/javascript">-->
<!--        $(document).ready(function(){-->
<!--            $('[data-toggle="tooltip"]').tooltip();-->
<!--        });-->
<!--    </script>-->
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="logo" style="margin-bottom: 10px;"><a class="logo" href="#"
                                                                  style="text-decoration: none;font-size: 2em;color: #333333;">TuneSource</a>
                    <a style="margin-left: 10px" href="index.php"><-- Back to Homepage</a>
                </div>
                <div class="page-header clearfix">
                    <h2 class="pull-left">Tracks Management</h2>
                    <a href="create.php" class="btn btn-success pull-right">Add New Track</a>
                </div>
                <?php
                require_once "config.php";

                $sql = "SELECT * FROM track";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>ID</th>";
                        echo "<th>Title</th>";
                        echo "<th>Artist</th>";
                        echo "<th>Sound</th>";
                        echo "<th>Image</th>";
                        echo "<th>Actions</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<td>" . $row['id'] . "</td>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['artist'] . "</td>";
                            echo "<td>" . $row['track_path'] . "</td>";
                            echo "<td>" . $row['track_img'] . "</td>";
                            echo "<td>";
                            echo "<a href='read.php?id=". $row['id'] ."' title='View Record' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                            echo "<a href='update.php?id=". $row['id'] ."' title='Update Record' disabled data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                            echo "<a href='delete.php?id=". $row['id'] ."' title='Delete Record' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // free
                        mysqli_free_result($result);
                    } else{
                        echo "<p class='lead'><em>No tracks found</em></p>";
                    }
                } else{
                    echo "ERROR: $sql. " . mysqli_error($link);
                }

                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>