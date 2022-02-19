

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Digital Medical System</title>
  <meta content="" name="description">

  <meta content="" name="keywords">

  <!-- Favicons -->
  <!-- <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body>

  <?php
    session_start();
    include('admin/config/db_connection.php');
    $mgs = "";
    if(isset($_POST['login'])){  
      date_default_timezone_set('Asia/Dhaka');
      $currentTime = date('Y-m-d H:s:i');
      $user = trim($_POST['username']);
      $pass = trim($_POST['password']);
      $md5pass = md5($pass);
      $sql = "SELECT * FROM `users` WHERE (`user_contact` = '$user' OR `user_email` = '$user') AND `pass` = '$md5pass' AND `is_active` = 1 AND `USER_TYPE` = 2";
      $result = mysqli_query($con,$sql);
      $data = mysqli_fetch_assoc($result);
      if(!empty($data)){
        $_SESSION['patient'] = $data;
        $date= date('Y-m-d');
        $_SESSION['login_time'] = $date;
          
        header('Location: dashboard.php');
        exit;
      }else{
        
        $mgs="Your Username or Password is not valid!";
      }
    }
    ?>


  <div class="container">
      <div class="row" style="display: flex;align-items: center;justify-content: center;height: 100vh">
        <div class="col-md-5" style="background: #fff;box-shadow: 0px 0 30px rgb(1 41 112 / 8%);margin: 50px 0px;padding:70px 70px;">
            <h3 style="text-align: center;padding-bottom: 20px;">Digital Medical System Login</h3>
            <p style="font-size: 13px;text-align: center;">(Only patient can login from here)</p>
            <form method="post">
              <p class="error_message" style="font-size: 13px;color: red"><?=$mgs?></p>
             
              <div class="form-group">
                <label for="exampleInputEmail1">Email/Phone</label>
                <input type="text" class="form-control" name="username" placeholder="Enter username" required="">
              </div><br>
              <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password" required="">
              </div><br>
              <button type="submit" name="login" class="btn btn-primary">Login</button> &nbsp; <a href="registration.php">Registration</a>

              <br><br><br>Users other than patient,<a href="admin/index.php">Click Here</a> to access your Dashboard.
            </form>
        </div>
      </div>
</div>
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>