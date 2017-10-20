<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">


</head>
<body>


<nav class="navbar navbar-expand-md navbar-dark  fixed-top bg-info">

    <div class="navbar-brand">


        <a class="ml-auto text-white" href="#">Quiz</a>
    </div>

    <button class="navbar-toggler" data-target="#mynav" data-toggle="collapse" type="button">

        <span class="navbar-toggler-icon"></span>


    </button>

    <div class="collapse navbar-collapse" id="mynav">

        <ul class="navbar-nav mr-auto">

            <li class="active px-1"><a class="nav-link" href="#"> Home </a></li>
            <li class="px-1"><a class="nav-link" href="#"> Admin </a></li>


        </ul>

        <ul class="navbar-nav mr-1">

            <li class="px-1"><a class="nav-link" href="#"> Logout </a></li>
        </ul>


    </div>


</nav>


<div class="container" style="margin-top: 100px;">

    <p class="alert alert-danger" style="display: none;"> Email already exists!</p>


    <form method="post" action="">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="fname" class="col-form-label">First Name</label>
                <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name">
            </div>
            <div class="form-group col-md-6">
                <label for="lname" class="col-form-label">Last Name</label>
                <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name">
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password" class="col-form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label">Phone</label>
            <input type="tel" class="form-control" id="phone" name="phone" placeholder="Phone">
        </div>

        <div class="form-group">
            <label for="address" class="col-form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Address">
        </div>

        <div class="form-group">
            <a class="card-link" href="index.php"> Already Registerd? Login Here!</a>
        </div>


        <button type="submit" name="submit" class="btn btn-primary">Register</button>
    </form>


</div>

<?php



include 'DB_CONNECT.php';

if(isset($_POST['submit'])) {


    $conn = get_connection();

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "INSERT INTO USER (f_name, l_name, email, password, phone_no, address) 
                 VALUES ('$fname', '$lname', '$email', '$pass', '$phone', '$address');";

    if ($conn->query($sql) === TRUE) {

            header("location: index.php");

    } else {
        echo "error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();


}

?>


<script src="jquery-3.2.1.min.js" type="text/javascript"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha184-b/U6ypiBEHpOf/4+1nzFpr51nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
        integrity="sha184-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO1SEJAg45jXxnGIfYzk4Si90RDIqNm1"
        crossorigin="anonymous"></script>

</body>
</html>