<?php
session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <script src="jquery-3.2.1.min.js" type="text/javascript"></script>


</head>
<body>

<?php

include "DB_CONNECT.php";

if (!isset($_SESSION['uid'])) {

    header("location: index.php");
} else {
    $username = $_SESSION['uid'];
}

?>

<nav class="navbar navbar-expand-md navbar-dark  fixed-top bg-info">

    <div class="navbar-brand">


        <a class="ml-auto text-white" href="#"><?php echo "Welcome " . $_SESSION['uid']; ?></a>
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

            <li class="px-1"><a class="nav-link" href="logout.php"> Logout </a></li>
        </ul>


    </div>


</nav>


<div class="container" style="margin-top: 100px;">


   <div class="card" id="test_card">

        <div class="card-header">

            <h4 class="card-title"> Available Tests</h4>

        </div>

        <div class="card-body">


            <div class="btn-container" style="display: block">

                <button class="btn btn-outline-primary" id="btn1">Test #1</button>

                <br>
                <br>
                <br>

                <button class="btn btn-outline-primary" id="btn2">Test #2</button>

            </div>

        </div>


    </div>

    <div class="loading text-center" style="display: none;">

        <br>
        <br>
        <br>

        <img src="loading.gif">


        <br>
        <br>
        <br>


    </div>


    <div class="card" id="result_card" style="display: none;">

        <div class="card-header">

            <h4 class="card-title"> Results </h4>

        </div>

        <div class="card-body">

            <p class="text-dark"> Number of Questions : <span> 10 </span> </p>

            <p class="text-info"> Questions Attempted : <span> 10 </span> </p>

            <p class="text-success"> Correct Answers : <span>  </span> </p>

            <p class="text-danger"> Wrong Answers : <span>  </span> </p>

            <p class="text-info" id="final"> Final Scores : <span></span>/<span>10</span> </p>

                <h5> </h5>
            </div>


        </div>



    <div class="card " id="quest_card" style="display: none">

        <div class="card-header">
            <h4 class="card-title"></h4>
        </div>

        <div class="card-body">


            <p class="card-text"></p>


            <form id="frm">

                <div class="row">


                    <div class="col">
                        <label class="custom-control custom-radio">
                        <input type="radio" name="radio" value="" id="rad1" class="custom-control-input"> <span> </span>
                            <span class="custom-control-indicator"></span>
                        </label>
                    </div>
                    <div class="col">
                        <label class="custom-control custom-radio">
                        <input type="radio" name="radio" value="" id="rad2" class="custom-control-input"> <span> </span>
                            <span class="custom-control-indicator"></span>
                        </label>
                    </div>
                    <div class="col">
                        <label class="custom-control custom-radio">
                        <input type="radio" name="radio" value="" id="rad3" class="custom-control-input"> <span> </span>
                            <span class="custom-control-indicator"></span>
                        </label>
                    </div>
                    <div class="col">
                        <label class="custom-control custom-radio">
                        <input type="radio" name="radio" value="" id="rad4" class="custom-control-input"> <span> </span>
                            <span class="custom-control-indicator"></span>
                        </label>
                    </div>
                </div>

                <br>

                <button class="btn btn-primary text-center" type="submit">Next</button>

            </form>

        </div>


    </div>

</div>




<script type="text/javascript">

    $(document).ready(function () {





        $('#btn1').on('click', function (e) {

            e.preventDefault();
            console.log("indside");

            $('#test_card').hide();

            $('.loading').css({'display': 'block'});

            $.ajax({

                type: 'POST',
                url: 'quest_ajax.php',
                success: function (res) {

                    var json = JSON.parse(res);
                    console.log(json);


                    loadQuestion(json);

                    $('#quest_card').css({'display': 'block'});

                }


            });





        });


        function loadQuestion(json) {

            console.log("inside func");

            $('.loading').hide();

            if(parseInt(json.count) === 11){

                console.log("inside if");

                $('#result_card').css({'display': 'block'});
                $('#result_card .text-success span').text(json.score);
                $('#result_card .text-danger span').text(10 - json.score);
                $('#final span').text(json.score);
                var score = parseInt(json.score);
                if(score >= 8)
                    $('#result_card h4').text("Congrats you passed this test!");

                else
                    $('#result_card h4').text("Sorry you failed! Please try again later");

            }

        else {



                $('#quest_card .card-title').text("Question " + json.level);
                $('#quest_card .card-text').text(json.question);
                $('#rad1').val(json.op1);
                $('#rad2').val(json.op2);
                $('#rad3').val(json.op3);
                $('#rad4').val(json.op4);
                $('#rad1 + span').text(json.op1);
                $('#rad2 + span').text(json.op2);
                $('#rad3 + span').text(json.op3);
                $('#rad4 + span').text(json.op4);


                $('#quest_card').show();

            }

        }


        $("#frm").submit(function (e) {

            e.preventDefault();
            console.log("hi");
            $('#quest_card').hide();
            $('.loading').show();


            //var data = $(this).serialize();
           var data = $('input[name=radio]:checked', '#frm').val();
            console.log("data "+ data);
            var jso = {answer: data};



            $.ajax({

                type: 'POST',
                url: 'update_user.php',
                data: jso,
                success: function (res) {

                    console.log(res);
                    var json = JSON.parse(res);
                    console.log(json);
                    loadQuestion(json);


                }


            });


        });


    });


</script>


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