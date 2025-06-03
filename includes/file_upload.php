<?php

try {
    // check if the file uploaded is greater than the post_max_size limit
    if (empty($_FILES)){
        throw new Exception("Invalid upload");
    }

    switch ($_FILES['image_file']['error']){
        case UPLOAD_ERR_OK;
        break;
        case UPLOAD_ERR_NO_FILE:
            throw new Exception("No file uploaded");
            break;
        case UPLOAD_ERR_INI_SIZE:
            // file uploaded size is greater than the upload_max_size limit
            throw new Exception("file is too large");
            break;
        default:
        throw new Exception("An error occured when uploading!");
    }

    // set the upload size limit to 10MB
    if ($_FILES['image_file']['size'] > 10485760){
        throw new Exception("File size is too large!");
    }
    // specify the MIME type
    $mime_types = ['image/png', 'image/jpg', 'image/jpeg'];
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime_type = finfo_file($finfo, $_FILES['image_file']['tmp_name']);

    // if the file is nto of any of the mime types specify
    if (!in_array($mime_type, $mime_types)){
        throw new Exception("Invalid file type uploaded.");
    }

    // prevent filename from code injection
    $pathinfo = pathinfo($_FILES['image_file']['name']);
    $base = $pathinfo['image_file'];
    // replace any characters that ain't proper letters, numbers or whatever
    preg_replace("/[^a-zA-Z0-9_-]/", "_", $base);
    // limits the filename to 100 characters max
    $base = mb_substr($base, 0, 100);
    $image_file = $base . "." .$pathinfo['extension'];

    $destination = "./uploads/$image_file";

    // check if the image_file already exists firsts, if it does, modify the name with numbers
    $i = 1;
    while (file_exists($destination)){
        $image_file = $base . "-$i." . $pathinfo['extension'];
        $destination = "./uploads/$image_file";
        $i++;

    }
    // move the file to the uploads dir inside our project
    move_uploaded_file($_FILES['image_file']['tmp_name'], $destination);


} catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
}
