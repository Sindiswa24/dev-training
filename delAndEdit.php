<?php
// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
// error_reporting(-1);
include 'db_connection.php';

function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

 if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $new_name = sanitise_input($_POST['new_name']);
        $new_surname = sanitise_input($_POST['new_surname']);
        $new_dob = sanitise_input($_POST['new_dob']);
        $new_email = sanitise_input($_POST['new_email']);
        $new_age = sanitise_input($_POST['new_age']);

        if (!empty($id)) {
            $stmt = $conn->prepare("UPDATE person SET FirstName=?, Surname=?, DateOfBirth=?, EmailAddress=?, Age=? WHERE id=?");
            $stmt->bind_param("ssssii", $new_name, $new_surname, $new_dob, $new_email, $new_age, $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                $response['status'] = 'success';
                $response['message'] = 'Person details successfully updated';
            } else {
                $response['message'] = 'Could not update person';
                error_log("Error in editPerson: " . mysqli_error($conn));    
            }

            $stmt->close();
        }
    }
    echo json_encode($response);




    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $sql_delete = "DELETE FROM person WHERE id = $id";
        $sql_delete_query = mysqli_query($conn, $sql_delete);

        if ($sql_delete_query) {
        } else {
            echo 'Could not delete person';
        }
    }


    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        if (isset($_GET['action']) && $_GET['action'] == 'deleteAll') {
            $sql = "DELETE FROM person";
            $result = mysqli_query($conn, $sql);
    
            if ($result) {
                $response = array('status' => 'success', 'message' => 'All people deleted successfully');
            } else {
                $response = array('status' => 'error', 'message' => 'Failed to delete all people');
            }
    
            echo json_encode($response);
            exit;
        }
    }
?>