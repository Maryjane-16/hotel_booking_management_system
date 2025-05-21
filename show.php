<?php

require_once "includes/db_connect.php";

/**
 *  Reading out a specific data from the database
 */

 $id = $_GET['id'];

 //connect our db
$conn = connectDB();


// fetches a specific booking_records by its id
$sql = "SELECT * FROM booking_records WHERE id = ?";

// prepare an SQL statement for execution
$stmt = mysqli_prepare($conn, $sql);

// bind variables for the parameter markers in the SQL statement prepared
mysqli_stmt_bind_param($stmt, 'i', $id);

//execute the prepared statement
$results = mysqli_stmt_execute($stmt);

//get a result set from a prepared statement as an object
$get_result = mysqli_stmt_get_result($stmt);

// $data = mysqli_fetch_array($get_result, MYSQLI_ASSOC);
$data = mysqli_fetch_assoc($get_result);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
  <div class="container py-5">
    <div class="card shadow-lg rounded-4">
      <div class="card-body p-5">
        <h2 class="text-center mb-4">Booking Details</h2>

        <!-- Booking Info -->
        <div class="row mb-3">
          <div class="col-md-6">
            <strong>Full Name:</strong>
            <p><?= $data['full_name'] ?></p>
          </div>
          <div class="col-md-6">
            <strong>Email:</strong>
            <p><?= $data['email'] ?></p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <strong>Phone:</strong>
            <p><?= $data['phone_number'] ?></p>
          </div>
          <div class="col-md-6">
            <strong>Room Type:</strong>
            <p><?= $data['room_type'] ?></p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <strong>Check-in Date:</strong>
            <p><?= $data['check_in_date'] ?></p>
          </div>
          <div class="col-md-6">
            <strong>Check-out Date:</strong>
            <p><?= $data['check_out_date'] ?></p>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-4">
          <a href="index_records.php" class="btn btn-secondary">Back</a>
          <a href="delete_booking.php?id=1" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
