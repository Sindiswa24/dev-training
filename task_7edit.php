<?php
// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(-1);
include "db_connection.php";
include "task_7.php"; 
// include 'delAndEdit.php';

$id = isset($_GET['id']);

$person = new Person();
// $person->editPerson($conn);
$row = $person->loadPerson($conn, $id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>Task 7</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <style>
        form{
            border: 0.5px solid black;
            border-radius: 5px;
            padding: 5px;
            margin-top: 40px;
            text-align: center;
        }
        h3{
            text-align: center;
            color: rgb(89, 89, 246);
            margin-bottom: 20px;
        }
        label{
            font-size: 1.3rem;
        }
        input{
            border: 0.5px solid rgb(122, 120, 120);
            border-radius: 5px;
            padding: 3px;
            text-align: center;
        }
        #button{
            background-color: rgb(89, 89, 246);
            color: white;
            font-size: 1.2rem;
            padding: 5px;
            transform: scale(1);
            transition: ease 0.9s;
        }
        #button:hover{
            transform: scale(1.1);
        }
        button{
            margin-top: 30px;
            border: none;
            border-radius: 5px;
            padding: 5px;
            color: white;
            background-color: rgb(89, 89, 246);
            transform: scale(1);
            transition: ease 0.9s;
        }
        button:hover{
            transform: scale(1.1);
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-4">
                        <a href="task_7table.php"><button>Go Back</button></a>
                        <form action="delAndEdit.php" method="post" onsubmit="return editPersonConfirmation()">
                            <h3>Update Person</h3>
                            <label for="name">First Name </label>
                            <br>
                            <input id="new_name" type="text" name="new_name" value="<?php echo $row['FirstName'] ?>"><br>
                            <br>
                            <label for="surname">Surname </label>
                            <br>
                            <input id="new_surname" type="text" name="new_surname" value="<?php echo $row['Surname'] ?>"><br>
                            <br>
                            <label for="email">Email Address </label>
                            <br>
                            <input id="new_email" type="email" name="new_email" value="<?php echo $row['EmailAddress'] ?>"><br>
                            <br>
                            <label for="datebirth">Date of Birth </label>
                            <br>
                            <input id="new_dob" type="date" name="new_dob" value="<?php echo $row['DateOfBirth'] ?>"><br>
                            <br>
                            <label for="age">Age </label>
                            <br>
                            <input id="new_age" type="number" name="new_age" value="<?php echo $row['Age'] ?>"><br>
                            <br>
                            <input id="new_id" type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <input id="button" type="submit"  name="update" placeholder="Update">
                        </form>
                    </div>
                    <div class="col-md-4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Birthday script to grey out future dates
        var today = new Date().toISOString().split('T')[0];
        document.getElementById('new_dob').setAttribute('max', today);



        // to post data to the php script
        $(document).ready(function () {
        function editPersonConfirmation() {
            var id = $('input[name="id"]').val();
            var new_name = $('#new_name').val();
            var new_surname = $('#new_surname').val();
            var new_email = $('#new_email').val();
            var new_dob = $('#new_dob').val();
            var new_age = $('#new_age').val();

            $.ajax({
                url: 'delAndEdit.php',
                type: 'POST',
                data: {
                    id: id,
                    new_name: new_name,
                    new_surname: new_surname,
                    new_email: new_email,
                    new_dob: new_dob,
                    new_age: new_age,
                },
                dataType: 'json', // Expect JSON response from the server
                success: function (response) {
                    console.log(response);

                    if (response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Done!',
                            text: response.message,
                        }).then(() => {
                            window.location.href = 'task_7table.php';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'An error occurred during the AJAX request',
                    });
                }
            });

            return false; // Prevent the form from submitting normally
        }

        // Attach the function to the form submission
        $('form').submit(editPersonConfirmation);
    });
    </script>
</body>
</html>