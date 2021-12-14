<?php

include 'partials/_bbconnect.php';
session_start();

 $username = $_SESSION['username'];


if($_SERVER["REQUEST_METHOD"] == "POST")                
{

   $title  = $_POST["title"];

   $details = $_POST["details"];

   $date    = $_POST["date"];

   echo "Bhushan is checking !";

   $sql = "INSERT INTO `note` (`Username`,`tittle`, `details`, `date`) VALUES ( '$username', '$title', '$details', '$date')";
   $result = mysqli_query($conn,$sql);

   if ($result)
   {
       header("location:home.php");
       echo ' <div class="alert  alert-dismissible fade show" role="alert">
           <strong>Done! </strong> Your note has been addeed successfully !!
           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
           <span aria-hidden="true">&times;</span>
           </button>
            </div> ';
   } 
   else
   {
       echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                 <strong>Error !</strong> Sorry we are facing a problem. Please try again later.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
           </div>';
   }
}


// Here I recovered all info entered into the form and insert it into the database using insert query ! 
// Also set simple alert if successfully inserted and danger alert if there is issue !


?>