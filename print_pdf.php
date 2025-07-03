<?php

session_start();

use Dompdf\Dompdf;

require_once "vendor/autoload.php";
require_once "includes/db_connect.php";
require_once "includes/get_booking_record_id.php";
require_once "includes/isloggedin.php";

$id = $_GET['id'];

//connect our db
$conn = connectDB();
$data = getBookingRecordById($conn, $id);

// start output buffering
ob_start();
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking Management System</title>
</head>

<body>

    <article>
        <h2><?= htmlspecialchars($data['full_name']) ?></h2>
        <p><b>ID: <?= htmlspecialchars($data['id']) ?></b></p>
        <p>Email: <?= htmlspecialchars($data['email']) ?></p>
        <p>Phone: <?= htmlspecialchars($data['phone_number']) ?></p>
        <p>Room type: <?= htmlspecialchars($data['room_type']) ?></p>
        <p>Check in date: <?= htmlspecialchars($data['check_in_date']) ?></p>
        <p>Check out date: <?= htmlspecialchars($data['check_out_date']) ?></p>
    </article>

</body>

</html>


<?php

// get the buffered output and cleans the buffer afterwards
$html = ob_get_clean();

// instantiates and use the dompdf class
$dompdf = new Dompdf();

// load html contents
$dompdf->loadHtml($html);

// setup the paper size and orientation
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('output.pdf', ['Attachment' => true]);


?>