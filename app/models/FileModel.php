<?php
require_once "config.php";
function uploadFiles($files) {
    if ($files['files']['name'][0] == "") {
        return "Please select one or more images to upload.";
    }

    $names = $files['files']['name'];
    $tmpNames = $files['files']['tmp_name'];
    $types = $files['files']['type'];
    $sizes = $files['files']['size'];

    $filesArray = array_map(null, $tmpNames, $names, $types, $sizes);
    foreach ($filesArray as $fileData) {
        list($tmpFolder, $imageName, $fileType, $fileSize) = $fileData;

        if (!in_array($fileType, ALLOWED_FILE_TYPES)) {
            return "Error: Only .jpg, .jpeg, and .png files are allowed. File: " . $imageName;
        }

        if ($fileSize > MAX_FILE_SIZE) {
            return "Error: File " . $imageName . " exceeds the maximum size of 3MB.";
        }

        if (!move_uploaded_file($tmpFolder, IMAGE_FOLDER . $imageName)) {
            return "Error uploading file: " . $imageName;
        }
    }

    return "success";
}
