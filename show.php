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
            <p>John Doe</p>
          </div>
          <div class="col-md-6">
            <strong>Email:</strong>
            <p>johndoe@example.com</p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <strong>Phone:</strong>
            <p>123-456-7890</p>
          </div>
          <div class="col-md-6">
            <strong>Room Type:</strong>
            <p>Deluxe</p>
          </div>
        </div>

        <div class="row mb-3">
          <div class="col-md-6">
            <strong>Check-in Date:</strong>
            <p>2025-06-01</p>
          </div>
          <div class="col-md-6">
            <strong>Check-out Date:</strong>
            <p>2025-06-05</p>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex justify-content-between mt-4">
          <a href="index.php" class="btn btn-secondary">Back</a>
          <a href="delete_booking.php?id=1" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?');">Delete</a>
        </div>

      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
