<?php
// ini_set('display_startup_errors', 1);
// ini_set('display_errors', 1);
error_reporting(-1);

$startTime = microtime(true);
error_log("Script started at " . date('Y-m-d H:i:s', $startTime));

include 'db_connection.php';

class Person
{
    public static function createPerson($conn)
    {
        for ($i = 1; $i <= 10; $i++) {
            $firstName = "Person" . $i;
            $surname = "Surname" . $i;
            $startDate = strtotime('1980-01-01');
            $endDate = strtotime('2000-12-31');
            $randomTimestamp = mt_rand($startDate, $endDate);
            $dateofbirth = date("Y-m-d", $randomTimestamp);
            $email = "person" . $i . "@random.com";
            $age = rand(18, 60);

            $sql = "INSERT INTO person (FirstName, Surname, DateOfBirth, EmailAddress, Age) 
                    VALUES ('$firstName','$surname','$dateofbirth','$email','$age')";
            $sql_query = mysqli_query($conn, $sql);

            if (!$sql_query) {
                echo 'Error occurred while creating people.';
                exit;
            }
        }

        echo 'People created successfully.';
    }
}

if (isset($_POST['action']) && $_POST['action'] == 'generate') {
    $person = new Person();
    $person->createPerson($conn);
}


$endTime = microtime(true);
error_log("Script ended at " . date('Y-m-d H:i:s', $endTime));

$executionTime = $endTime - $startTime;
error_log("Script execution time: " . number_format($executionTime, 4) . " seconds");

// echo '<script>';
// echo 'console.log("Script started at ' . date('Y-m-d H:i:s', $startTime) . '");';
// echo 'console.log("Script ended at ' . date('Y-m-d H:i:s', $endTime) . '");';
// echo 'console.log("Script execution time: ' . number_format($executionTime, 4) . ' seconds");';
// echo '</script>';
?>