<?php
$nameError = $emailError = $mobileNumError = $confirmPassError = $fileError = "";
$passwordError = "Hint: Password should be Min. '8' in length and must contain Min. '1' Uppercase Charactor and '1' Number.";
$name = $email = $mobileNum = $gender = $password = $confirmPass = $file = "";

$emptyErrors = ["name" => "*Please enter your Name!", "email" => "*Please enter your Email Address!", "mobile-num" => "*Please enter your Mobile Number!", "password" => "*Please enter a Password!", "confirm-pass" => "*Please confirm your Password!", "file" => "*Please Upload your picture!"];

$criteriaErrors = ["name" => "*Please enter a valid Name!", "email" => "*Please enter a valid Email Address!", "mobile-num" => "*Please enter a valid Mobile Number!", "password" => "*Password should be Min. '8' in length and must contain Min. '1' Uppercase Charactor and '1' Number.", "confirm-pass" => "*Password entered here should match the above Password."];

$fileErrors = ["type" => "*Sorry, only Image(JPG, JPEG & PNG) files are allowed.", "name" => "*Sorry, file already exists. Try a different name.", "size" => "*Sorry, your file is too large. Max. allowed size <=1.5mb.", "other" => "*Sorry, some Unknown Error Occured."];