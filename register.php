<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Registration Form</title>
  <style>
        /* Basic reset for the button */
        input[type="submit"] {
            border: none; /* Remove default border */
            outline: none; /* Remove default outline on focus */
        }

        /* Style for the submit container */
        .submit {
            display: flex;
            justify-content: center; /* Center the button horizontally */
            align-items: center; /* Center the button vertically */
            margin: 20px 0; /* Add spacing above and below the button */
        }

        /* Button styling */
        .btn {
            background-color: #4CAF50; /* Green background */
            color: white; /* White text */
            font-size: 16px; /* Text size */
            padding: 12px 25px; /* Add padding to make the button more clickable */
            border-radius: 8px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            transition: background-color 0.3s ease, transform 0.2s ease; /* Smooth transition */
        }

        /* Hover effect for the button */
        .btn:hover {
            background-color: #45a049; /* Darker green on hover */
            transform: scale(1.05); /* Slightly grow the button */
        }

        /* Focus effect for accessibility */
        .btn:focus {
            outline: 2px solid #80b3ff; /* Blue outline when focused */
        }

        /* Active effect (when button is clicked) */
        .btn:active {
            background-color: #388e3c; /* Even darker green on click */
        }
    </style>
</head>
<body>
  <section class="container">
    <h2>Aaradhya Consultancy</h2>
    <h1>Registration Form</h1>
    <form id="registration-form" action="register_process.php" method="POST" enctype="multipart/form-data" class="form" onsubmit="return validatePasswords(event)">
      <div class="input-box">
        <label for="full_name">Full Name</label>
        <input type="text" id="full_name" name="full_name" placeholder="Enter full name" required>
      </div>

      <div class="input-box">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter email address" required>
      </div>

      <div class="column">
        <div class="input-box">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="Enter phone number" required>
        </div>
        <div class="input-box">
          <label for="birth_date">Birth Date</label>
          <input type="date" id="birth_date" name="birth_date" required>
        </div>
        <script>
  // Set the maximum allowed date (today - 18 years)
  const birthDateInput = document.getElementById("birth_date");
  const today = new Date();
  const minAgeDate = new Date(today.getFullYear() - 18, today.getMonth(), today.getDate());
  birthDateInput.max = minAgeDate.toISOString().split("T")[0];

  // Additional validation on form submission
  const form = document.querySelector("form"); // Replace with your form selector if necessary
  form.addEventListener("submit", (event) => {
    const selectedDate = new Date(birthDateInput.value);
    if (selectedDate > minAgeDate) {
      event.preventDefault(); // Prevent form submission
      alert("You must be at least 18 years old to register.");
    }
  });
</script>    

      </div>

      <div class="input-box">
        <label for="aadhaar">Aadhaar Number</label>
        <input type="text" id="aadhaar" name="aadhaar" placeholder="Enter aadhaar number" required>
      </div>

      <div class="gender-box">
        <h3>Gender</h3>
        <div class="gender-option">
          <div class="gender">
            <input type="radio" id="check-male" name="gender" value="male" checked>
            <label for="check-male">Male</label>
          </div>
          <div class="gender">
            <input type="radio" id="check-female" name="gender" value="female">
            <label for="check-female">Female</label>
          </div>
          <div class="gender">
            <input type="radio" id="check-other" name="gender" value="prefer not to say">
            <label for="check-other">Prefer not to say</label>
          </div>
        </div>
      </div>

      <div class="input-box">
        <label for="photo">Photo</label>
        <input type="file" id="photo" name="photo" accept="image/*" required>
      </div>

      <div class="input-box">
        <label for="sign">Signature</label>
        <input type="file" id="sign" name="sign" accept="image/*" required>
      </div>

      <div class="input-box address">
        <label for="address_line1">Address</label>
        <input type="text" id="address_line1" name="address_line1" placeholder="Enter street address" required>
        <input type="text" name="address_line2" placeholder="Enter street address line 2" required>
        <div class="column">
          <div class="select-box">
            <select name="country" required>
              <option value="" disabled selected hidden>Country</option>
              <option value="America">America</option>
              <option value="Japan">Japan</option>
              <option value="India">India</option>
              <option value="Nepal">Nepal</option>
            </select>
          </div>
          <input type="text" name="city" placeholder="Enter your city" required>
        </div>
        <div class="input-box">
          <input type="text" name="region" placeholder="Enter your region" required>
          <input type="text" name="postal_code" placeholder="Enter postal code" required>
        </div>
      </div>

      <div class="input-box">
        <input type="password" id="pass" name="pass" placeholder="Create Password" required>
        <input type="password" id="conpass" name="conpass" placeholder="Confirm Password" required>
      </div>

      <div class="submit" >
        <input type="submit" id="submit-button" class="btn" name="submit" value="Register">
      </div>

      <script>
        function validatePasswords(event) {
          const password = document.getElementById("pass").value;
          const confirmPassword = document.getElementById("conpass").value;
          if (password !== confirmPassword) {
            alert("Passwords do not match. Please try again.");
            return false;
          }
          return true;
        }
      </script>
    </form>
  </section>
</body>
</html>
