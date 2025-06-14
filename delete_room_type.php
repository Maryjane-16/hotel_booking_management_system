<?php

require_once "includes/db_connect.php";

session_start();

$id = $_GET['id'];

//connect our db
$conn = connectDB();


if (isset($id)) {
  $sql = "DELETE FROM room_types WHERE id = ?";

  // prepare an SQL statement for execution
  $stmt = mysqli_prepare($conn, $sql);

  // bind variables for the parameter markers in the SQL statement prepared
  mysqli_stmt_bind_param($stmt, 'i', $id);

  //execute the prepared statement
  $results = mysqli_stmt_execute($stmt);

  if ($results) {
    header("Location: http://localhost:200/room_types.php");
    exit;
  }
}
