<?php
$login = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'database.php';
  $email = $_POST["email"];
  $password = $_POST["password"];

  $sql = "Select * from users where email = '$email' AND password= '$password'";
  $result = mysqli_query($conn, $sql); //connection result
  $num = mysqli_num_rows($result);

  if ($num == 1) {
    $login = true;
    session_start();
    $_SESSION['loggedin'] = true;
    $_SESSION['email'] = $email;
    header("location: welcome.php");
  } else {
    $showError = "Invalid password ";
  }
}


?>


<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Log In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  <link rel="stylesheet" href="styles/error.css" type="text/css" />
</head>

<body class="lbgcolor">
  <?php require "partials/_nav.php" ?>

  <?php
  if ($login) {
    echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your are login 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }

  if ($showError) {
    echo  '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong>' . $showError . ' 
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
  }
  ?>

  <div class="container">
    <h1 class="text-center m-3">Login</h1>
    <br>
    <form action="login.php" method="POST" name="myForm" style="
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;">
      <div class=" mb-3 col-md-6">
        <label for="email" class="form-label">Number </label>
        <input type="text" class="form-control" id="mobileno" name="email" placeholder="Enter your Mobile Number" autocomplete="off" aria-describedby="emailHelp">
      </div>
      <div class="mb-3 col-md-6">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
      </div>
      <button type="submit" class="btn btn-primary">Login</button>
      <br>
      <span>Don't have an account? <a href="signup.php">Registration Now!</a></span>
    </form>
  </div>
  <script src="message.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

</body>

</html>