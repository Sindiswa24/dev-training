<?php
    include 'db_connection.php';

    $startTime = microtime(true);
    error_log("Script started at " . date('Y-m-d H:i:s', $startTime));


    function sanitise_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    class Person{
        public static function createPerson($conn){
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = sanitise_input($_POST['firstname']);
                $surname = sanitise_input($_POST['surname']);
                $dob = sanitise_input($_POST['dob']);
                $email = sanitise_input($_POST['email']);
                $age = sanitise_input($_POST['age']);
        
                $stmt = $conn->prepare("INSERT INTO person (FirstName, Surname, DateOfBirth, EmailAddress, Age) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssi", $name, $surname, $dob, $email, $age);
                $stmt->execute();
        
                if ($stmt->affected_rows > 0) {
                    echo 'Successfully created a person';
                } else {
                    echo "Failed to create a person";
                }

                $stmt->close();
            }

        }


        public static function loadAllPeople($conn){
            $html = '';
            
            $sql_loadAll = "SELECT * FROM person";
            $sql_loadAll_query = mysqli_query($conn, $sql_loadAll);

            while($row = mysqli_fetch_assoc($sql_loadAll_query)){
                $getName = $row['FirstName'];
                $getSurname = $row['Surname'];
                $getDob = $row['DateOfBirth'];
                $getEmail = $row['EmailAddress'];
                $getAge = $row['Age'];


                $html .= '<tr>';
                $html .= '<td>' . $getName . '</td>';
                $html .= '<td>' . $getSurname . '</td>';
                $html .= '<td>' . $getEmail . '</td>';
                $html .= '<td>' . $getDob . '</td>';
                $html .= '<td>' . $getAge . '</td>';
                $html .= '<td><a href="task_7edit.php?id=' . $row['id'] . '"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a></td>';
                $html .= '<td><a href="#" onclick="deletePersonConfirmation(' . $row['id'] . ')"><i class="fa-solid fa-trash fs-5"></i></a></td>';
                $html .= '</tr>';
            }
            echo $html;
        }

        public function loadPerson($conn, $id){
            $id = $_GET['id'];
            $sql_person = "SELECT * FROM person WHERE id = $id LIMIT 1";
            $sql_person_query = mysqli_query($conn, $sql_person);
            $row = mysqli_fetch_assoc($sql_person_query);

            return $row;
        }



        // public function deletePerson($conn) {
        //     if (isset($_GET['delete']) && isset($_GET['id'])) {
        //         $id = $_GET['id'];
        //         $sql_delete = "DELETE FROM person WHERE id = $id";
        //         $sql_delete_query = mysqli_query($conn, $sql_delete);
    
        //         if ($sql_delete_query) {
        //             // You may choose to return a success message or nothing
                    
        //         } else {
        //             // You may choose to return an error message or nothing
        //             echo 'Could not delete person';
        //         }
        //     }
        // }



        // public function editPerson($conn) {
        //     if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //         if (isset($_POST['edit'])){
        //             $id = isset($_POST['id']) ? $_POST['id'] : null;
        //             $new_name = sanitise_input($_POST['new_name']);
        //             $new_surname = sanitise_input($_POST['new_surname']);
        //             $new_dob = sanitise_input($_POST['new_dob']);
        //             $new_email = sanitise_input($_POST['new_email']);
        //             $new_age = sanitise_input($_POST['new_age']);
            
        //             if (!empty($id)) {
        //                 $stmt = $conn->prepare("UPDATE person SET FirstName=?, Surname=?, DateOfBirth=?, EmailAddress=?, Age=? WHERE id=?");
        //                 $stmt->bind_param("ssssii", $new_name, $new_surname, $new_dob, $new_email, $new_age, $id);
        //                 $stmt->execute();
            
        //                 if ($stmt->affected_rows > 0) {
        //                     $row['FirstName'] = $new_name;
        //                     $row['Surname'] = $new_surname;
        //                     $row['EmailAddress'] = $new_email;
        //                     $row['DateOfBirth'] = $new_dob;
        //                     $row['Age'] = $new_age;

        //                     echo "Edited person successfully";
        //                 } else {
        //                     echo "Could not edit person";
        //                     error_log("Error in editPerson: " . mysqli_error($conn));
        //                 }
            
        //                 $stmt->close();
        //             }
        //         }
        //     }
        // }
        
        

    }

$person = new Person();
$person->createPerson($conn);
// $person->deletePerson($conn);
// $person->editPerson($conn);

$endTime = microtime(true);
error_log("Script ended at " . date('Y-m-d H:i:s', $endTime));

$executionTime = $endTime - $startTime;
error_log("Script execution time: " . number_format($executionTime, 4) . " seconds");
// phpinfo();
?>