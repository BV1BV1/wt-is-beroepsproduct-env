<?php
// require_once "functions.php";
require_once "view/templates.php";
require_once "model/movies.php";
require_once "view/movies.php";
require_once "view/registrationForm.php";
include_once "session.php";
?>

<?php
$htmlContent = createSpecificFiller(35) . '
<form class="registerForm" action="processRegistration.php" method="post">
    <div class="namedetails wit">
            <label class="wit" for="text">First name</label>
            <input class="wit" type="text" id="firstname" name="firstname" required>
            <label class="wit" for="text">Last name</label>
            <input class="wit" type="text" id="lastname" name="lastname" required>
            <label class="wit" for="email">e-mail adress</label>
            <input class="wit" type="email" id="email" name="email" required>
            <label class="wit" for="text">Username</label>
            <input class="wit" type="text" maxlength="8" id="username" name="username" required>
    </div>
    <div class="birthday wit">
                <label class="wit" for="date">Birthday</label>
                <input class="wit" id="date" type="date" name="birthday" required>
                <small class="wit">format: ddmmyy</small>

    </div>
    <input class="rood submitbutton" type="submit" value="Register">
    <div class="wit password">
            <label class="wit" for="password">password</label>
            <input class="wit" minlength="8" type="password" name="password" required>
            <small class="wit">min 8 chars</small>
    </div>
    '
        . paymentOptionsToHtml(getPaymentData())
        . contractsToHtml(getContractOptions())
        . countryOptionsToHtml(getCountryOptions())
        . '</form>';
// $htmlContent .= createSpecificFiller(80);
?>
<?php include_once "base.php" ?>