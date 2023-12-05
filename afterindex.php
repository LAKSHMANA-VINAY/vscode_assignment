<?php
include "connect.php";
if((isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['userType'])))
{
    function clear($data)
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
$email=clear($_POST['email']);
$password=clear($_POST['password']);
if($_POST['userType'])
{
    $sql="select username,email,password from vs_users where email='$email'";
    $result=$conn->query($sql);
    if(mysqli_num_rows($result)===1)
    {
        $row=mysqli_fetch_assoc($result);
        if($row['email']===$email && password_verify($password,$row['password']))
        {
            header("Location:doctor.php?email='$email'");
            exit();
        }
        else{
            header("Location:index.html?");
            exit();
        }
    }
    else{
        header("Location:index.html?");
        exit();
    }
}
}
$conn->close();
?>