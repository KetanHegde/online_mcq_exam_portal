<?php 
    session_start();

    include "db_conn.php";
    
    if(!isset($_SESSION['usn']))
    {
        $_SESSION['login_note'] = "Please Login to continue";
        header("Location: index.php");
    }

    // if(!isset($_SESSION['sel_sub']))
    // {
    //     header("Location: home.php");
    // }

    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $sid = $_POST["SUB"];
        $sname = "SELECT SNAME FROM SUBJECT WHERE SID = '$sid'";
        $row = $conn->query($sname)->fetch_assoc();
        $sname = $row["SNAME"];

        $sq = "SELECT QID FROM QUESTIONS WHERE SID = '$sid' ORDER BY RAND () LIMIT 5";
        $res = $conn->query($sq);
        while($row = $res->fetch_assoc())
        {
            // $qid = $row["QID"];
            // $q1q ="SELECT QNAME FROM QUESTIONS WHERE SID = '$qid'";
        }
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
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        ::-webkit-scrollbar {
            display: none;
        }

        /* .btn {
            background-color: #275e69;
        }

        .btn:hover {
            background-color: #275e69;
        } */

        .queBox {
            width: 98%;
            margin: 2% 0%;
        }

        .optDiv .form-check {
            padding: 7px;
        }

        .form-check-input {
            border: 1px solid black;
            cursor: pointer;
        }

        .form-check-label {
            cursor: pointer;
        }

        .info {
            font-size: large;
            font-weight: 600;
            margin: 10px 0px;
        }

        h1 {
            background-color: #1f274a;
        }
    </style>
</head>

<body style="background-color: #101426;color:white">
    <div class="container-fluid" id="d">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12"
                style="border-right:1px solid #93dfef;height:100vh;display: flex;flex-direction: column;align-items: center;padding:0%;">
                <div style="width:99%;border:1px solid #3c4a76;border-radius: 5px;padding: 0.8vw 1.7vw;">
                    <div style="font-size: x-large;font-weight: 700;">Candidate Information</div>
                    <div class="info">Name: <?php echo $_SESSION['name']?></div>
                    <div class="info">USN: <?php echo  $_SESSION['usn']?></div>
                </div>
                <div class="mt-3">
                    <p style="font-size: 20px;text-align: center;margin-bottom: 0;font-weight: bold;">Time remaining</p>
                    <p style="font-size: 80px;text-align: center;font-weight: 600;margin-bottom: 1vh;margin-top: 0;">
                        01:00</p>
                </div>
                <div style="width:99%;border-radius: 5px;padding: 5px;border: 1px solid #3c4a76;">
                    <p style="font-size: large;text-align:center;font-weight: 700;margin-bottom: 0;">Instructions to
                        the candidate</p>
                    <ol>
                        <li>This page contains exactly five questions</li>
                        <li>Each question has four multiple choices</li>
                        <li>Exiting Fullscreen mode causes automatic submission</li>
                        <li>After marking all answers, click on the submit button</li>
                        <li>Once submitted cannot be undone!!</li>
                    </ol>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
                <form action="home.php" method="POST" id="f" target="_blank">
                <h2 style="font-size: xx-large;font-weight: bold;padding: 10px 3px;border-bottom:2px solid #93dfef;">
                    <?php echo $sname ?></h2>
                <div style="height:88vh;display: flex;flex-direction: column;align-items: center;" class="overflow-auto"
                    id="quest">
                </div>
                </form>
            </div>
        </div>
    </div>
    <button onclick="toggleFullscreen()" id="b" class="btn btn-primary" style="position:absolute;top:45%;left:45%;">Toggle Fullscreen</button>
</body>

<script>
    var i = 0;
    document.getElementById('d').style.display = "none";
    var quest = document.getElementById('quest');
    while (i < 5) {
        let temp = `<div class="queBox">
                        <div
                            style="height:25%;background-color:#1f274a;display: flex;align-items: center;border-top-right-radius: 6px;border-top-left-radius:6px;border-top:1px solid #93dfef;border-left:1px solid #93dfef;border-right:1px solid #93dfef;">
                            <div class="mx-3">1) The term HTTP stands for</div>
                        </div>
                        <div
                            style="background-color: #101426;color:white;padding:10px 0px;border-bottom-left-radius: 6px;border-bottom-right-radius: 6px;
                            border-bottom:1px solid #93dfef;border-left:1px solid #93dfef;border-right:1px solid #93dfef;">
                            <div class="optDiv mx-5">
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" id="opt1${i}" name="options${i}">
                                    <label class="form-check-label" for="opt1${i}">
                                        Hypertext Transfer Protocol
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" name="options${i}" class="form-check-input" id="opt2${i}"><label
                                        class="form-check-label" for="opt2${i}">
                                        Hypertransfer Text Protocol
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="options${i}" id="opt3${i}">
                                    <label class="form-check-label" for="opt3${i}">
                                        Highspeed text transmission Protocol
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input type="radio" class="form-check-input" name="options${i}" id="opt4${i}">
                                    <label class="form-check-label" for="opt4${i}">
                                        Highspeed Text Transfer Protocol
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>`;
        quest.innerHTML += temp; i += 1;
    }
    quest.innerHTML += `<div class="mt-5 mb-4">
                        <button type="submit" class="btn btn-success mb-2">Submit</button>
                    </div>`;


//     window.addEventListener('beforeunload', function (e) {
//     //You can put your custom logic here
//     e.preventDefault();
//     document.getElementById('f').submit();
//     //e.returnValue = '';
// });
function toggleFullscreen() {
    var elem = document.documentElement; // Get the root element of the document

    if (!document.fullscreenElement && !document.mozFullScreenElement &&
        !document.webkitFullscreenElement && !document.msFullscreenElement) {
        // If the document is not currently in fullscreen mode, request it
        if (elem.requestFullscreen) {
            elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) { // Firefox
            elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) { // Chrome, Safari and Opera
            elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { // Internet Explorer/Edge
            elem.msRequestFullscreen();
        }
        document.getElementById('b').style.display = "none";
        document.getElementById('d').style.display = "initial";
    }
}

// document.addEventListener('fullscreenchange', handleFullscreenChange);
// document.addEventListener('mozfullscreenchange', handleFullscreenChange);
// document.addEventListener('webkitfullscreenchange', handleFullscreenChange);
// document.addEventListener('msfullscreenchange', handleFullscreenChange);

// function handleFullscreenChange() {
//     // Check if the document is currently in fullscreen mode
//     if (document.fullscreenElement || document.mozFullScreenElement ||
//         document.webkitFullscreenElement || document.msFullscreenElement) {
//         // Run your functions when entering fullscreen
//     } else {
//         document.getElementById("f").submit();
//         // Run your functions when exiting fullscreen
//     }
// }
</script>

</html>