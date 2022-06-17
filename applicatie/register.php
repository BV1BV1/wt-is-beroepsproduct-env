<?php
require_once "functions.php";
require_once "templates.php";
require_once "model/movies.php";
require_once "view/movies.php";
require_once "view/customerdata.php";
?>

<?php
$htmlContent = '
<form class="registerForm" action="processRegistration.php" method="post">
    <div class="namedetails wit">
            <label class="wit" for="text">First name</label>
            <input class="wit" type="text" id="firstname" name="firstname" required>
            <label class="wit" for="text">Last name</label>
            <input class="wit" type="text" id="lastname" name="lastname" required>
            <label class="wit" for="email">e-mail adress</label>
            <input class="wit" type="email" id="email" name="email" required>
            <label class="wit" for="text">Username</label>
            <input class="wit" type="text" id="username" name="username" required>
    </div>
    <div class="birthday wit">
            <label class="wit" for="text">Birthday</label>
            <input pattern=[0-3]{1}[0-9]{1}[0-1]{1}[0-9]{3} class="wit" type="text" id="birthday" name="birthday">
            <small class="wit">format: ddmmyy</small>
    </div>
    <input class="rood submitbutton" type="submit" value="Register">
    <div class="wit password">
            <label class="wit" for="password">password</label>
            <input class="wit" minlength="8" type="password" name="password">
            <small class="wit">min 8 chars</small>
    </div>
    '
    . paymentOptionsToHtml(getPaymentData())
    . contractsToHtml(getContractOptions())
    . countryOptionsToHtml(getCountryOptions()) .
    '</form>';
?>
<?php include_once "base.php" ?>