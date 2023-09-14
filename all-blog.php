<?php

session_start();
if(isset($_SESSION['user_id']))
{
    echo "";
}
else
{
    header('location: ../userlogin.php');
}
?>


<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://kit.fontawesome.com/a43ceed218.js" crossorigin="anonymous"></script>

<style>
    body {
        margin-top: 20px;
        background: #e7ebf2;
    }

    /*
Profile
*/
    .si-border-round {
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        -ms-border-radius: 50%;
        border-radius: 50%;
    }

    .social-icon-sm {
        margin: 0 5px 5px 0;
        width: 30px;
        height: 30px;
        font-size: 18px;
        line-height: 30px !important;
        color: #555;
        text-shadow: none;
        border-radius: 3px;
        overflow: hidden;
        display: block;
        float: left;
        text-align: center;
        border: 1px solid #AAA;
    }

    .tabs-admin>.nav-item>.nav-link.active {
        border-color: #0073ff;
        color: #0073ff;
    }

    .tabs-admin>.nav-item>.nav-link {
        padding: 10px 15px;
        color: #555;
        font-weight: 600;
        text-transform: capitalize;
        margin-bottom: -2px;
        border-bottom: 2px solid transparent;
    }

    .act-content span.text-small {
        display: block;
        color: #999;
        margin-bottom: 10px;
        font-size: 12px;
    }

    .text-small {
        font-size: 12px !important;
    }

    .admin-tab-content {
        padding: 10px 15px;
    }

    .pt30 {
        padding-top: 30px !important;
    }

    .card .card-title {
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
        min-height: 28px;
        margin: 0;
        font-size: .9rem;
        font-weight: 600;
        line-height: 28px;
    }

    .mb20 {
        margin-bottom: 20px !important;
    }

    .pb20 {
        padding-bottom: 20px !important;
    }

    .pt20 {
        padding-top: 20px !important;
    }

    .text-small {
        font-size: 12px !important;
    }

    .text-muted {
        color: #999 !important;
    }

    .card .card-content {
        padding: 15px 15px;
    }

    .profile-header {
        background-size: cover;
        position: relative;
        overflow: hidden;
    }

    .profile-header .img-fluid.rounded-circle {
        max-width: 100px;
        margin: 0 auto;
        margin-bottom: 20px;
        display: block;
    }

    .activity-list>li {
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .activity-list .float-left {
        margin-right: 10px;
        width: 40px;
        height: 40px;
        float: left;
        display: block;
        border-radius: 50%;
        background-color: #eee;
        font-size: 20px;
        line-height: 100%;
        line-height: 43px;
        text-align: center;
    }

    .activity-list .float-left a {
        display: inline-block;
        color: #999;
    }

    .act-content {
        overflow: hidden;
    }

    .act-content span.text-small {
        display: block;
        color: #999;
        margin-bottom: 10px;
        font-size: 12px;
    }
</style>

<div class="container">

    <div class="row">

        <div class="col-md-4 mb30">

            <div class="card">
                <a href="blog/blog.php"> <button class="btn btn-primary">Back</button></a>

                <?php


                $con = mysqli_connect("localhost:3307", "root", "", "blog");

                if ($con == false) {
                    echo "Connection not successful";
                }

                $user_id = 3;
                $qry = "SELECT * FROM `user_details` WHERE `id`='$user_id'";
                $result = mysqli_query($con, $qry);

                if ($result) {
                    $user_data = mysqli_fetch_assoc($result);
                } else {
                    // Handle the database query error here
                    die("Database query error: " . mysqli_error($con));
                }

                mysqli_close($con);

                ?>
                <div class="card-content pt20 pb20 profile-header">
                    <img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" class="img-fluid rounded-circle">
                    <h4 class="card-title text-center mb20"><?php echo $user_data['username'] ?></h4>
                    <p class="text-center">
                        <?php echo $user_data['email'] ?>

                    </p>

                    <hr>
                    <div class="row">
                        <div class="col-md-4 mb20">

                            <?php


                            $con = mysqli_connect("localhost:3307", "root", "", "blog");

                            if ($con == false) {
                                echo "Connection not successful";
                            }

                            $user_id = 6;
                            $qry = "SELECT * FROM `posts` WHERE `user_id`='$user_id'";
                            $result = mysqli_query($con, $qry);

                            if ($result) {
                                $user_data = mysqli_fetch_assoc($result);
                                $count = mysqli_num_rows($result);
                            } else {
                                // Handle the database query error here
                                $count = 0;
                            }

                            mysqli_close($con);

                            ?>
                            <h5><?php echo $count; ?></h5>
                            <h6 class="text-small text-muted">Posts</h6>
                        </div>
                        <div class="col-md-4 mb20">
                            <h5>0</h5>
                            <h6 class="text-small text-muted">Likes</h6>
                        </div>
                        <div class="col-md-4 mb20">
                            <h5>0</h5>
                            <h6 class="text-small text-muted">Comments</h6>
                        </div>
                    </div>
                    <a href="#" class="btn btn-primary btn-rounded">Follow</a>
                    <hr>



                </div>
                <!--content-->

            </div>
        </div>
        <div class="col-md-8 mb30">
            <div class="card">
                <div>

                    <!-- Nav tabs -->
                    <ul class="nav tabs-admin" role="tablist">
                        <li role="presentation" class="nav-item"><a class="nav-link active" href="#t1" aria-controls="t1" role="tab" data-toggle="tab">Activities</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content admin-tab-content pt30">
                        <div role="tabpanel" class="tab-pane active show" id="t1">
                            <ul class="activity-list list-unstyled">

                                <?php


                                $con = mysqli_connect("localhost:3307", "root", "", "blog");

                                if ($con == false) {
                                    echo "Connection not successful";
                                }

                                $userid=$_SESSION['user_id'];
                                $qry = "SELECT * FROM `posts` ORDER BY `created_at` DESC";

                                $result = mysqli_query($con, $qry);

                                if ($result) {
                                    while ($data = mysqli_fetch_assoc($result)) {
                                        
                                      
                                        
                                        
                                        $count++;
                                ?>
                                        <li class="clearfix">
                                            <div class="float-left">
                                                <a href="#"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="" class="img-fluid rounded-circle"></a>
                                            </div>
                                            <div class="act-content">

                                                <div class="font400">
                                                <?php
                                                $user_id=$data['user_id'];
                                                $profile = "SELECT username FROM `user_details` WHERE `id`='$user_id'";
                                                $profile1 = mysqli_query($con, $profile);
                                                $profile2 = mysqli_fetch_assoc($profile1);
                                                ?>
                                                    sent by <a href="#" class="font600"><?php echo $profile2['username']; ?></a>
                                                </div>
                                                <span class="text-small"><?php echo $data['created_at']; ?></span>
                                                <h3><?php echo $data['title']; ?></h3>
                                                <p>
                                                    <?php echo $data['content']; ?>
                                                </p>
                                                <p>
                                                    <?php echo $data['tag']; ?>
                                                </p>
                                            </div>
                                           
                                    <?php
                                    }
                                }

                                mysqli_close($con);

                                    ?>


                                        </li>

                            </ul>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>