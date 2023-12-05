<?php
include "connect.php";
session_start();
if(isset($_POST['submit']))
{
    function clear($data)
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    $type=clear($_POST['contactType']);
    $slot=clear($_POST['slot']);
    $date=clear($_POST['date']);

    $patient=$_POST['patientName'];
    $age=$_POST['age'];
    $gender=$_POST['gender'];
    $phone=$_POST['phoneNumber'];
    $email=rawurlencode(str_replace("'", "", $_SESSION['email']));
    $email = urldecode($email);


    $dateTime = DateTime::createFromFormat('D, M d', $date);
    $formattedDate = $dateTime->format('Y-m-d');

    $sql = "INSERT INTO vs_booking (email, patient, age, gender, phone, date, slot, type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("ssisssss", $email, $patient, $age, $gender, $phone, $formattedDate, $slot, $type);
    
        $result = $stmt->execute();
    
        if ($result) {
            echo '<script>alert("Successfully slot booked");</script>';
            echo '<script>window.location.href = "doctor.php";</script>';
        } else {
            echo '<script>alert("Something went wrong! Please try again.");</script>';
            echo '<script>window.location.href = "doctor.php";</script>';
        }
    
        $stmt->close();
    } else {
        echo '<script>alert("Statement preparation failed.");</script>';
        echo '<script>window.location.href = "doctor.php";</script>';
    }
    
}
?>
