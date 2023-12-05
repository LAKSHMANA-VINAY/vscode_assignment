<?php
include "connect.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $contactType = strlen($_POST['contactType']) > 0 ? $_POST['contactType'] : "inClinic";
    $date = $_POST['date'];
    $selectedTime = $_POST['selectedTime'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <title>Appointment Booking</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    #top-arrow {
      position: fixed;
      top: 20px;
      left: 20px;
      font-size: 1.5em;
      cursor: pointer;
    }

    section {
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      margin: 20px;
      width: 80%;
      box-sizing: border-box;
    }

    h2 {
      text-align: center;
      color: #333;
    }

    p {
      margin-bottom: 10px;
    }

    label {
      margin-bottom: 5px;
      display: block;
    }

    input, select {
      width: 100%;
      padding: 10px;
      margin-bottom: 10px;
      box-sizing: border-box;
    }

    button {
      background-color: green;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
    }

    .faq-section {
      padding-left: 2em;
    }

    .faq-question-container {
      background-color: #fff;
      border-radius: 8px;
      margin-bottom: 1em;
      padding: 1em;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
    }

    .faq-question {
      flex: 1;
      margin-right: 1em;
      color: #000;
    }

    .faq-arrow {
      background-color: #4CAF50;
      color: #fff;
      border-radius: 50%;
      padding: 0.2em;
      cursor: pointer;
      font-size: 0.8em;
      height: 15px;
      width: 15px;
      padding-left: 6px;
    }

    .faq-answer {
      display: none;
      margin-top: 0.5em;
      color: #000;
    }

    .arrow-button {
      display: inline-block;
      background-color: #007BFF;
      color: #fff;
      padding: 10px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      text-decoration: none;
      transition: background-color 0.3s;
      display: flex;
      align-items: center;
    }

    .arrow-button i {
      margin-right: 5px;
    }

    .arrow-button:hover {
      background-color: #0056b3;
    }

  </style>
</head>
<body>
  <a href="doctor.php" id="top-arrow" class="arrow-button" title="Go to Doctor Page">
    <i class="fas fa-arrow-left"></i>
    <?php echo $contactType; ?>
  </a>

  <section>
    <h2>Appointment Summary</h2>
    <p>Contact Type: <?php echo $contactType; ?></p>
    <p>Date: <?php echo $date; ?></p>
    <p>Time: <?php echo $selectedTime; ?></p>
  </section>

  <section>
    <h2>Patient Details</h2>
    <form id="patientForm" onsubmit="return validateForm()" action="afterbookslot.php" method="post" autocomplete="off">
      <label for="patientName">Patient Name</label>
      <input type="text" id="patientName" name="patientName" pattern="[A-Za-z ]+" title="Only characters are allowed" required>

      <label for="age">Age</label>
      <input type="number" id="age" name="age" min="6" max="70" required>

      <label for="gender">Gender</label>
      <select id="gender" name="gender" required>
        <option value="male">Male</option>
        <option value="female">Female</option>
        <option value="other">Other</option>
      </select>

      <label for="phoneNumber">Phone Number</label>
      <input type="tel" id="phoneNumber" name="phoneNumber" pattern="[6-9][0-9]{9}" title="Please enter a valid 10-digit phone number starting with 6, 7, 8, or 9." required>

      <input type="hidden" name="contactType" value="<?php echo $contactType; ?>">
      <input type="hidden" name="date" value="<?php echo $date; ?>">
      <input type="hidden" name="slot" value="<?php echo $selectedTime; ?>">


      <button type="submit" name="submit" value="submit">Submit</button>
    </form>
  </section>

  <section class="faq-section" style="background-color: #fffdd0;">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-question-container" onclick="toggleAnswer('faq1')">
      <div class="faq-question">Q: How can I book an appointment online?</div>
      <i class="fas fa-arrow-down fa-2x faq-arrow"></i>
    </div>
    <div id="faq1" class="faq-answer">A: You can book an appointment by visiting our website and selecting the preferred time and date.</div>
    <div class="faq-question-container" onclick="toggleAnswer('faq2')">
      <div class="faq-question">Q: Are online appointments secure?</div>
      <i class="fas fa-arrow-down fa-2x faq-arrow"></i>
    </div>
    <div id="faq2" class="faq-answer">A: Yes, we ensure the security and privacy of your online appointment information.</div>
    <div class="faq-question-container" onclick="toggleAnswer('faq3')">
      <div class="faq-question">Q: Do you accept insurance?</div>
      <i class="fas fa-arrow-down fa-2x faq-arrow"></i>
    </div>
    <div id="faq3" class="faq-answer">A: Yes, we accept most major insurance plans. Please check with our front desk for details.</div>
  </section>

  <script>
    function toggleAnswer(faqId) {
      var answer = document.getElementById(faqId);
      if (answer.style.display === 'block') {
        answer.style.display = 'none';
      } else {
        answer.style.display = 'block';
      }
    }

    function validateForm() {
      var nameRegex = /^[A-Za-z ]+/;
      var phoneRegex = /^[6-9][0-9]{9}$/;

      var patientName = document.getElementById('patientName').value;
      var age = document.getElementById('age').value;
      var phoneNumber = document.getElementById('phoneNumber').value;

      if (!nameRegex.test(patientName)) {
        alert('Invalid name. Please enter only characters.');
        return false;
      }

      if (age < 6 || age > 70) {
        alert('Invalid age. Please enter an age between 6 and 70.');
        return false;
      }

      if (!phoneRegex.test(phoneNumber)) {
        alert('Invalid phone number. Please enter a 10-digit number starting with 6, 7, 8, or 9.');
        return false;
      }
      return true;
    }
  </script>

</body>
</html>

<?php

} else {
    http_response_code(400); 
    echo 'Invalid request method.';
}
?>
