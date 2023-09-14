
<?php
include('navbar.php');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<!------ Include the above in your HEAD tag ---------->
<style>
body {
  background: #f7f7f7;
}

.form-box {
  max-width: 500px;
  margin: auto;
  padding: 50px;
  background: #ffffff;
  border: 10px solid #f2f2f2;
}

h1, p {
  text-align: center;
}

input, textarea {
  width: 100%;
}
</style>
<div class="form-box">
  <h1>User Profile </h1>
  <?php
    
    
    $con=mysqli_connect("localhost:3307","root","","blog");

    if($con==false){
        echo "Connection not successful";
    }

    $user_id= 6;
    $qry="SELECT * FROM `user_details` WHERE `id`='$user_id'";
    $result = mysqli_query($con, $qry);

      if ($result) {
          $user_data = mysqli_fetch_assoc($result);
      } else {
          // Handle the database query error here
          die("Database query error: " . mysqli_error($con));
      }

     mysqli_close($con);

  ?>
 

  <form action="" method="post">
  
    <div class="form-group">
      <label for="username">Username</label>
      <input class="form-control" id="username" type="text" name="username"  value="<?php echo $user_data['username']; ?>">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input class="form-control" id="email" type="text" name="email" value="<?php echo $user_data['email']; ?>">
    </div>
    <input name="submit" class="btn btn-primary" type="submit" value="Update" />
    </div>
  </form>
</div>
</div>


<?php
if(isset($_POST['submit']))
{
    include('../dbcon.php');
    $username=$_POST['username'];
    
    $email=$_POST['email'];
   

    //$userid=$_SESSION['user_id'];
    $user_id="6";

    $sql="UPDATE `user_details` SET `username`='$username',`email`='$email' WHERE `id`='$user_id' ";
    $run=mysqli_query($con,$sql);
   
   
    $run=mysqli_query($con,$qry);
    if($run==true){
        ?>
        <script>
            alert("Profile update  successfully");
        </script>
        <?php
    }
}
?>