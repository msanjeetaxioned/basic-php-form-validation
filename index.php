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
require('defaults.php');
require('form-validation.php');

// Check if form submitted with 'POST' method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Name Validation
    $name = $_POST["name"];
    if (empty($name)) {
        $nameError = $emptyErrors["name"];
    } elseif (nameValidation($name)) {
        $nameError = "";
    } else {
        $nameError = $criteriaErrors["name"];
    }

    // Email Validation
    $email = $_POST["email"];
    if (empty($email)) {
        $emailError = $emptyErrors["email"];
    } elseif (emailValidation($email)) {
        $emailError = "";
    } else {
        $emailError = $criteriaErrors["email"];
    }

    // Mobile Number Validation
    $mobileNum = $_POST["phone-num"];
    if (empty($mobileNum)) {
        $mobileNumError = $emptyErrors["mobile-num"];
    } elseif (mobileNumValidation($mobileNum)) {
        $mobileNumError = "";
    } else {
        $mobileNumError = $criteriaErrors["mobile-num"];
    }

    // Get Gender
    $gender = $_POST["gender"];

    // Password Validation
    $password = $_POST["password"];
    if (empty($password)) {
        $passwordError = $emptyErrors["password"];
    } elseif (passwordValidation($password)) {
        $passwordError = "";
    } else {
        $passwordError = $criteriaErrors["password"];
    }

    // Confirm Password Validation
    $confirmPass = $_POST["confirm-password"];
    if (empty($confirmPass)) {
        $confirmPassError = $emptyErrors["confirm-pass"];
    } elseif (confirmPasswordValidation($password, $confirmPass)) {
        $confirmPassError = "";
    } else {
        $confirmPassError = $criteriaErrors["confirm-pass"];
    }

    // Image submitted Validation
    $file = $_FILES["file"];
    if (empty($file["name"])) {
        $fileError = $emptyErrors["file"];
    } else {
        fileValidation($file, $fileError, $fileErrors);
    }
}
?>
    <div class="wrapper">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
            <h1>form validation</h1>
            <p class="note">Note: All of the below fields are Required.</p>
            <div class="name-div percent-50">
                <input type="text" name="name" placeholder="Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES) : ''; ?>">
                <span class="error-message"><?php echo $nameError; ?></span>
            </div>
            <div class="email-div percent-50">
                <input type="email" name="email" placeholder="Email Id" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES) : ''; ?>">
                <span class="error-message"><?php echo $emailError; ?></span>
            </div>
            <div class="mobile-div percent-50">
                <input type="tel" name="phone-num" placeholder="Mobile Number" value="<?php echo isset($_POST['phone-num']) ? htmlspecialchars($_POST['phone-num'], ENT_QUOTES) : ''; ?>">
                <span class="error-message"><?php echo $mobileNumError; ?></span>
            </div>
            <div class="gender-div">
                <h3>Gender:</h3>
                <label for="male">Male</label>
                <input type="radio" id="male" name="gender" value="Male" <?php echo (isset($_POST['gender'])) ? (($_POST['gender'] === 'Male') ? 'checked' : '') : 'checked'; ?>>
                <label for="female">Female</label>
                <input type="radio" id="female" name="gender" value="Female" <?php echo (isset($_POST['gender']) && $_POST['gender'] === 'Female') ? 'checked' : ''; ?>>
            </div>
            <div class="password-div percent-50">
                <input type="password" name="password" placeholder="Password" value="<?php echo isset($_POST['password']) ? htmlspecialchars($_POST['password'], ENT_QUOTES) : ''; ?>">
                <span class="<?php echo isset($_POST['password']) ? 'error-message' : 'error-message hint'?>"><?php echo $passwordError; ?></span>
            </div>
            <div class="confirm-password-div percent-50">
                <input type="password" name="confirm-password" placeholder="Confirm Password" value="<?php echo isset($_POST['confirm-password']) ? htmlspecialchars($_POST['confirm-password'], ENT_QUOTES) : ''; ?>">
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
        // To prevent Page Refresh from Submitting Form
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</body>
</html>