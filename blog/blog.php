<?php
include('navbar.php');
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->


<div class="container">
    <h1>My Blogs</h1>

    <div class="col-md-12">

        <?php


        $con = mysqli_connect("localhost:3307", "root", "", "blog");

        if ($con == false) {
            echo "Connection not successful";
        }

        $user_id = 6;
        $qry = "SELECT * FROM `posts` WHERE `user_id`='$user_id'";
        $result = mysqli_query($con, $qry);



        if ($result) {
            $count = 0;
            while ($data = mysqli_fetch_assoc($result)) {
                $count++;

        ?>
                <h1><?php echo ($data['title']); ?></h1>
                <p><?php echo $data['content']; ?></p>
                <p class="text-primary"><?php echo ($data['tag']); ?></p>
                <div>

                    <span class="badge"><?php echo htmlentities($data['created_at']); ?></span>
                    <div class="pull-right">

                        <a href="edit_post.php?id=<?php echo ($data['id']); ?>"><button type="submit" name="edit" class="btn btn-success">Edit</button></a>
                        <!-- <button type="submit" name="edit" href="edit_post.php" class="btn btn-success">Edit</button> -->
                        <a href="delete_post.php?id=<?php echo ($data['id']); ?>"> <button type="submit" name="delete" class="btn btn-danger">Delete</button></a>
                    </div>
                </div>
                <hr>
        <?php
            }
        } else {

            die("Database query error: " . mysqli_error($con));
        }

        mysqli_close($con);

        ?>

    </div>


   