<?php

session_start();

require_once "includes/db_connect.php";

// Connect to DB
$conn = connectDB();

// Check for POST request
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['save'])) {
    $room_type = trim($_POST['room_type']);

    // Basic validation
    if (empty($room_type)) {
        $_SESSION['error_message'] = "Room type is required.";
        header("Location: add_room_type.php");
        exit;
    }

    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO room_types (room_type) VALUES (?)");
    $stmt->bind_param("s", $room_type);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Room type added successfully!";
        header("Location: room_types.php");
        exit;
    } else {
        $_SESSION['error_message'] = "Something went wrong. Please try again.";
        header("Location: add_room_type.php");
        exit;
    }
}
