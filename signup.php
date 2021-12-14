<?php

$showAlert = false;
$Error = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    include 'partials/_bbconnect.php';


    $username = $_POST["username"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];

    $existSql = "SELECT * FROM `users` WHERE username = '$username' ";
    $result = mysqli_query($conn, $existSql);

    $num = mysqli_num_rows($result);

    if ($num > 0) {
        $Error = " Sorry, username already taken !";
    } else {

        if (($password == $cpassword)) {
            $sql = "INSERT INTO `users` ( `Username`, `Password1`, `Dt`) VALUES ( '$username', '$password', current_timestamp())";
            $result = mysqli_query($conn, $sql);


            if ($result) {
                $showAlert = true;
            }
        } else {
            $Error = " Passwords do not match ! please try again !!";
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Sign Up at Timeliner</title>
    
</head>


<!-- body started from herer -->


<body style="background-color: #f2f2f2;">

    <?php

    if ($showAlert == true) {
        echo ' 
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Congratulations ! </strong> Your account has been created !!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
    }
    if ($Error == true) {
        echo ' 
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Error ! </strong>  ' . $Error . ' 
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div> ';
    }

    ?>

<!-- php ends here -->
    <br>
    <br>


    <!-- heading Timeliner -->

    <div class="container shadow p-3 bg-white "
        style="align-items: center; display :flex; flex-direction :column ; width : 350px;  border-top-left-radius : 30px;border-top-right-radius : 30px; ">

        <h1 class="text-center" style="background: linear-gradient(to right, #753a88, #cc2b5e 100%);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent; ">
            Timeliner
        </h1>


    </div>

    <!-- heading create new account -->

    <div class="container shadow p-3  bg-white "
        style="align-items: center; display :flex; flex-direction :column ; width : 350px; border-bottom-left-radius : 30px;border-bottom-right-radius : 30px; ">

        <h2 class="text-center">Create a new account</h2>


        <!-- form started -->

        <form action="/loginsystem/signup.php" method="post">

            <div class="mb-3 col-md-12 ">
                <label for="username" class="form-label">Username</label>
                <input class="form-control" id="username" name="username" aria-describedby="emailHelp">

            </div>
            <div class="mb-3 col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-12">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <div id="emailHelp" class="form-text">Make sure you type same password !</div>
            </div>

            <center>
                <button type="submit" class="btn col-md-12" style="background: #cc2b5e; 
                    background: -webkit-linear-gradient(to right, #753a88, #cc2b5e);  
                    background: linear-gradient(to right, #753a88, #cc2b5e); color : #fff;
                    ">Sign Up
                </button>
            </center>
        </form>
    </div>

    <div class="container shadow p-3 my-2 bg-white "
        style="align-items: center; display :flex; flex-direction :column ; width : 350px; border-radius : 30px; ">

        Have an account? <a href="index.php">Log in</a>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>