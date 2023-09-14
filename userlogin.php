<?php
session_start();


if(isset($_SESSION['user_id']))
{
    header('location: blog/createblog.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a43ceed218.js" crossorigin="anonymous"></script>
</head>
<body>
    <h1 align="center">User Login</h1><br>

    <?php
    if (isset($error)) {
        echo '<div class="alert alert-danger" role="alert">' . $error . '</div>';
    }
    ?>

    <article class="card-body mx-auto" style="max-width: 400px;">
        <form action="userlogin.php" method="post" class="form-control">
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                </div>
                <input name="username" class="form-control" placeholder="Username" type="text" required>
            </div> <!-- form-group// -->
           
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="password" class="form-control" placeholder="Password" type="password" required>
            </div> <!-- form-group// -->
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary btn-block">Login</button>
            </div> <!-- form-group// -->
        </form>
    </article>
    <center>
        <a href="register.php"><button class="btn btn-primary">Create New Account</button></a>
    </center>
</body>
</html>
<?php
//include('dbcon.php');
$con=mysqli_connect("localhost:3307","root","","blog");

if($con==false){
    echo "Connection not successful";
}


if(isset($_POST['login'])){
    $username = mysqli_real_escape_string($con, $_POST['username']);
    //$password = mysqli_real_escape_string($con, $_POST['password']);
    $password=$_POST['password'];
    $qry = "SELECT id, username, password  FROM `user_details` WHERE `username`='$username'";
    
    // Check if the user exists
    $run = mysqli_query($con, $qry);
    
    $row = mysqli_num_rows($run);
    
    if($row < 1) {
        $error = 'User not found';
    } else {
        $data = mysqli_fetch_assoc($run);
        $phash = $data['password'];
      
        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        // echo $data. "</br>";
        // echo $phash. "</br>";
        // echo $data['username']. "</br>";
        // echo "Password Verification: " . (password_verify($password, $phash) ? 'Match' : 'No Match') . "<br>";
    
        
        if(password_verify($password, $phash)) {
            
            $_SESSION['user_id'] = $data['id'];
            header('location: blog/createblog.php');
            exit();
        } else {
            $error = 'Username or Password does not match';
        }
    }
}
?>
