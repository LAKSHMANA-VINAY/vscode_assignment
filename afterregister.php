<?php
include "connect.php";
if((isset($_POST['email'])&&isset($_POST['name'])&&isset($_POST['password'])))
{
    function clear($data)
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }
    $username=clear($_POST['name']);
    $email=clear($_POST['email']);
    $password=password_hash(clear($_POST['password']),PASSWORD_DEFAULT);
    $sql="select email from teacher where email='$email'";
    $result=$conn->query($sql);
    if(mysqli_num_rows($result)===1)
    {
        header("Location:index.html?");
        exit();
    }
    else{
    $sql="insert into vs_users(username,email,password) values('$username','$email','$password')";
    $result=$conn->query($sql);
    if($result==TRUE)
    {
        header("Location:index.html?");
        exit();
    }
    }
}
$conn->close();
?>