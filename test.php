<?php

require_once "includes/db_connect.php";

$conn = connectDB();

// fetch room_types table data from thr database
$query = "SELECT * FROM room_types";
$result = mysqli_query($conn, $query);

$room_types = mysqli_fetch_all($result, MYSQLI_ASSOC);

$room_types = [
    ['name' => 'Single Room'],
    ['name' => 'Double Room'],
    ['name' => 'Suite'],
    ['name' => 'Family Room'],
    ['name' => 'Deluxe'],
    ['name' => 'Executive Room'],
    ['name' => 'Presidential Room'],
];
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <label for="roomType" class="form-label">Room Type</label>
    <input class="form-control" list="roomOptions" id="roomType" name="room_type" placeholder="Type to search..." required>
    <datalist id="roomOptions">
        <?php foreach($room_types as $room_type):?>
        <option value="<?= $room_type['name']?>">
        <?php endforeach ?>
    </datalist>

</body>

</html>