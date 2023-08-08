<?php
// components/connect.php (Database connection)
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "my_login_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_COOKIE['user_id'])) {
    $user_id = $_COOKIE['user_id'];
} else {
    $user_id = '';
}

// For the likes table
$select_likes = $conn->prepare("SELECT * FROM likes WHERE user_id = ?");
$select_likes->bind_param("i", $user_id);
$select_likes->execute();
$result_likes = $select_likes->get_result();
$total_likes = $result_likes->num_rows;

// For the comments table
$select_comments = $conn->prepare("SELECT * FROM comments WHERE user_id = ?");
$select_comments->bind_param("i", $user_id);
$select_comments->execute();
$result_comments = $select_comments->get_result();
$total_comments = $result_comments->num_rows;

// For the bookmark table
$select_bookmark = $conn->prepare("SELECT * FROM bookmark WHERE user_id = ?");
$select_bookmark->bind_param("i", $user_id);
$select_bookmark->execute();
$result_bookmark = $select_bookmark->get_result();
$total_bookmarked = $result_bookmark->num_rows;

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>


<!-- quick select section starts  -->

<section class="quick-select">

   <h1 class="heading">Web Development</h1>

   <div class="box-container">

      <?php
         if($user_id != ''){
      ?>
      <div class="box">
         <h3 class="title">likes and comments</h3>
         <p>total likes : <span><?= $total_likes; ?></span></p>
         <a href="likes.php" class="inline-btn">view likes</a>
         <p>total comments : <span><?= $total_comments; ?></span></p>
         <a href="comments.php" class="inline-btn">view comments</a>
         <p>saved playlist : <span><?= $total_bookmarked; ?></span></p>
         <a href="bookmark.php" class="inline-btn">view bookmark</a>
      </div>
      <?php
         }else{ 
      ?>
      <div class="box" style="text-align: center;">
         <h3 class="title">please login or register</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>
      <?php
      }
      ?>

      <div class="box">
         <h3 class="title">top categories</h3>
         <div class="flex">
            <a href="search_course.php?"><i class="fas fa-code"></i><span>Frontend development</span></a>
            <a href="#"><i class="fas fa-code"></i><span>Backend development</span></a>
            <a href="#"><i class="fas fa-cog"></i><span>Responsive Web design</span></a>
            <a href="#"><i class="fas fa-cog"></i><span>Deployment and Hosting</span></a>
            <a href="#"><i class="fas fa-cog"></i><span>software</span></a>
            
         </div>
      </div>

      <div class="box">
         <h3 class="title">popular topics</h3>
         <div class="flex">
            <a href="#"><i class="fab fa-html5"></i><span>HTML</span></a>
            <a href="#"><i class="fab fa-css3"></i><span>CSS</span></a>
            <a href="#"><i class="fab fa-js"></i><span>javascript</span></a>
            <a href="#"><i class="fab fa-react"></i><span>react</span></a>
            <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>
            <a href="#"><i class="fab fa-bootstrap"></i><span>bootstrap</span></a>
         </div>
      </div>

      <div class="box tutor">
         <h3 class="title">Join as an instructor</h3>
         <p> Let us know your availability and interest in this platform</p>
         <a href="register.html" class="inline-btn">get started</a>
      </div>

   </div>

</section>

<!-- quick select section ends -->

<!-- courses section starts  -->

<section class="courses">

   
</section>
<script src="js/script.js"></script>

</body>
</html>
