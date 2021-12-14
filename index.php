<?php

include 'partials/_bbconnect.php';
$login = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE Username = '$username' AND Password1 = '$password' ";

    $result = mysqli_query($conn, $sql);

    $row = mysqli_num_rows($result);


    if ($row == 1) {

        // $login = true;

        session_start();

        $_SESSION['username'] = $username;

        header("location:home.php");

        exit();
    } else {
        $Error = "Invalid Credentials !";
    }
}


?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Log In | Timeliner</title>
</head>

<body style="background-color: #f2f2f2;">


    <?php

    // if ($login) {
    //   echo ' 
    //       <div class="alert alert-success alert-dismissible fade show" role="alert">
    //           <strong>Sucess ! </strong> You are logged in !
    //           <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //       </div> ';
    // }
    if (isset($Error)) {


        echo ' 
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error ! </strong> Password do not match ! Please try again !!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
        unset($Error);
    }

    ?>





    <br>
    <br>

    <div class="container shadow p-3 mb-0 bg-white " style="align-items: center; display :flex; flex-direction :column ; width : 350px; padding : 30px;  border-top-left-radius : 40px;border-top-right-radius : 40px;  ">



        <h1 class="text-center" style="background: linear-gradient(to right, #753a88, #cc2b5e 100%);
	-webkit-background-clip: text;
	-webkit-text-fill-color: transparent; ">
            Timeliner
        </h1>

        <br>

        <form action="/loginsystem/index.php" method="post">

            <div class="mb-3 col-md-12 ">
                <label for="username" class="form-label ">Username</label>
                <input class="form-control  " id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3 col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>

            <center>
                <button type="submit" class="btn col-md-12 mb-3 " style="background: #cc2b5e; 
                      background: -webkit-linear-gradient(to right, #753a88, #cc2b5e);  
                      background: linear-gradient(to right, #753a88, #cc2b5e); color : #fff;">
                    Log In
                </button>
            </center>
        </form>

    </div>
    <div class="container shadow p-3  bg-white " style="align-items: center; display :flex; flex-direction :column ; width : 350px; border-bottom-left-radius : 40px;border-bottom-right-radius : 40px;  ">

        Don't have an account? <a href="signup.php">Sign up</a>

    </div>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>