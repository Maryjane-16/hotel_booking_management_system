<?php

session_start();

require_once "includes/db_connect.php";
require_once "includes/auth.php";
require_once "includes/form_validate.php";

//initiate an erroro handler function
function myErrorHandler($errno, $errstr)
{
  echo "<b>Error:</b> [$errno] $errstr";
}
// set error handler function
set_error_handler("myErrorHandler");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['save'])) {

    require_once "includes/file_upload.php";

    $full_name = trim(filter_input(INPUT_POST, 'full_name'));
    $email = trim(filter_input(INPUT_POST, 'email'));
    $phone_number = trim(filter_input(INPUT_POST, 'phone_number'));
    $room_type = trim(filter_input(INPUT_POST, 'room_type'));
    $check_in_date = trim(filter_input(INPUT_POST, 'check_in_date'));
    $check_out_date = trim(filter_input(INPUT_POST, 'check_out_date'));

    // checking for empty fields and throwing an error if left empty
    $errors = formValidation($full_name, $email, $phone_number, $room_type, $check_in_date, $check_out_date);

    if (empty($errors)) {


      //connect to the database
      $conn = connectDB();

      // insert the data into the database
      $sql = "INSERT INTO booking_records (full_name, email, phone_number, room_type, check_in_date, check_out_date, image_file)
      VALUES (?, ?, ?, ?, ?, ?, ?)";

      // prepare an SQL statement for execution
      $stmt = mysqli_prepare($conn, $sql);

      if ($stmt === false) {
        echo mysqli_error($conn);
      } else {

        // bind variables for the parameter markers in the SQL statement prepared
        mysqli_stmt_bind_param($stmt, 'sssssss', $full_name, $email, $phone_number, $room_type, $check_in_date, $check_out_date, $image_file);

        //execute the prepared statement
        $results = mysqli_stmt_execute($stmt);

        if ($results === false) {
          echo mysqli_stmt_error($stmt);
        } else {
          header('Location: http://localhost:200/index.php?success=1');
          exit;
        }
      }
    }
  }
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title class="btn btn-primary btn-lg">Hotel Booking Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg rounded-4">
          <div class="card-body p-5">
            <h2 class="mb-0 text-center">Hotel Booking Form</h2>

            <!--show success message -->
            <?php if (isset($_GET['success']) && $_GET['success'] == 1): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                ✅ Booking submitted successfully!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>

            <!--show failure message -->
            <?php if (!empty($errors)): ?>
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul>
                  <?php foreach ($errors as $error): ?>
                    <li><?= $error ?></li>
                  <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            <?php endif; ?>


            <form method="POST" enctype="multipart/form-data">
              <div class="mb-3 form-floating">
                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name" required>
                <label for="fullName">Full Name</label>
              </div>

              <div class="mb-3 form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" required>
                <label for="email">Email Address</label>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone_number" placeholder="e.g. 123-456-7890" required>
              </div>
              <div class="mb-3">
                <label for="roomType" class="form-label">Room Type</label>
                <select class="form-select" id="roomType" name="room_type" required>
                      <option value="Single Room">Single Room</option>
                      <option value="Double Room" selected>Double Room</option>
                      <option value="Suite">Suite</option>
                      <option value="Family Room">Family Room</option>
                      <option value="Deluxe">Deluxe</option>
                      <option value="Executive Room">Executive Room</option>
                      <option value="Presidential Room">Presidential Room</option>
                    </select>
                </select>
              </div>

              <div class="mb-3 form-floating">
                <input type="date" class="form-control" id="checkin" name="check_in_date" placeholder="Check-in Date" required>
                <label for="checkin">Check-in Date</label>
              </div>

              <div class="mb-4 form-floating">
                <input type="date" class="form-control" id="checkout" name="check_out_date" placeholder="Check-out Date" required>
                <label for="checkout">Check-out Date</label>
              </div>

              <div class="mb-4">
                <label for="file">Upload Image:</label>
                <input type="file" id="file" name="image_file" accept="image/*" onchange="checkImageResolution(event);">
              </div>
              <div id="error-message" style="color: red"></div>

              <div class="text-center">
                <button type="submit" class="btn btn-primary px-5" name="save">Submit Booking</button>

                <?php if (isLoggedIn()): ?>
                  <a href="/index_records.php" class="btn btn-dark px-5">View Booking Records</a>
                <?php endif; ?>

              </div>
            </form>

            <div class="py-3 text-center">
              <?php if (isLoggedIn()): ?>
                <p>You are logged in. <a href="logout.php">Logout</a>?</p>
              <?php else: ?>
                <p>Are you a staff? If yes, <a href="login.php">Login<a></p>
              <?php endif; ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- checking image dimension to be uploaded-->
  <script src="js/image_dimension.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>