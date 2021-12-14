<?php

include 'partials/_bbconnect.php';

session_start();

if (!isset($_SESSION['username'])) {
    header("location:index.php");
}

// connected to data base by _bbconnect.php . Then started session. 
// Then checked if username is set that is checked if user is logged in.
// If user is not logged in redirected it to login page directly.



$username = $_SESSION['username'];
echo " <h1> Welcome $username </h1> ";

// recovered username from session and welcomed user !

?>

<!-- HTML Started -->

<!DOCTYPE html>
<ht lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
            crossorigin="anonymous" />
        <!-- data table css -->
        <link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

        <title>Timeliner</title>
    </head>

    <!--Body starts from here  -->

    <body style="background-color:#f3f3f3;">

        <!-- Edit Modal -->

        <div class="modal fade" id="editModal" name="editModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModal">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!-- modal body -->

                        <div class="container p-3" style="width:450px;">
                            <h2>Edit your Notes here</h2>
                            <br>

                            <form action="/loginsystem/edit.php" method="post">

                                <input type="hidden" name="snoEdit" id="snoEdit">

                                <div class="mb-3">
                                    <label for="tittle" class="form-label"><b>Note Tittle</b></label>
                                    <input type="text" class="form-control" id="title" name="title" placeholder="title"
                                        aria-describedby="emailHelp" />

                                </div>
                                <div class="mb-3">
                                    <label for="details" class="form-label"><b>Note Details</b></label>
                                    <textarea class="form-control" id="details" name="details" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="date" class="form-label"><b>Deadline</b></label>
                                    <input type="date" class="form-control" id="date" name="date" placeholder="date" />

                                </div>

                                <center>
                                    <button type="submit" class="btn col-md-12" style="background: #cc2b5e; 
                                         background: -webkit-linear-gradient(to right, #753a88, #cc2b5e);  
                                         background: linear-gradient(to right, #fc00ff, #00dbde); color : black;
                                         "> <b>Save Changes </b>
                                    </button>
                                </center>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <!-- delete modal -->

        <form action="/loginsystem/delete.php" method="post">

            <div class="modal" id="deleteModal" name="deleteModal" tabindex="-1" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Note</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="snoDelete" id="snoDelete">
                            <p><b>Are you sure you wanna delete this note ?</b></p>
                        </div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
                            <button type="submit" class="btn btn-primary col-md-12">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </form> 

            <!-- heading -->

            <div class="container shadow p-3 my-3 bg-white "
                style="align-items: center; display :flex; flex-direction :column ; width : 350px; border-radius : 30px; ">

                <h1 class="text-center" style="background: linear-gradient(to right, #753a88, #cc2b5e 100%);
                            -webkit-background-clip: text;
                            -webkit-text-fill-color: transparent; ">
                    Timeliner
                </h1>
            </div>

            <!-- Form -->

            <!-- form php -->

            <div class="container p-3" style="width:700px;">
                <h2>Add your Notes here</h2>
                <br>

                <form action="/loginsystem/new_note.php" method="post">

                    <div class="mb-3">
                        <label for="tittle" class="form-label"><b>Note Tittle</b></label>
                        <input type="text" class="form-control" id="title" name="title" placeholder="title">
                    </div>

                    <div class="mb-3">
                        <label for="details" class="form-label"><b>Note Details</b></label>
                        <textarea class="form-control" id="details" name="details" rows="3"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="date" class="form-label"><b>Deadline</b></label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="date">
                    </div>

                    <center>
                        <button type="submit" class="btn col-md-12" style="background: #cc2b5e; 
                            background: -webkit-linear-gradient(to right, #753a88, #cc2b5e);  
                            background: linear-gradient(to right, #fc00ff, #00dbde); color : black;
                            "> <b>Submit</b>
                        </button>
                    </center>

                </form>
                
            </div>

            <!-- table -->

            <div class="container">

                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">S no.</th>
                            <th scope="col">Tittle</th>
                            <th scope="col">Details</th>
                            <th scope="col">Deadline</th>
                            <th scope="col">Edit/Delete</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php

                        $sql = "SELECT * FROM `note` WHERE  Username = '$username'";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo " <tr>
                            <td scope= 'row'> " . $row['Sno.'] . " </td>
                            <td> " . $row['tittle'] . " </td>
                            <td> " . $row['details'] . "</td>
                            <td> " . $row['date'] . "</td> 

                            <!-- edit  button -->
                            <td>
                                <button type='submit' class='btn col-md-3 edit-button'  style='background: #cc2b5e; 
                                     background: -webkit-linear-gradient(to right, #753a88, #cc2b5e);  
                                     background: linear-gradient(to right, #00c9ff, #92fe9d); color : black;  width : 100px;
                                    '><b>Edit</b>
                                </button>

                            <!-- delete button -->

                                 <button type='submit' class='btn col-md-3 my-1 delete-button'  style='background: #cc2b5e;
                                         background: -webkit-linear-gradient(to right, #753a88, #cc2b5e); 
                                         background: linear-gradient(to right, #00c9ff, #92fe9d); color : black;  width : 100px;
                                         '> <b> Delete</b> 
                                </button>
                            </td>
                
                         </tr> ";
                        }

                        ?>
                    </tbody>

                </table>

            </div>



            <!-- logout button -->
            <a href="logout.php" class="btn btn-dark btn-lg active" role="button" aria-pressed="true">Log Out</a>

            <!-- Optional JavaScript; choose one of the two! -->

            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
                crossorigin="anonymous">
            </script>

            <!-- Option 2: Separate Popper and Bootstrap JS -->

            <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"
                integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB"
                crossorigin="anonymous">
            </script>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
                integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
                crossorigin="anonymous">
            </script>


            <!-- data table jquerry -->
            <script src="https://code.jquery.com/jquery-3.6.0.js"
                integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
            <!-- data table js -->
            <script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js">
            </script>

            <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });

            // This script is used to handle data table 

            editButtons = document.getElementsByClassName("edit-button");


            length = editButtons.length;

            for (i = 0; i < length; i++) {

                editButtons[i].addEventListener("click", function(e) {
                    $('#editModal').modal('show');

                    var snoEdit = e.target.parentElement.parentElement.parentElement.children[0].innerText;


                    var title = e.target.parentElement.parentElement.parentElement.children[1].innerText;


                    var details = e.target.parentElement.parentElement.parentElement.children[2].innerText;


                    var deadline = e.target.parentElement.parentElement.parentElement.children[3].innerText;




                    document.getElementById("snoEdit").value = snoEdit;

                    document.getElementById("title").value = title;

                    document.getElementById("details").value = details;

                    document.getElementById("date").value = deadline;

                });
            }

            // This script is used to handle edit modal.
            // 

            deleteButtons = document.getElementsByClassName("delete-button");
            length = deleteButtons.length;

            for (i = 0; i < length; i++) {
                deleteButtons[i].addEventListener("click", function(e) {

                    $('#deleteModal').modal('show');


                    var snoDelete = e.target.parentElement.parentElement.parentElement.children[0].innerText;

                    document.getElementById("snoDelete").value = snoDelete;

                });
            }
            </script>

            <!-- This script is used to handle delete notes option -->

    </body>

</ht>