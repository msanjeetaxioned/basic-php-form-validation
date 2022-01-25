<?php
function nameValidation() {
    GLOBAL $name;
    if (strlen($name) >= 2) {
        $pattern = "/^[a-z ,.'-]+$/i";
        if (preg_match($pattern, $name)) {
            return true;
        }
        return false;
    }
    return false;
}

function emailValidation() {
    GLOBAL $email;
    $pattern = "/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/i";
    if (preg_match($pattern, $email)) {
        return true;
    }
    return false;
}

function mobileNumValidation() {
    GLOBAL $mobileNum;
    $pattern = "/^(\+91[\-\s]?)?[0]?(91)?[789]\d{9}$/";
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

function confirmPasswordValidation() {
    GLOBAL $password;
    GLOBAL $confirmPass;
    if (passwordValidation($confirmPass) && $confirmPass == $password) {
        return true;
    }
    else {
        return false;
    }
}

function fileValidation() {
    GLOBAL $file;
    GLOBAL $fileError;
    GLOBAL $fileErrors;

    $target_dir = "image-upload/";
    $target_file = $target_dir.basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image of required types
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $fileError =  $fileErrors["type"];
        return;
    }

    if (file_exists($target_file)) {
        $fileError =  $fileErrors["name"];
        return;
    }

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