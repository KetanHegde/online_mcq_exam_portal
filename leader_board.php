<?php 
session_start();
include "db_conn.php";

if(!isset($_SESSION['usn']))
{
    $_SESSION['login_note'] = "Please Login to continue";
    header("Location: index.php");
}

$usn = $_SESSION['usn'];
$sql = "WITH RankedScores AS (
    SELECT
        NAME,
        SCORE.USN,
        TIME_TAKEN,
        SCORE,
        ROW_NUMBER() OVER (PARTITION BY NAME ORDER BY SCORE DESC, TIME_TAKEN ASC) AS RowNum
    FROM SCORE
    JOIN USERS ON SCORE.USN = USERS.USN
    WHERE SID = 1
)
SELECT NAME, USN, TIME_TAKEN, SCORE
FROM RankedScores
WHERE RowNum = 1
ORDER BY SCORE DESC, TIME_TAKEN ASC";

$dis='';
$res = $conn->query($sql);
if($res->num_rows<=0)
{
    $dis = "<tr><td colspan='5'>No data</td></tr>";
}
else
{
$i=1;
while($row=$res->fetch_assoc())
{
    if(strlen($row['TIME_TAKEN'])==1)
    {
            $row['TIME_TAKEN']='0'.$row['TIME_TAKEN'];
    }
    if($row['TIME_TAKEN']=='60')
    {
        $tm = '01';
        $ts = '00';
    }
    else
    {
        $tm = '00';
        $ts = $row['TIME_TAKEN'];
    }
    $dis = $dis.'<tr>
    <td>'.$i.'</td>
    <td>'.$row['NAME'].'</td>
    <td>'.$row['USN'].'</td>
    <td>'.$tm.':'.$ts.'</td>
    <td>'.$row['SCORE'].'/5</td>
</tr>';
$i++;
}
}



$sql = "WITH RankedScores AS (
    SELECT
        NAME,
        SCORE.USN,
        TIME_TAKEN,
        SCORE,
        ROW_NUMBER() OVER (PARTITION BY NAME ORDER BY SCORE DESC, TIME_TAKEN ASC) AS RowNum
    FROM SCORE
    JOIN USERS ON SCORE.USN = USERS.USN
    WHERE SID = 2
)
SELECT NAME, USN, TIME_TAKEN, SCORE
FROM RankedScores
WHERE RowNum = 1
ORDER BY SCORE DESC, TIME_TAKEN ASC";

$dis1='';
$res = $conn->query($sql);
if($res->num_rows<=0)
{
    $dis1 = "<tr><td colspan='5'>No data</td></tr>";
}
else
{
$i=1;
while($row=$res->fetch_assoc())
{
    if(strlen($row['TIME_TAKEN'])==1)
    {
            $row['TIME_TAKEN']='0'.$row['TIME_TAKEN'];
    }
    $dis1 = $dis1.'<tr>
    <td>'.$i.'</td>
    <td>'.$row['NAME'].'</td>
    <td>'.$row['USN'].'</td>
    <td>00:'.$row['TIME_TAKEN'].'</td>
    <td>'.$row['SCORE'].'/5</td>
</tr>';
$i++;
}
}

$sql = "WITH RankedScores AS (
    SELECT
        NAME,
        SCORE.USN,
        TIME_TAKEN,
        SCORE,
        ROW_NUMBER() OVER (PARTITION BY NAME ORDER BY SCORE DESC, TIME_TAKEN ASC) AS RowNum
    FROM SCORE
    JOIN USERS ON SCORE.USN = USERS.USN
    WHERE SID = 3
)
SELECT NAME, USN, TIME_TAKEN, SCORE
FROM RankedScores
WHERE RowNum = 1
ORDER BY SCORE DESC, TIME_TAKEN ASC";

