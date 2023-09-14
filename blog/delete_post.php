<?php

include('../dbcon.php');
    $id=$_GET['id'];
    $qry="DELETE FROM `posts` WHERE `id`='$id'";
    $run=mysqli_query($con,$qry);
    if($run == true){
        ?>
        <script>
           alert ("Post Delete Successfully");
        </script>
        <?php
        header("location: blog.php");
    }
?>