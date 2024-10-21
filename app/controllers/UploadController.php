<?php
require_once "app/models/FileModel.php";

$result = "";
if (isset($_FILES["files"])) {
    $result = uploadFiles($_FILES);
}