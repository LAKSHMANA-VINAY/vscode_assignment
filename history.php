<?php
include "connect.php";
session_start();
if(isset($_GET['email']))
{
    $email=$_GET['email'];
    $query="select patient,age,gender,phone,date,slot,type from vs_booking where email='$email'";
    $result=mysqli_query($conn,$query);

}
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Appointment History</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
            position: relative;
            display: flex;
            align-items: center;

        }

        header h1{
            margin-left:550px;
        }

        .previous-page a {
            color: #fff;
            text-decoration: none;
            font-size: 1.5em;
        }

        .user-icon {
            position: absolute;
            top: 50%;
            right: 1em;
            transform: translateY(-50%);
            cursor: pointer;
            align-items: center;
        }

        .user-icon img {
            border-radius: 50%;
            max-width: 40px;
            margin-right: 0.5em;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            right: 0;
        }

        .user-icon:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu a {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-menu a:hover {
            background-color: #ddd;
        }

        .container {
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        caption {
            font-size: 1.5em;
            margin-bottom: 10px;
        }
    </style>
</head>
    <body>
        <header>
        <div class="previous-page">
        <a href="doctor.php"><i class="fas fa-arrow-left"></i></a>
        </div>
        <h1>Doctor Appointment</h1>
        <div class="user-icon">
            <img src="https://m.media-amazon.com/images/I/41jLBhDISxL._AC_UF1000,1000_QL80_.jpg" alt="User Photo">
            <div class="dropdown-menu">
            <a href="history.php?email=<?php echo rawurlencode(str_replace("'", "", $_SESSION['email'])); ?>">History</a>
            <a href="logout.php">Logout</a>
            </div>
        </div>
        </header>
        <div class="container">
            <table > 
                <caption>Your History</caption>
                <tbody> 
                    <tr> 
                        <th>PATIENT NAME</th> 
                        <th>AGE</th>
                        <th>GENDER</th>
                        <th>PHONE</th>
                        <th>DATE</th>
                        <th>SLOT</th>
                        <th>TYPE</th>
                    </tr>
                    <?php
                    if(mysqli_num_rows($result)>0){
                    while($res=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $res['patient']; ?></td>
                        <td><?php echo $res['age']; ?></td>
                        <td><?php echo $res['gender']; ?></td>
                        <td><?php echo $res['phone']; ?></td>
                        <td><?php echo $res['date']; ?></td>
                        <td><?php echo $res['slot']; ?></td>
                        <td><?php echo $res['type']; ?></td>
                    </tr> 
                    <?php 
                    }
                        }
                        else
                        {
                            echo '<span class="message">No Tasks</span>';
                        }
                    ?> 
                </tbody> 
            </table> 
        </div>
    </body>
</html>
