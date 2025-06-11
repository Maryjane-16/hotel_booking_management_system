Hotel Booking Management System

A simple Hotel Booking Management System built with **PHP**, **MySQL**, and **Bootstrap 5** that allows users to book rooms, manage booking records, upload images of the guests and generate PDF receipts for each booking.

 Features

Submit booking with customer details
View all booking records
View individual booking details
Edit existing bookings
Delete individual bookings
Clear all booking records
Upload guest images
Download booking details as PDF
Simple login protection (optional)
Clean and responsive UI using Bootstrap

---

## Tech Stack

**Frontend**: HTML5, Bootstrap 5
**Backend**: PHP
**Database**: MySQL (phpMyAdmin)
**PDF Generator**: [Dompdf]


 Project Structure

Hotel_Booking_Management_System/

*index.php # Booking form page
*index_records.php # All booking records
*show.php # Individual booking detail view
*edit.php # Edit booking
*delete.php # Delete booking
*includes/
    -db_connect.php # DB connection
    -get_booking_record_id.php # Fetch booking by ID
    -invalid_request.php
    -no_booking_record.php
    -isloggedin.php
    -file_uploads.php
    -form_validate.php
    -auth.php
    -unauthorized.php
*js #Image dimension
*uploads/ # Uploaded guest images
*vendor/ # Dompdf (via Composer)
*print_pdf.php # PDF generation logic
*README.md
*test.php # Create CRUD funtionality of the room_type
*login.php # Login to the Administration portal 
Administration access login information
username - chinazormjay
password - chinazormjay123