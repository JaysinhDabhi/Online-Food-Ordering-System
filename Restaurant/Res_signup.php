<?php
$showAlert = false;
$showError = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'database.php';
    $firstname = $_POST["fname"];
    $lastname = $_POST["lname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $User_type = $_POST["User_type"];
    $cpassword = $_POST["cpassword"];

    // $exists=false;

    //check username exitst 
    $exitstSql = "SELECT * FROM `users` WHERE email = '$email'";
    $result = mysqli_query($conn, $exitstSql);
    $numExistRows = mysqli_num_rows($result);
    if ($numExistRows > 0) {
        // $exists = true;
        $showError = " Username is Already Exists";
    } else {
        if (($password == $cpassword)) { //if password equl to confirm password
            $sql = "INSERT INTO `users` (`first name`, `last name`, `email`, `password`, `User_type`, `dt`) 
            VALUES ('$firstname', '$lastname', '$email', '$password',  '$User_type', '2022-08-28 07:00:05.000000')"; //sql query
            $result = mysqli_query($conn, $sql); //connection result
            if ($result) {
                $showAlert = true;
                session_start();
                $_SESSION['loggedin'] = true;
                header("location: welcome.php");
            }
        } else {
            $showError = "Password Do Not Match";
        }
    }
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Restaurant Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/error.css" type="text/css" />
</head>

<body class="sbgcolor">
    <?php require "res_partials/Res_nav.php" ?>
    <?php
    if ($showAlert) {
        echo  '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> You are login Successfully Now you can Login
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
        <h1 class="text-center m-3"> Restaurant SignUp</h1>
        <form id="form" action="signup.php" name="myForm" onsubmit="return onFormSubmit(this);" method="POST" style="display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;">


            <div id="name" class=" mb-3 col-md-6 ">
                <label for="username" class="form-label">Name </label>
                <input type="text" class="form-control" id="rname" name="fname" placeholder="Enter Your Name" aria-describedby="emailHelp" autocomplete="off">
            </div>


            <div id="lname" class=" mb-3 col-md-6 ">
                <label for="username" class="form-label">Number</label>
                <input type="text" class="form-control" name="rmobileno" id="lname" placeholder="Enter Your Number" aria-describedby="emailHelp" autocomplete="off">
            </div>


            <div id="email" class=" mb-3 col-md-6">
                <label for="username" class="form-label">Email </label>
                <input type="text" class="form-control" name="email" id="remail" placeholder="Enter Your Email Id" aria-describedby="emailHelp" autocomplete="off">
            </div>

            <div id="email" class=" mb-3 col-md-6">
                <label for="username" class="form-label">City </label>
                <input type="text" class="form-control" name="email" id="rcity" placeholder="Enter Your City" aria-describedby="emailHelp" autocomplete="off">
            </div>

            <div id="email" class=" mb-3 col-md-6">
                <label for="username" class="form-label">State </label>
                <input type="text" class="form-control" name="email" id="rstate" placeholder="Enter Your State" aria-describedby="emailHelp" autocomplete="off">
            </div>

            <div id="email" class=" mb-3 col-md-6">
                <label for="username" class="form-label">Pincode </label>
                <input type="text" class="form-control" name="email" id="rpincode" placeholder="Enter Your Pincode" aria-describedby="emailHelp" autocomplete="off">
            </div>


            <div id="password" class="mb-3 col-md-6">
                <label for="password" class="form-label" id="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" autocomplete="off">
            </div>


            <div id="cpassword" class="mb-3 col-md-6">
                <label for="cpassword" class="form-label" id="cpassword">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" placeholder="Confirm password" autocomplete="off">
            </div>





            <button type="submit" value="submit" class="btn btn-primary">Submit</button>
            <br>

            <p>Already have an account? <a href="res_login.php">Login Now!</a></p>
        </form>
    </div>

    <script src="message.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script> -->

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }

        $(document).ready(function() {
            $("form[name='myForm']").validate({

                // Specify validation rules
                rules: {
                    // The key name on the left side is the name attribute
                    // of an input field. Validation rules are defined
                    // on the right side
                    fname: "required",
                    lname: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    }
                },
                // Specify validation error messages
                messages: {
                    fname: "*Please enter your Firstname",
                    lname: "*Please enter your Lastname",
                    password: {
                        required: "*Please Enter a Password",
                        minlength: "*Your password must be at least 5 characters long"
                    },
                    email: "*Please enter a valid Email address"
                },
                // Make sure the form is submitted to the destination defined
                // in the "action" attribute of the form when valid
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>

</body>

</html>