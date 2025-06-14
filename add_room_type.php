<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Room Type</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow rounded-4 mx-auto" style="max-width: 600px;">
            <div class="card-body">
                <h3 class="mb-4 text-center">Add Room Type</h3>

                <form action="save_room_type.php" method="POST">
                    <div class="mb-3">
                        <label for="room_type" class="form-label">Room Type</label>
                        <input type="text" name="room_type" id="room_type" class="form-control" placeholder="Enter room type (e.g. Deluxe)" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="save" class="btn btn-primary">Save Room Type</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
