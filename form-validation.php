<?php
function nameValidation($name) {
    if (strlen($name) >= 2) {
        $pattern = "/^[a-z ,.'-]+$/i";
        if (preg_match($pattern, $name)) {
            return true;
        }
        return false;
    }
    return false;
}

function emailValidation($email) {
    $pattern = "/(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|\"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*\")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/";
    if (preg_match($pattern, $email)) {
        return true;
    }
    return false;
}

function mobileNumValidation($mobileNum) {
    $pattern = "/^\+((?:9[679]|8[035789]|6[789]|5[90]|42|3[578]|2[1-689])|9[0-58]|8[1246]|6[0-6]|5[1-8]|4[013-9]|3[0-469]|2[70]|7|1)(?:\W*\d){0,13}\d$/";
    if (preg_match($pattern, $mobileNum)) {
        return true;
    }
    return false;
}

function passwordValidation($password) {
    $pattern = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/";
    if (preg_match($pattern, $password)) {
        return true;
    }
    return false;
}

function confirmPasswordValidation($password, $confirmPass) {
    if ($confirmPass == $password) {
        return true;
    }
    else {
        return false;
    }
}

function fileValidation($file, $fileError, $fileErrors) {
    $target_dir = "image-upload/";
    $target_file = $target_dir.basename($file["name"]);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image of required types
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $fileError =  $fileErrors["type"];
        return;
    }

    // Check if file with same name is already stored
    if (file_exists($target_file)) {
        $fileError =  $fileErrors["name"];
        return;
    }

    // max. upload file size allowed is 1.5MB
    if ($file["size"] > 1500000) {
        $fileError =  $fileErrors["size"];
        return;
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $fileError = "";
        return;
    } else {
        $fileError = $fileErrors["other"];
        return;
    }
}