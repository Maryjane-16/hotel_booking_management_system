<?php

session_start();

require_once "includes/db_connect.php";
require_once "includes/get_booking_record_id.php";
require_once "includes/isloggedin.php";

/**
 *  Reading out a specific data from the database
 */

 $id = $_GET['id'];

 //connect our db
$conn = connectDB();

 $data = getBookingRecordById($conn, $id)


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


        <!--show success message -->
            <?php if (isset($_SESSION['success_message'])): ?>
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= $_SESSION['success_message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

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
          <a href="index_records.php" class="btn btn-secondary btn-sm">Back</a>
          <a href="delete.php?id=<?= $id ?>" class="btn btn-danger btn-sm">Delete</a>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
