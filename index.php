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

            <li class="px-1"><a class="nav-link" href="#"> </a></li>
        </ul>


    </div>


</nav>


<div class="container " style="width: 500px;margin-top: 100px;">


    <br>

    <br>


    <div class="card">


        <div class="card-body ">
            <h4 class="card-title"> Login </h4>
            <br>

            <form method="post" action="index.php">
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" placeholder="Password" name="password">
                </div>

                <div class="form-group">
                    <a class="card-link text-center" href="register.php"> Not Registered? Sign Up Now! </a>

                </div>
                <button type="submit" name="submit" class="btn btn-primary">Login</button>
            </form>


        </div>


    </div>


</div>

<?php

 include 'DB_CONNECT.php';

 if(isset($_POST['submit'])){


     $conn = get_connection();
     $email = $_POST['email'];
     $pass = $_POST['password'];
     $sql = "SELECT email, password FROM USER WHERE email='$email' AND password='$pass'";
     $result = $conn->query($sql);
     if($result->num_rows > 0){
         $details = $result->fetch_assoc();


         $_SESSION['uid'] = $details['email'];
         header("location: home.php");


     }







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