$dis2='';
$res = $conn->query($sql);
if($res->num_rows<=0)
{
    $dis2 = "<tr><td colspan='5'>No data</td></tr>";
}
else
{
$i=1;
while($row=$res->fetch_assoc())
{
    if(strlen($row['TIME_TAKEN'])==1)
    {
            $row['TIME_TAKEN']='0'.$row['TIME_TAKEN'];
    }
    $dis2 = $dis2.'<tr>
    <td>'.$i.'</td>
    <td>'.$row['NAME'].'</td>
    <td>'.$row['USN'].'</td>
    <td>00:'.$row['TIME_TAKEN'].'</td>
    <td>'.$row['SCORE'].'/5</td>
</tr>';
$i++;
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
        h3 {
            color: white;
            padding: 15px 0px 15px 50px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .leader_container {
            border: 1px solid #3c4a76;
            display: flex;
            border-radius: 10px;
            max-height: 50vh;
        }

        .table th {
            background-color: #222B45;
            position: sticky;
            top: 0;
        }

        .table {
            margin: 0;
            padding: 0;
        }

        .table td {
            background-color: transparent;
        }

        .table th,
        .table td {
            color: white;
            text-align: center;
            padding: 1%;
            border: none;
        }

        .table td {
            padding: 2%;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        .lb {
            background-image: linear-gradient(90deg, #275e69 20%, #93dfef 80%);
            padding: 0.7% 5% 0.7% 5%;
            margin-top: 0 !important;
        }

        .nav_item:hover {
            cursor: pointer;
            transform: scale(1.08);
            transition-duration: 1s;
        }

        a,a:hover
    {
        text-decoration:none;
        color:white;
    }
    div.top_div
    {
        width:70%;
    }
    @media only screen and (max-width: 720px)
    {
        div.top_div
        {
            width:90%;
        }
    }

    @media only screen and (max-width: 390px)
    {
        div.top_div
        {
            width:97%;
        }
    }
    </style>
</head>

<body style="background-color:#101426;font-family: 'DM Sans',sans-serif">
    <div class="container-fluid">
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
                    <?php
                    if(strlen(intval($usn))!=10)
                    {
                        echo '<div class="nav_item"><span><a href="home.php">Home</a></span></div>
                        <div class="nav_item"><span><a href="results.php">Your Performance</a></span></div>
                        <div class="nav_item"><span><a href="logout.php">Logout</a></span></div>';
                    }
                    else 
                    {
                        echo '<div class="nav_item"><span><a href="home.php">Home</a></span></div>
                        <div class="nav_item"><span><a href="logout.php">Logout</a></span></div>';
                    }
                    ?>
                    

                </div>
            </div>
            <h4 style="font-size: x-large;color:white;font-weight: 400;position: sticky;
        z-index: 5;" class="mt-4 lb">Leaderboard</h4>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding: 0;">
                
                <div style="display: flex;flex-direction: column;align-items: center;">
                    <div class="top_div">
                        <div class="mt-3">
                            <div class="mt-4">
                                <p
                                    style="font-size:large;color:white;border:1px solid #93dfef;display: inline-block;padding:10px;border-radius: 10px;">
                                    COMPUTER NETWORKS</p>
                                <div class="leader_container overflow-auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Name</th>
                                                <th>USN</th>
                                                <th>Time Taken</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lead_tbody_1">
                                            <?php echo $dis ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="mt-5">
                                <p
                                    style="font-size:large;color:white;border:1px solid #93dfef;display: inline-block;padding:10px;border-radius: 10px;">
                                    OPERATING SYSTEMS</p>
                                <div class="leader_container overflow-auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Name</th>
                                                <th>USN</th>
                                                <th>Time Taken</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lead_tbody_2">
                                           <?php echo $dis1; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                            <div class="mt-5 mb-4">
                                <p
                                    style="font-size:large;color:white;border:1px solid #93dfef;display: inline-block;padding:10px;border-radius: 10px;">
                                    DATABASE MANAGEMENT SYSTEMS</p>
                                <div class="leader_container overflow-auto">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Name</th>
                                                <th>USN</th>
                                                <th>Time Taken</th>
                                                <th>Score</th>
                                            </tr>
                                        </thead>
                                        <tbody id="lead_tbody_3">
                                        <?php echo $dis2; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>