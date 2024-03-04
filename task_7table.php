<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 7</title>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        button {
            margin-top: 30px;
            border: none;
            border-radius: 5px;
            padding: 5px;
            background-color: rgb(89, 89, 246);
            color: white;
            transform: scale(1);
            transition: ease 0.9s;
        }

        button:hover {
            transform: scale(1.1);
        }

        .buttons {
            display: flex;
            justify-content: space-between;
        }

        table {
            margin-top: 40px;
        }

        i {
            color: black;
            transform: scale(1);
            transition: ease .3s;
        }

        i:hover {
            transform: scale(1.1);
        }
    </style>

<script>
    $(document).ready(function () {
        $("#deleteAll").click(function () {
            Swal.fire({
                title: 'Are you sure?',
                text: 'This action will delete all people. Are you sure you want to proceed?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete all'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delAndEdit.php',
                        type: 'GET',
                        data: {
                            action: 'deleteAll'
                        },
                        success: function (response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: response.message,
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function () {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Failed to delete all people',
                            });
                        }
                    });
                }
            });
        });
    });
</script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-2">
                    </div>
                    <div class="col-md-8">
                        <div class="buttons">
                            <a href="task_7.html"><button>Add New Person</button></a>
                            <button id="deleteAll">Delete All People</button>
                        </div>
                        <table class="table table-hover text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>First Name</th>
                                    <th>Surname</th>
                                    <th>Email Address</th>
                                    <th>D.O.B</th>
                                    <th>Age</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include "db_connection.php";
                                include "task_7.php";

                                $person = new Person();
                                $person->loadAllPeople($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <script>
        function deletePersonConfirmation(id) {
            Swal.fire({
                title: 'Delete?',
                text: 'Are you sure you want to delete this person?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Delete'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delAndEdit.php',
                        type: 'GET',
                        data: {
                            id: id
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted!',
                                text: 'Person deleted successfully',
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function() {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Could not delete person',
                            });
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'info',
                        title: 'Canceled',
                        text: 'Person deletion canceled',
                    });
                }
            });
        }



        function editPersonConfirmation(id) {
            $.ajax({
                url: 'task_7.php',
                type: 'POST',
                data: {
                    id: id
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Done!',
                        text: 'Person details successfully updated',
                    }).then(() => {
                        location.reload();
                    });
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Could not update person',
                    });
                }
            });
        }
    </script>

</body>

</html>