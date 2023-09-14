<?php

session_start();
if(isset($_SESSION['uid']))
{
    header('location:blog/createblog.php');
}

?>
<html>

    <title>User Login</title>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a43ceed218.js" crossorigin="anonymous"></script>
</head>

<body>
    <h1 align="center">User Login</h1><br>
   
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <article class="card-body mx-auto" style="max-width: 400px;">
        <form  action="login.php" method="post">
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
                <input name="password" class="form-control" placeholder="password" type="password" required>
            </div> <!-- form-group// -->
            <div class="form-group">
                <button type="submit" name="login" class="btn btn-primary btn-block"> login</button>
            </div> <!-- form-group// -->
           
        </form>
    </article>
    <center>
        
        <a href="register.php"><button class="btn btn-primary">Create New Account</button></a>
    </center>
</body>

</html>




<?php
$con = mysqli_connect("localhost:3307", "root", "", "blog");

if ($con == false) {
    echo "Connection not successful";
}

$username = $_POST['username'];
$password = $_POST['password'];

$query = "SELECT id, username, password FROM user_details WHERE username = '$username'";
$run = mysqli_query($con, $query);
$row = mysqli_num_rows($run);


if ($row < 1) {
    ?>
    <script>
        alert('User not found');
        window.open('login.php', '_self');
    </script>
    <?php
} else {
    $data = mysqli_fetch_assoc($run);
    $phash = $data['password'];
    $new= password_hash($password, PASSWORD_DEFAULT);
    echo "Entered Password: " . $new . "<br>";
    echo "Stored Password Hash: " . $phash . "<br>";
    
    if (password_verify($password, '1234')) {
        echo "Password Verification: Match";
    } else {
        echo "Password Verification: No Match";
    }
}



mysqli_close($con);
?>

   


