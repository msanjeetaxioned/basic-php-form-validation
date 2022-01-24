<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="stylesheet" href="form.css">
</head>
<body>
<?php
$nameError = $emailError = $mobileNumError = $passwordError = $confirmPassError = $fileError = "*Required";
$name = $email = $mobileNum = $gender = $password = $confirmPass = $file = "";

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

    $target_dir = "image-upload/";
    $target_file = $target_dir.basename($file["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        $fileError =  "*Sorry, only JPG, JPEG & PNG Image files are allowed.";
        return;
    }

    if (file_exists($target_file)) {
        $fileError =  "*Sorry, file already exists. Try a different name.";
        return;
    }

    if ($file["size"] > 1500000) {
        $fileError =  "*Sorry, your file is too large. Max. allowed size <=1.5mb.";
        return;
    }

    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        $fileError = "";
        return;
    } else {
        $fileError = "*Sorry, some Unknown Error Occured.";
        return;
    }
}

// print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    if (empty($name)) {
        $nameError = "*Name is Required!";
    } elseif (nameValidation()) {
        $nameError = "";
    } else {
        $nameError = "*Enter a Valid Name!";
    }

    $email = $_POST["email"];
    if (empty($email)) {
        $emailError = "*Email is Required!";
    } elseif (emailValidation()) {
        $emailError = "";
    } else {
        $emailError = "*Enter a Valid Email Address!";
    }

    $mobileNum = $_POST["phone-num"];
    if (empty($mobileNum)) {
        $mobileNumError = "*Mobile Number is Required!";
    } elseif (mobileNumValidation()) {
        $mobileNumError = "";
    } else {
        $mobileNumError = "*Enter a Valid Mobile Number!";
    }

    $gender = $_POST["gender"];

    $password = $_POST["password"];
    if (empty($password)) {
        $passwordError = "*Password is Required!";
    } elseif (passwordValidation($password)) {
        $passwordError = "";
    } else {
        $passwordError = "*Password should be Min. '8' in length and must contain Min. '1' Uppercase Charactor and '1' Number.";
    }

    $confirmPass = $_POST["confirm-password"];
    if (empty($confirmPass)) {
        $confirmPassError = "*Confirm your Password!";
    } elseif (confirmPasswordValidation()) {
        $confirmPassError = "";
    } else {
        $confirmPassError = "*Password entered here should match the above Password.";
    }

    $file = $_FILES["file"];
    if (empty($file["name"])) {
        $fileError = "*Required: Upload your Picture!";
    } else {
        fileValidation();
    }
}
?>
    <div class="wrapper">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <h1>form validation</h1>
            <div class="name-div percent-50">
                <input type="text" name="name" placeholder="Name">
                <span class="error-message"><?php echo $nameError; ?></span>
            </div>
            <div class="email-div percent-50">
                <input type="email" name="email" placeholder="Email Id">
                <span class="error-message"><?php echo $emailError; ?></span>
            </div>
            <div class="mobile-div percent-50">
                <input type="tel" name="phone-num" placeholder="Mobile Number">
                <span class="error-message"><?php echo $mobileNumError; ?></span>
            </div>
            <div class="gender-div">
                <h3>Gender:</h3>
                <label for="male">Male</label>
                <input type="radio" id="male" name="gender" value="Male" checked>
                <label for="female">Female</label>
                <input type="radio" id="female" name="gender" value="Female">
            </div>
            <div class="password-div percent-50">
                <input type="password" name="password" placeholder="Password">
                <span class="error-message"><?php echo $passwordError; ?></span>
            </div>
            <div class="confirm-password-div percent-50">
                <input type="password" name="confirm-password" placeholder="Confirm Password">
                <span class="error-message"><?php echo $confirmPassError; ?></span>
            </div>
            <div class="file-div percent-50">
                <input type="file" name="file">
                <span class="error-message"><?php echo $fileError; ?></span>
            </div>
            <div class="submit-div">
                <button type="submit">submit</button>
            </div>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($nameError == "" && $emailError == "" && $mobileNumError == "" && $passwordError == "" && $confirmPassError == "" && $fileError == "") {
                echo "<h2>Form Submitted Successfully, Thanks!</h2>";
                echo "<h3>Submitted Data:</h3>";
                echo "Name: $name<br>";
                echo "Email Address: $email<br>";
                echo "Mobile Number: $mobileNum<br>";
                echo "Gender: $gender<br>";
                echo "Picture File name: ".$file["name"]."<br>";
            }
        }
        ?>
    </div>
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>