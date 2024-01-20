<?php 
session_start();

include "db_conn.php";

if(!isset($_SESSION['usn']))
{
    $_SESSION['login_note'] = "Please Login to continue";
    header("Location: index.php");
}
$usn = $_SESSION['usn'];

if(strlen(intval($usn))!=10)
{
    header("Location: home.php");
}
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $_SESSION['sid'] = $_POST['SUB'];
}
else
{
    header("Location: home.php");
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online MCQ Exam Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <style>
        @-webkit-keyframes quantumWizPaperInputRemoveUnderline {
            0% {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                opacity: 1
            }

            to {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                opacity: 0
            }
        }

        @keyframes quantumWizPaperInputRemoveUnderline {
            0% {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                opacity: 1
            }

            to {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1);
                opacity: 0
            }
        }

        @-webkit-keyframes quantumWizPaperInputAddUnderline {
            0% {
                -webkit-transform: scaleX(0);
                -webkit-transform: scaleX(0);
                transform: scaleX(0)
            }

            to {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1)
            }
        }

        @keyframes quantumWizPaperInputAddUnderline {
            0% {
                -webkit-transform: scaleX(0);
                -webkit-transform: scaleX(0);
                transform: scaleX(0)
            }

            to {
                -webkit-transform: scaleX(1);
                -webkit-transform: scaleX(1);
                transform: scaleX(1)
            }
        }

        .uli_ {
            background-color: #3c4a76;
            height: 1.4px !important;
        }

        input {
            border: none !important;
            padding-left: 0 !important;
            font-size: large !important;
            background-color: #101426 !important;
            color: aliceblue !important;
        }

        ::placeholder {
            color: grey !important;
        }

        input:focus {
            border: none !important;
            box-shadow: none !important;
        }

        input:focus+.uli_ {

            /* Define the underline animation */
            animation: quantumWizPaperInputAddUnderline 0.2s ease-in-out;
            background-color: rgba(206, 206, 206, 0.736);
            transform-origin: center;
            transform: scaleX(1);
        }

        #bg {
            background-image: linear-gradient(90deg, #275e69 20%, #93dfef 80%);
            color: white;
            padding: 4%;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        h3 {
            color: white;
            padding: 15px 0px 15px 50px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .nav_item:hover {
            cursor: pointer;
            transform: scale(1.08);
            transition-duration: 1s;
        }

        .add_subject {
            background-color: #93dfef;
            width: 30%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            cursor: pointer;
        }

        .add_subject:hover>span {
            transform: scale(1.05);
            transition-duration: 1s;
        }

        input.s {
            font-size: medium !important;
        }
    </style>
</head>

<body style="background-color:#101426;font-family: 'DM Sans',sans-serif;">
    <div class=" container-fluid">
        <div class="row" style="color: white;background-color: #101426;
            position: sticky;
            top: 0;
            z-index: 5;">
            <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12">
                <h3>ONLINE MCQ EXAM PORTAL</h3>

            </div>
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                <div
                    style="display:flex;flex-direction: row;align-items: center;justify-content: space-around;height: 70px;">
                    <div class="nav_item"><span>Home</span></div>
                    <div class="nav_item"><span>Logout</span></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
            <form action="verify/insert_q.php" method="POST">
                <div style="display:flex;align-items: center;width:100%;flex-direction: column;" class="mt-4">
                    <div style="width:60%;">
                        <p
                            style="font-size: x-large;color:white;border:1px solid #93dfef;display: inline-block;padding:2px 20px;border-radius: 10px;">
                            Add A Question</p>
                        <div
                            style="display: flex;flex-direction: column;;align-items: center;justify-content: space-between;border:1px solid #3c4a76;padding:10px;border-radius: 10px;">
                            <div class="mt-2 mb-3" style="width:90%;">
                                <input type="text" class="form-control" name="inpQ" id="inpQ"
                                    placeholder="Enter The Question">
                                <div class="uli_"></div>
                            </div>
                            <div class="mb-3" style="width:90%;">
                                <input type="text" name="inpO1" class="form-control s" id="inpO1"
                                    placeholder="Enter option 1">
                                <div class="uli_"></div>
                            </div>
                            <div class="mb-3" style="width:90%;">
                                <input type="text" name="inpO2" class="form-control s" id="inpO2"
                                    placeholder="Enter option 2">
                                <div class="uli_"></div>
                            </div>
                            <div class="mb-3" style="width:90%;">
                                <input type="text" name="inpO3" class="form-control s" id="inpO3"
                                    placeholder="Enter option 3">
                                <div class="uli_"></div>
                            </div>
                            <div class="mb-3" style="width:90%;">
                                <input type="text" name="inpO4" class="form-control s" id="inpO4"
                                    placeholder="Enter option 4">
                                <div class="uli_"></div>
                            </div>
                            <div class="mb-3" style="width:90%;">
                                <input type="text" name="inpAns" class="form-control s" id="inpANS"
                                    placeholder="Enter correct answer">
                                <div class="uli_"></div>
                            </div>
                            <div class="mt-3 mb-3">
                                <button type="submit" class="btn btn-primary">Add</button>
                            </div>
                        </div>
                    </div>
                </div>
    </form>
            </div>

        </div>
    </div>

</body>

</html>