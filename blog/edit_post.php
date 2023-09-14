<?php

session_start();
// if(isset($_SESSION['user_id']))
// {
//     echo "";
// }
// else
// {
//     header('location: ../userlogin.php');
// }
?>



<?php
include('navbar.php');
?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <!-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->

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
  <h1>Create  Post </h1>

  <?php
    
    
    $con=mysqli_connect("localhost:3307","root","","blog");

    if($con==false){
        echo "Connection not successful";
    }

    $post_id=$_GET['id'];
    $qry="SELECT * FROM `posts` WHERE `id`='$post_id'";
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
      <label for="title">Title</label>
      <input class="form-control" id="title" type="text" name="title" value="<?php echo $user_data['title']; ?>">
    </div>
    <div class="form-group">
      <label for="tag">Add Tags</label>
      <input class="form-control" id="tag" type="text" name="tag" value="<?php echo $user_data['tag']; ?>">
    </div>
    <div class="form-group">
      <label for="content">content</label>
      <textarea  class="form-control"  id="summernote" name="editor"><?php echo $user_data['content']; ?></textarea>
     
    </div>
    <input type="hidden" name='id' value="<?php echo $user_data['id']; ?>" />
    <input name="submit" class="btn btn-primary" type="submit" value="Sumbit" />
    </div>
  </form>
</div>
</div>

<script>
    $(document).ready(function () {
        $('#summernote').summernote({
            height: 300, 
            // placeholder: 'Write your text here...', 
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['picture', 'link', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>


<?php
if(isset($_POST['submit']))
{
    include('../dbcon.php');
    $title=$_POST['title'];
    $post_id=$_POST['id'];
    $tag=$_POST['tag'];
    $content=$_POST['editor'];

   
    
    $qry = "UPDATE `posts` SET `title`='$title',`tag`='$tag',`content`='$content' WHERE `id`='$post_id' ";
   
    $run=mysqli_query($con,$qry);
    if($run==true){
        ?>
        <script>
            alert("Post update successfully");
        </script>
         
        <?php
        header('location: blog.php');
    }
}
?>