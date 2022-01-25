<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="stylesheet" href="override.css">
    <link rel="stylesheet" href="form.css">
</head>
<body>
<?php
$nameError = $emailError = $mobileNumError = $confirmPassError = $fileError = "";
$passwordError = "Hint: Password should be Min. '8' in length and must contain Min. '1' Uppercase Charactor and '1' Number.";
$name = $email = $mobileNum = $gender = $password = $confirmPass = $file = "";

require('form-validation.php');

// print_r($_POST);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    if (empty($name)) {
        $nameError = "*Please enter your Name!";
    } elseif (nameValidation()) {
        $nameError = "";
    } else {
        $nameError = "*Please enter a valid Name!";
    }

    $email = $_POST["email"];
    if (empty($email)) {
        $emailError = "*Please enter your Email Address!";
    } elseif (emailValidation()) {
        $emailError = "";
    } else {
        $emailError = "*Please enter a valid Email Address!";
    }

    $mobileNum = $_POST["phone-num"];
    if (empty($mobileNum)) {
        $mobileNumError = "*Please enter your Mobile Number!";
    } elseif (mobileNumValidation()) {
        $mobileNumError = "";
    } else {
        $mobileNumError = "*Please enter a valid Mobile Number!";
    }

    $gender = $_POST["gender"];

    $password = $_POST["password"];
    if (empty($password)) {
        $passwordError = "*Please enter a Password!";
    } elseif (passwordValidation($password)) {
        $passwordError = "";
    } else {
        $passwordError = "*Password should be Min. '8' in length and must contain Min. '1' Uppercase Charactor and '1' Number.";
    }

    $confirmPass = $_POST["confirm-password"];
    if (empty($confirmPass)) {
        $confirmPassError = "*Please confirm your Password!";
    } elseif (confirmPasswordValidation()) {
        $confirmPassError = "";
    } else {
        $confirmPassError = "*Password entered here should match the above Password.";
    }

    $file = $_FILES["file"];
    if (empty($file["name"])) {
        $fileError = "*Please Upload your picture!";
    } else {
        fileValidation();
    }
}
?>
    <div class="wrapper">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <h1>form validation</h1>
            <p class="note">Note: All of the below fields are Required. Thanks!</p>
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
        // After Successful form submit show message and submitted data to User.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if ($nameError == "" && $emailError == "" && $mobileNumError == "" && $passwordError == "" && $confirmPassError == "" && $fileError == "") {
                echo "<div class='submitted-data'>";
                echo "<h2>Form Submitted Successfully, Thanks!</h2>";
                echo "<h3>Submitted Data:</h3>";
                echo "<p><small>Name: </small>$name</p>";
                echo "<p><small>Email Address: </small>$email</p>";
                echo "<p><small>Mobile Number: </small>$mobileNum</p>";
                echo "<p><small>Gender: </small>$gender</p>";
                echo "<p><small>Uploaded Image:</small></p>";
                echo "<figure><img src='image-upload/".$file["name"]."' alt='Your Profile Picture'></figure>";
                echo "</div>";
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