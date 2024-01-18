
<?php 
    session_start();
    include "db_conn.php";
    
    if(!isset($_SESSION['usn']))
    {
        $_SESSION['login_note'] = "Please Login to continue";
        header("Location: index.php");
    }

    if($_SERVER["REQUEST_METHOD"] === "POST")
    {
        $sid = $_POST["SUB"];
        $sq = "SELECT QUESTION,O1,O2,O3,O4,ANSWER FROM QUESTIONS Q,OPTIONS O WHERE SID = '$sid' AND Q.QID = O.QID  ORDER BY RAND () LIMIT 5";
        $res = $conn->query($sq);
        
        $_SESSION['sid'] = $sid;
        $ret=array();
        
        while($row = $res -> fetch_assoc())
        {
            array_push($ret,$row['QUESTION'],$row['O1'],$row['O2'],$row['O3'],$row['O4'],$row['ANSWER']);
        }
        $_SESSION['res'] = $ret;
        header("Location: take_test.php");
    }
    else
    {
        header("Location: home.php");
    }
?>