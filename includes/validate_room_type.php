<?php

function validateRoomType($room_type)
{

    $errors = [];

    if ($room_type == '') {
        $errors[] = "The room type field must not be empty.";
    }

    return $errors;
}
