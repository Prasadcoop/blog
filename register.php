<?php
// Initialize variables
$username = $email = $password1 = $password2 = "";
$error = "";

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password1'];
    $password2 = $_POST['password2'];

    // Check if passwords match
    if ($password === $password2) {
        $link = mysqli_connect("localhost:3307", "root", "", "blog");

        if ($link === false) {
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        // Check if the username or email already exists in the database
        $check_query = "SELECT * FROM user_details WHERE username='$username' OR email='$email'";
        $result = mysqli_query($link, $check_query);

        if (mysqli_num_rows($result) > 0) {
            $error = "Username or email already exists. Please choose another.";
        } else {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            
            // Insert user details into the database
            $sql = "INSERT INTO user_details (username, email, password,isActive) VALUES ('$username', '$email', '$hashedPassword', 1)";
            
            if (mysqli_query($link, $sql)) {
                ?><script>
                alert("User added successfully.");
                </script>
                <?php
            } else {
                $error = "ERROR: Could not execute $sql. " . mysqli_error($link);
            }
        }

        mysqli_close($link);
    } else {
        $error = "Passwords do not match. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>User registration</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/a43ceed218.js" crossorigin="anonymous"></script>
</head>

<body>
    <h1 align="center">Create New User</h1><br>

    <!-- Display error message if there is one -->
    <?php if (!empty($error)) : ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php endif; ?>

    <article class="card-body mx-auto" style="max-width: 400px;">
        <form method="post" action="register.php">
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                </div>
                <input name="username" class="form-control" placeholder="Username" type="text" required>
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input name="email" class="form-control" placeholder="Email address" type="email" required>
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="password1" class="form-control" placeholder="Create password" type="password" required>
            </div> <!-- form-group// -->
            <div class="form-group input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                </div>
                <input name="password2" class="form-control" placeholder="Repeat password" type="password" required>
            </div> <!-- form-group// -->
            <div class="form-group">
                <button type="submit" name="submit" class="btn btn-primary btn-block"> Create Account </button>
            </div> <!-- form-group// -->
            <p class="text-center">Have an account? <a href="login.php">Log In</a> </p>
        </form>
    </article>

    <center>
        <a href="login.php"><button class="btn btn-primary">Back to Login</button></a>
    </center>
</body>

</html>
