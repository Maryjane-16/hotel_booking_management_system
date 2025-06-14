<?php
require_once "includes/db_connect.php";
require_once "includes/validate_room_type.php";

$conn = connectDB();

// Handle clear request
if (isset($_POST['clear_room_types'])) {
    mysqli_query($conn, "TRUNCATE TABLE room_types");
    header("Location: room_types.php");
    exit;
}

// Fetch room types
$query = "SELECT * FROM room_types";
$result = mysqli_query($conn, $query);
$room_types = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Room Types</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow rounded-4 mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h3 class="mb-4 text-center">Room Types</h3>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="table-dark">
                            <tr>
                                <th>Id</th>
                                <th>Room Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($room_types)) : ?>
                                <?php foreach ($room_types as $index => $type): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= htmlspecialchars($type['room_type']) ?></td>
                                        <td>
                                            <a href="edit_room_type.php?id=<?= $type['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                                            <a href="delete_room_type.php?id=<?= $type['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this room type?')">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4">No room types found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Footer Buttons -->
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <a class="btn btn-sm btn-secondary px-5" href="/index_records.php">Back</a>
                    <a href="add_room_type.php" class="btn btn-sm btn-success">Add Room Type</a>
                    <form method="POST">


                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            Clear Room Type
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>