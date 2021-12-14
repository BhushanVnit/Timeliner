<?php

include 'partials/_bbconnect.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {

   $snoEdit = $_POST["snoEdit"];

    $title = $_POST["title"];
    $details = $_POST["details"];
    $date = $_POST["date"];



    $sql = "UPDATE `note` SET `tittle` ='$title' , `details`='$details' , `date`='$date'  WHERE `Sno.` = '$snoEdit' ";

    $result = mysqli_query($conn,$sql);

    if ($result)
    {
        header("location:home.php");

        exit();
    }
    else
    {
        echo"Error !!";
    }
}
?>