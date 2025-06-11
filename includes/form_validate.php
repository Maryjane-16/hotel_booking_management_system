<?php

function formValidation($full_name, $email, $phone_number, $room_type, $check_in_date, $check_out_date,)
{

    $errors = [];

    if ($full_name == '') {
        $errors[] = "The full name field must not be empty.";
    }
    if ($email == '') {
        $errors[] = "The email field must not be empty.";
    }
    if ($phone_number == '') {
        $errors[] = "The full phone number must not be empty.";
    }
    if ($room_type == '') {
        $errors[] = "The room type field must not be empty.";
    }
    if ($check_in_date == '') {
        $errors[] = "The check in date field must not be empty.";
    }
    if ($check_out_date == '') {
        $errors[] = "The check out date field must not be empty.";
    }

    return $errors;
}
