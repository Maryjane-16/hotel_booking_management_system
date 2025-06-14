<?php

session_start();

require_once "includes/db_connect.php";
require_once "includes/get_room_type_by_id.php";
require_once "includes/validate_room_type.php";

$id = $_GET['id'];

//connect our db
$conn = connectDB();

/**
 *  READING OR RETRIEVING SPECIFIC DATABFROMNTHE DATABASE IN THE EDIT PAGE
 */


if (isset($_GET['id'])) {
  $data = getRoomTypesById($conn, $id);

  //You can also handle the case where no record is found in the specified ID
  if (!$data) {
    echo require_once "includes/no_room_types.php";
    exit;
  }


  if ($data) {
    $room_type = $data['room_type'];
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

  if (isset($_POST['edit'])) {

    $room_type = trim(filter_input(INPUT_POST, 'room_type'));

    // checking for empty fields and throwing an error if left empty
    $errors = validateRoomType($room_type);

    if (empty($errors)) {


      $sql = "UPDATE room_types
        SET room_type = ?
        WHERE id = ?";

      // prepare an SQL statement for execution
      $stmt = mysqli_prepare($conn, $sql);

      if ($stmt === false) {
        echo mysqli_error($conn);
      } else {

        // bind variables for the parameter markers in the SQL statement prepared
        mysqli_stmt_bind_param($stmt, 'si', $room_type, $id);

        //execute the prepared statement
        $results = mysqli_stmt_execute($stmt);

        if ($results) {
          $_SESSION['success_message'] = "room_types updated successfully!";
          header("Location: http://localhost:200/room_types.php?id=$id");
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
            <h2 class="card-title text-center mb-4">Edit Room Types</h2>

            <form method="POST">

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

              <div class="mb-3">
                <label for="roomType" class="form-label">Room Types</label>
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

              <!-- submit button-->
              <div class="text-center">
                <button type="submit" name="edit" class="btn btn-primary px-5">Edit Room Types</button>
                <a href="room_types.php" class="btn btn-secondary px-5">Back</a>
              </div>
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