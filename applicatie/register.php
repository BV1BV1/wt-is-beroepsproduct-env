<?php
// require_once "functions.php";
require_once "view/templates.php";
require_once "model/movies.php";
require_once "view/movies.php";
require_once "view/registrationForm.php";
include_once "session.php";
?>

<?php
$htmlContent = createSpecificFiller(35) .
        '<form class="registerForm" action="processRegistration.php" method="post">'
        . getStaticRegistrationformHtml()
        . paymentOptionsToHtml(getPaymentData())
        . contractsToHtml(getContractOptions())
        . countryOptionsToHtml(getCountryOptions())
        . '</form>';
?>
<?php include_once "base.php" ?>