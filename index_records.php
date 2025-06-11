<?php

session_start();

require_once "includes/db_connect.php";
require_once "includes/isloggedin.php";

$conn = connectDB();

// Reading all records from the database
$sql = "SELECT * FROM booking_records";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $all_data = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

// Clearing all records at once from the database
if (isset($_POST['clear_booking_records'])) {

    $sql = 'TRUNCATE TABLE booking_records';
    mysqli_query($conn, $sql);

    header("Location: http://localhost:200/index_records.php");
    exit;
}



?>




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
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Room Type</th>
                                <th>Check_in Date</th>
                                <th>Check_out Date</th>
                                <th>Photos</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php if (!empty($all_data)): ?>
                            <tbody>

                                <!-- Replace this with PHP dynamic rows -->
                            <tbody class="text-center">
                                <?php foreach ($all_data as $index => $data): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($data['id']) ?></td>
                                        <td><?= htmlspecialchars($data['full_name']) ?></td>
                                        <td><?= htmlspecialchars($data['room_type']) ?></td>
                                        <td><?= htmlspecialchars($data['check_in_date']) ?></td>
                                        <td><?= htmlspecialchars($data['check_out_date']) ?></td>
                                        <td>

                                            <!-- Button trigger modal -->
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $data['id'] ?>">
                                                View photo
                                            </button>
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal<?= $data['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?= $data['id'] ?>" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Guest's Photo</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="http://localhost/Hotel_Booking_Management_System/uploads/<?= htmlspecialchars($data['image_file']) ?>" alt="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <!-- Action Buttons -->
                                            <a class="btn btn-sm btn-secondary" href="show.php?id=<?= $data['id'] ?>">Show</a>
                                            <a class="btn btn-sm btn-warning" href="edit.php?id=<?= $data['id'] ?>">Edit</a>
                                            <a class="btn btn-sm btn-danger" href="delete.php?id=<?= $data['id'] ?>">Delete</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        <?php else: ?>
                            <p>No booking records found.</p>
                        <?php endif; ?>
                    </table>
                </div>
                <!-- Footer Buttons -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a href="/index.php" class="btn btn-sm btn-success">Create New Booking</a>
                    <form method="POST">


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Clear Booking Records
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" name="clear_booking_records" class="btn btn-sm btn-primary">YES, Delete!</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>