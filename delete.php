<?php

include 'partials/_bbconnect.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $sno = $_POST['snoDelete'];

   
    $sql = "DELETE FROM `note` WHERE `Sno.` = '$sno' ";

    $result = mysqli_query($conn, $sql);

    header("location:home.php");

    exit();
}
