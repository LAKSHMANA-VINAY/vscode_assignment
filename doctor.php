<?php
session_start();
include "connect.php";
if(isset($_GET['email']))
$_SESSION['email']=$_GET['email'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Doctor Details</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
      justify-content: space-between;
      align-items: center;
    }

    h1 {
      margin-left: 550px; 
    }

    .user-icon {
      cursor: pointer;
      position: relative;
    }

    .user-icon img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
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

    section {
      width: 80%;
      margin: 0 auto;
      background-color: #fff;
      padding: 1em;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      overflow: hidden;
    }

    .doctor-section {
      overflow: hidden;
      border-bottom: 1px solid #ddd;
      padding-bottom: 1em;
      width: 81%;
    }

    .doctor-img {
      float: left;
      border-radius: 50%;
      max-width: 100px;
      max-height: 100px;
      margin-right: 1em;
    }

    .doctor-details {
      margin-top: 1em;
    }

    .view-profile-button {
      background-color: #fff;
      color: #007BFF;
      border: 2px solid #007BFF;
      padding: 0.5em 1em;
      border-radius: 4px;
      cursor: pointer;
    }

    .appointment-section,
    .faq-section {
      padding-left: 2em;
    }

    .contact-options {
      margin-bottom: 1em;
    }

    .contact-option {
      display: inline-block;
      margin-right: 1em;
      cursor: pointer;
    }

    .contact-option i {
      margin-right: 0.5em;
    }

    .contact-option.selected {
      color: #4CAF50;
    }

    .fees {
      margin-bottom: 1em;
    }

    .continue-button {
      background-color: #C0C0C0;
      color: #fff;
      padding: 0.5em 1em;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
      margin-top: 1em;
    }

    .continue-button.enabled {
      background-color: #007BFF;
    }

    .faq-question-container {
      background-color: #fff;
      border-radius: 8px;
      margin-bottom: 1em;
      padding: 1em;
      display: flex;
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
      position: absolute;
      right: 1em;
      top: 50%;
      transform: translateY(-50%);
      height: 15px;
      width: 15px;
    }

    .faq-answer {
      display: none;
      margin-top: 0.5em;
      color: #000;
    }

    .slot-button {
      background-color: #fff;
      border: 2px solid #ddd;
      color: #333;
      padding: 0.5em 1em;
      border-radius: 4px;
      cursor: pointer;
      margin-right: 0.5em;
    }

    .slot-button.selected {
      background-color: #4CAF50;
      color: #fff;
      border: 2px solid #4CAF50;
    }

    .date-navigation {
      margin-bottom: 1em;
      display: flex;
      justify-content: space-between;
    }

    .date-navigation button {
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 4px;
      padding: 0.5em 1em;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <header>
      <h1>Doctor Appointment</h1>
      <div class="user-icon">
        <img src="https://m.media-amazon.com/images/I/41jLBhDISxL._AC_UF1000,1000_QL80_.jpg" alt="User Photo">
        <div class="dropdown-menu">
        <a href="history.php?email=<?php echo rawurlencode(str_replace("'", "", $_SESSION['email'])); ?>">History</a>
          <a href="logout.php">Logout</a>
        </div>
      </div>
    </header>

  <section class="doctor-section">
    <img class="doctor-img" src="https://thumbs.dreamstime.com/b/male-doctor-nurse-ners-avatar-clipart-icon-logo-animated-cartoon-vector-flat-design-men-occupation-paramedic-illustration-269804308.jpg" alt="Doctor Image">
    <div class="doctor-details">
      <p>Dr. Manik Dalvi</p>
      <p>Obstetrics & Gynecology</p>
    </div>
    <button class="view-profile-button">View Profile</button>
  </section>

  <section class="appointment-section">
    <h2>Book Appointment</h2>
    <div class="contact-options">
      <p>Contact Options:</p>
    <div class="contact-option" onclick="updateContactType('inClinic')" data-contact-type="inClinic">
      <i class="fas fa-hospital"></i> In Clinic
    </div>
    <div class="contact-option" onclick="updateContactType('video')" data-contact-type="video">
      <i class="fas fa-video"></i> Video
    </div>
    <div class="contact-option" onclick="updateContactType('phone')" data-contact-type="phone">
      <i class="fas fa-phone"></i> Phone
    </div>
    </div>
    <div class="fees">
      <p>Fees:</p>
      <span id="fees-display">In Clinic - 1000 RS</span>
    </div>

    <div class="slots-section">
      <div class="date-navigation">
        <button id="prevDate" onclick="changeDate(-1)">‹ Previous</button>
        <div id="dateHeader"></div>
        <button id="nextDate" onclick="changeDate(1)">Next ›</button>
      </div>

      <div id="slotHeader"></div>

      <!-- Slots buttons dynamically populated here -->
      <div id="slotButtons"></div>

      <button class="continue-button" disabled onclick="sendBookingData()">Continue</button>
    </div>
  </section>

  <section class="faq-section" style="background-color: #fffdd0;">
    <h2>Frequently Asked Questions</h2>
    <div class="faq-question-container" onclick="toggleAnswer(1)">
      <div class="faq-question">Q: What are the office hours?</div>
      <i class="fas fa-arrow-down fa-2x faq-arrow"></i>
    </div>
    <div class="faq-answer">A: Our office hours are Monday to Friday, 9:00 AM to 5:00 PM.</div>
    <div class="faq-question-container" onclick="toggleAnswer(2)">
      <div class="faq-question">Q: How can I reschedule my appointment?</div>
      <i class="fas fa-arrow-down fa-2x faq-arrow"></i>
    </div>
    <div class="faq-answer">A: You can contact our office at least 24 hours before your appointment to reschedule.</div>
    <div class="faq-question-container" onclick="toggleAnswer(3)">
      <div class="faq-question">Q: Do you accept insurance?</div>
      <i class="fas fa-arrow-down fa-2x faq-arrow"></i>
    </div>
    <div class="faq-answer">A: Yes, we accept most major insurance plans. Please check with our front desk for details.</div>
  </section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
  <script>

    // JavaScript for dynamically populating slots based on the selected contact type
    function toggleAnswer(faqNumber) {
      var answer = document.getElementsByClassName('faq-answer')[faqNumber - 1];
      if (answer.style.display === 'none') {
        answer.style.display = 'block';
      } else {
        answer.style.display = 'none';
      }
    }

    // JavaScript to handle slot button selection and continue button state
    var selectedSlot = null;

    document.addEventListener('click', function (event) {
      if (event.target.classList.contains('slot-button')) {
        // Toggle the selected class for the slot buttons
        var buttons = document.querySelectorAll('.slot-button');
        buttons.forEach(function (button) {
          button.classList.remove('selected');
        });

        event.target.classList.toggle('selected');
        selectedSlot = {
          date: event.target.dataset.date,
          time: event.target.dataset.slot
        };

        // Enable the continue button when a slot is selected
        var continueButton = document.querySelector('.continue-button');
        continueButton.disabled = !selectedSlot;

        // Change the continue button color to blue when a slot is selected
        if (selectedSlot) {
          continueButton.classList.add('enabled');
        } else {
          continueButton.classList.remove('enabled');
        }
      }
    });

    // JavaScript to dynamically update fees based on the selected contact type
    function updateContactType(contactType) {
      updateFees(contactType);
      var contactOptions = document.querySelectorAll('.contact-option');
      contactOptions.forEach(function (option) {
        option.classList.remove('selected');
      });
      var selectedOption = document.querySelector('.contact-option[data-contact-type="' + contactType + '"]');
      if (selectedOption) {
        selectedOption.classList.add('selected');
      }
    }


    function updateFees(contactType) {
      var feesDisplay = document.getElementById('fees-display');
      switch (contactType) {
        case 'inClinic':
          feesDisplay.textContent = 'In Clinic - 1000 RS';
          break;
        case 'phone':
          feesDisplay.textContent = 'Phone - 500 RS';
          break;
        case 'video':
          feesDisplay.textContent = 'Video - 750 RS';
          break;
        default:
          feesDisplay.textContent = 'In Clinic - 1000 RS';
      }
    }

    // Initial update of fees based on the default selection (In Clinic)
    updateFees('inClinic');

    // JavaScript for date navigation and slot buttons
    var currentDateIndex = 0;

    function changeDate(change) {
      currentDateIndex += change;
      updateDateAndSlots();
    }

    function updateDateAndSlots() {
      var currentDate = new Date();
      currentDate.setDate(currentDate.getDate() + currentDateIndex);

      var dateHeader = document.getElementById('dateHeader');
      dateHeader.textContent = formatDate(currentDate);

      var slotHeader = document.getElementById('slotHeader');
      slotHeader.textContent = 'Available Slots:';

      var slotButtonsContainer = document.getElementById('slotButtons');
      slotButtonsContainer.innerHTML = '';

      // Slots buttons dynamically populated here
      for (var i = 0; i < 5; i++) {
        var slotButton = document.createElement('button');
        var slotTime = (i + 10) + ':00';
        slotButton.textContent = slotTime;
        slotButton.className = 'slot-button';
        slotButton.dataset.date = formatDate(currentDate);
        slotButton.dataset.slot = slotTime;
        slotButtonsContainer.appendChild(slotButton);
      }

      var continueButton = document.querySelector('.continue-button');
      continueButton.disabled = true;

      var prevDateButton = document.getElementById('prevDate');
      prevDateButton.disabled = isCurrentDate(currentDateIndex);
    }

    function isCurrentDate(index) {
      var currentDate = new Date();
      var modifiedDate = new Date();
      modifiedDate.setDate(modifiedDate.getDate() + index);
      return (
        modifiedDate.getDate() === currentDate.getDate() &&
        modifiedDate.getMonth() === currentDate.getMonth() &&
        modifiedDate.getFullYear() === currentDate.getFullYear()
      );
    }

    function formatDate(date) {
      var options = { weekday: 'short', month: 'short', day: 'numeric' };
      return date.toLocaleDateString('en-US', options);
    }

    // Initial setup of date and slot buttons
    updateDateAndSlots();

    function sendBookingData() {
      if (selectedSlot) {
        var contactType = getSelectedContactType();
        var date = document.getElementById('dateHeader').textContent;
        var selectedTime = selectedSlot.time;

        // Create a form element
        var form = document.createElement('form');
        form.action = 'bookslot.php';
        form.method = 'POST';

        // Create form fields and append them to the form
        var appendField = function (name, value) {
          var input = document.createElement('input');
          input.type = 'hidden';
          input.name = name;
          input.value = value;
          form.appendChild(input);
        };

        appendField('contactType', contactType);
        appendField('date', date);
        appendField('selectedTime', selectedTime);

        // Append the form to the document and submit it
        document.body.appendChild(form);
        form.submit();
      }
    }

  function getSelectedContactType() {
  var selectedContactOption = document.querySelector('.contact-option.selected');
  if (selectedContactOption) {
    return selectedContactOption.dataset.contactType;
  }
  return null;
}

  function goToHistory() {
      var userEmail = <?php echo $_SESSION['email']; ?>;
      window.location.href = 'history.php?email=' + encodeURIComponent(userEmail);
  }

  </script>

</body>
</html>
