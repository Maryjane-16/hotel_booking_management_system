<?php

require_once "includes/db_connect.php";
require_once "includes/get_booking_record_id.php";


$id = $_GET['id'];

 //connect our db
$conn = connectDB();

if (isset($_GET['id'])){
  $data = getBookingRecordById($conn, $id);

  //You can also handle the case where no record is found in the specified ID
  if (!$data) {
    echo require_once "includes/no_booking_record.php";
    exit;
  }


 if($data){
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
              <div class="mb-3 form-floating">
                <input type="text" class="form-control" id="fullName" placeholder="Full Name" value="<?= $full_name ?>" required>
                <label for="fullName">Full Name</label>
              </div>

              <div class="mb-3 form-floating">
                <input type="email" class="form-control" id="email" placeholder="Email address" value="<?= $email ?>" required>
                <label for="email">Email address</label>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="e.g. 123-456-7890" value="<?= $phone_number ?>" required>
              </div>

              <div class="mb-3">
                <label for="roomType" class="form-label">Room Type</label>  
                <select class="form-control" id="roomType" name="room_type" required>
                 
                <?php
                $Room_types = ['Single Room', 'Double Room', 'Suite', 'Family Room', 'Deluxe', 'Executive Room', 'Presidential Room'];

                foreach($Room_types as $room){
                  $selected = ($room === $room_type) ? 'selected': '';
                  echo "<option value='$room' $selected>$room</option>";
                }
                ?>
                </select>
                </div>

              <div class="mb-3 form-floating">
                <input type="date" class="form-control" id="checkin" placeholder="Check-in Date"  value="<?= $check_in_date ?>" required>
                <label for="checkin">Check-in Date</label>
              </div>

              <div class="mb-4 form-floating">
                <input type="date" class="form-control" id="checkout" placeholder="Check-out Date"  value="<?= $check_out_date ?>" required>
                <label for="checkout">Check-out Date</label>
              </div>

              <!-- upload image-->
              <div class="mb-4">
                <label for="file">Upload Image:</label>
                <input type="file" name="file" id="file"  value="<?= $image_file ?>">
              </div>

              <!-- submit button-->
              <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg">Update Booking Record</button>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
