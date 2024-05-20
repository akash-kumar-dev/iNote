<?php

// Connecting to the Database
$servername = "localhost";
$username = "root";
$password = "11";
$database = "iNote";

// Create a connection
$conn = mysqli_connect($servername, $username, $password, $database);

// // Die if connection was not successful
// if (!$conn) {
//     die("Sorry we failed to connect: " . mysqli_connect_error());
// } else {
//     echo "Connection was successful<br>";
// }

// -----------------------------------------------
// defining schema

// $sql = "CREATE TABLE iNote (
//     sno INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
//     title VARCHAR(100) NOT NULL,
//     description VARCHAR(500) NOT NULL
// )";

// $result = mysqli_query($conn, $sql);

// // Check for the table creation success
// if ($result) {
//     echo "The table was created successfully!<br>";
// } else {
//     echo "The table was not created successfully because of this error ---> " . mysqli_error($conn);
// }
// -----------------------------------------------



// -----------------------------------------------
// adding sample records

// $title = "Title 2";
// $description = "description 2";

// $sql = "INSERT INTO iNote (title, description) VALUES ('$title', '$description')";

// $result = mysqli_query($conn, $sql);

// // Add a new trip to the Trip table in the database
// if ($result) {
//     echo "The record has been inserted successfully successfully!<br>";
// } else {
//     echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
// }

// -----------------------------------------------

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['snoEdit'])) {

        $sno = $_POST["snoEdit"];
        $title = $_POST['titleEdit'];
        $description = $_POST['descriptionEdit'];


        $sql = "UPDATE iNote SET title = '$title', description = '$description' WHERE iNote.sno = $sno";

        $result = mysqli_query($conn, $sql);
    } else {
        $alert = 0;
        $title = $_POST['title'];
        $description = $_POST['description'];


        $sql = "INSERT INTO iNote (title, description) VALUES ('$title', '$description')";

        $result = mysqli_query($conn, $sql);

        if ($result) {
            $alert = 1;
        } else {
            $alert = 2;
        }
    }

}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>iNote</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
</head>

<body>

    <!-- Edit Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editModal">
        Edit
    </button> -->

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/" method="POST">
                        <input type="hidden" name="snoEdit" id="snoEdit">
                        <div class="row mb-3">
                            <label for="title" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="titleEdit" id="titleEdit">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="description" class="col-sm-2 col-form-label">Description</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control" name="descriptionEdit" id="descriptionEdit" rows="3"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Note</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">iNote</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">About us</a>
                    </li>
                </ul>
                <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <?php
        if ($alert == 1) {
            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!!</strong>Your Note has been added successfully
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        } elseif ($alert == 2) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>Warning!</strong> Something went wrong.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        }
        ?>
    </div>

    <div class="container my-4">
        <h2>Add Note</h2>
        <form action="/" method="POST">
            <div class="row mb-3">
                <label for="title" class="col-sm-2 col-form-label">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="title" id="title">
                </div>
            </div>
            <div class="row mb-3">
                <label for="description" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-10">
                    <textarea type="text" class="form-control" name="description" id="description" rows="3"></textarea>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Note</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <div class="container my-4">
        <table class="table table-hover display my-4" id="myTable">
            <thead>
                <tr>
                    <th scope="col">S.No.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM iNote";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $count = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                        <th scope='row'>" . $count . "</th>
                        <td>" . $row['title'] . "</td>
                        <td>" . $row['description'] . "</td>
                        <td><button class='edit btn btn-sm btn-primary' id=" . $row['sno'] . ">Edit</button>&nbsp;<a href='#'>Delete</a></td>
                    </tr>
                        ";
                        $count += 1;
                    }
                }

                ?>

            </tbody>
        </table>
    </div><br>
    <hr>

    <!-- JQuey first, then dataTables js, then bootstrap js -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
    <script>
        edits = document.getElementsByClassName('edit');
        Array.from(edits).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("Edit ", e.target);
                tr = e.target.parentNode.parentNode;
                title = tr.getElementsByTagName("td")[0].innerText;
                description = tr.getElementsByTagName("td")[1].innerText;
                console.log(title, description);
                titleEdit.value = title;
                descriptionEdit.value = description;
                snoEdit.value = e.target.id;
                console.log(e.target.id);
                $('#editModal').modal('toggle');
            });
        });
    </script>
</body>

</html>