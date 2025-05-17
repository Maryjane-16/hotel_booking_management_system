<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Hotel Bookings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-lg rounded-4">
            <div class="card-body p-4">
                <h2 class="mb-4 text-center">Hotel Booking Records</h2>

                <!-- Booking Records Table -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Room Type</th>
                                <th>Check-in Date</th>
                                <th>Check-out Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Replace this with PHP dynamic rows -->
                        <tbody class="text-center">
                            <tr>
                                <td>John Doe</td>
                                <td>johndoe@example.com</td>
                                <td>123-456-7890</td>
                                <td>Deluxe</td>
                                <td>2025-06-01</td>
                                <td>2025-06-05</td>
                                <td>
                                    <!-- Action Buttons -->
                                     <button class="btn btn-sm btn-secondary">Show</button>
                                    <button class="btn btn-sm btn-warning">Update</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Footer Buttons -->
                <div class="text-center mt-4">
                    <a href="create_booking.php" class="btn btn-sm btn-success">Create New Booking</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>