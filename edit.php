<?php

session_start();

require_once "includes/db_connect.php";
require_once "includes/get_booking_record_id.php";
require_once "includes/isloggedin.php";
require_once "includes/form_validate.php";

$id = $_GET['id'];

//connect our db
$conn = connectDB();

/**
 *  READING OR RETRIEVING SPECIFIC DATABFROMNTHE DATABASE IN THE EDIT PAGE
 */


if (isset($_GET['id'])) {
  $data = getBookingRecordById($conn, $id);

  //You can also handle the case where no record is found in the specified ID
  if (!$data) {
    echo require_once "includes/no_booking_record.php";
    exit;
  }


  if ($data) {
    $full_name = $data['full_name'];
    $email = $data['email'];
    $phone_number = $data['phone_number'];
    $room_type = $data['room_type'];
    $check_in_date = $data['check_in_date'];
    $check_out_date = $data['check_out_date'];
    $image_file = $data['image_file'];
  }
} else {
  //You can also handle the case where no ID is in the URL
  echo require_once "includes/invalid_request.php";
  exit;
}


/**
 * WORKING ON THE UPDATE/EDIT FUNCTIONALITY
 */
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (isset($_POST['update'])) {

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


      $sql = "UPDATE booking_records
        SET full_name = ?, email = ?, phone_number = ?, room_type = ?, check_in_date = ?, check_out_date = ?, image_file = ?
        WHERE id = ?";

      // prepare an SQL statement for execution
      $stmt = mysqli_prepare($conn, $sql);

      if ($stmt === false) {
        echo mysqli_error($conn);
      } else {

        // bind variables for the parameter markers in the SQL statement prepared
        mysqli_stmt_bind_param($stmt, 'sssssssi', $full_name, $email, $phone_number, $room_type, $check_in_date, $check_out_date, $image_file, $id);

        //execute the prepared statement
        $results = mysqli_stmt_execute($stmt);

        if ($results) {
          $_SESSION['success_message'] = "form updated successfully!";
          header("Location: http://localhost:200/show.php?id=$id");
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
  <title>Hotel Booking Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card shadow-lg rounded-4">
          <div class="card-body p-5">
            <h2 class="card-title text-center mb-4">Edit Booking Record</h2>

            <form method="POST" enctype="multipart/form-data">

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

              <div class="mb-3 form-floating">
                <input type="text" class="form-control" id="fullName" name="full_name" placeholder="Full Name" value="<?= $full_name ?>" required>
                <label for="fullName">Full Name</label>
              </div>

              <div class="mb-3 form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email address" value="<?= $email ?>" required>
                <label for="email">Email address</label>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone_number" placeholder="e.g. 123-456-7890" value="<?= $phone_number ?>" required>
              </div>

              <div class="mb-3">
                <label for="roomType" class="form-label">Room Type</label>
                <select class="form-control" id="roomType" name="room_type" required>

                  <?php
                  $Room_types = ['Single Room', 'Double Room', 'Suite', 'Family Room', 'Deluxe', 'Executive Room', 'Presidential Room'];

                  foreach ($Room_types as $room) {
                    $selected = ($room === $room_type) ? 'selected' : '';
                    echo "<option value='$room' $selected>$room</option>";
                  }
                  ?>
                </select>
              </div>

              <div class="mb-3 form-floating">
                <input type="date" class="form-control" id="checkin" name="check_in_date" placeholder="Check-in Date" value="<?= $check_in_date ?>" required>
                <label for="checkin">Check-in Date</label>
              </div>

              <div class="mb-4 form-floating">
                <input type="date" class="form-control" id="checkout" name="check_out_date" placeholder="Check-out Date" value="<?= $check_out_date ?>" required>
                <label for="checkout">Check-out Date</label>
              </div>

              <!-- upload image-->
              <div class="mb-4">
                <label for="file">Upload Image:</label>
                <input type="file" id="file" name="image_file" accept="image/*" onchange="checkImageResolution(event);" value="<?= $image_file ?>">
              </div>
              <div id="error-message" style="color: red"></div>


              <!-- submit button-->
              <div class="text-center">
                <button type="submit" name="update" class="btn btn-primary px-5">Update Booking Record</button>
                <a class="btn btn-secondary px-5" href="/index_records.php">Back</a>
              </div>
            </form>

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