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
                <input type="text" class="form-control" id="fullName" placeholder="Full Name" required>
                <label for="fullName">Full Name</label>
              </div>

              <div class="mb-3 form-floating">
                <input type="email" class="form-control" id="email" placeholder="Email address" required>
                <label for="email">Email address</label>
              </div>

              <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" placeholder="e.g. 123-456-7890" required>
              </div>

              <div class="mb-3">
                <label for="roomType" class="form-label">Room Type</label>
                <input class="form-control" list="roomOptions" id="roomType" placeholder="Type to search..." required>
                <datalist id="roomOptions">
                  <option value="Single Room">
                  <option value="Double Room">
                  <option value="Suite">
                  <option value="Family Room">
                  <option value="Deluxe">
                  <option value="Executive Room">
                  <option value="Presidential Room">
                </datalist>
              </div>

              <div class="mb-3 form-floating">
                <input type="date" class="form-control" id="checkin" placeholder="Check-in Date" required>
                <label for="checkin">Check-in Date</label>
              </div>

              <div class="mb-4 form-floating">
                <input type="date" class="form-control" id="checkout" placeholder="Check-out Date" required>
                <label for="checkout">Check-out Date</label>
              </div>

              <!-- upload image-->
              <div class="mb-4">
                <label for="file">Upload Image:</label>
                <input type="file" name="file" id="file">
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
