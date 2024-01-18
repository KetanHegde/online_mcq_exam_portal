<?php
session_start();
session_unset();
session_destroy();
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST"){
$sql = "USE MCQ";
$conn->query($sql);
$usn = $_POST['inpUSN'];
$check = "SELECT * FROM USERS WHERE USN = '$usn'";
$result = $conn->query($check);

if($result->num_rows>0)
{
  $_SESSION['note'] = "You already have an account. Please Log in";
  $_SESSION['flag'] = 0;
  header("Location: ../index.php");

}
else
{
    $_SESSION['note'] = "Successfully signed up. You can Log in to your account";
    $_SESSION['flag'] = 1;
    header("Location: ../index.php");
}
}
?>