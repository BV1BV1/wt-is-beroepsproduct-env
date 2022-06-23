<?php
include_once "session.php";
require_once 'db_connectie.php'; ?>

<div> <?= var_dump($_POST) ?>
</div>


<?php

// var_dump(checkOfEmailBestaat());
// echo registerUser();

header("Location: login.php");
exit();

?>

<?php

function registerUser()
{
    if (checkOfEmailBestaat()) {
    } else {
        $db = maakVerbinding();
        $email = $_POST['email'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $paymentoption = $_POST['paymentOption'];
        $cardnumber = $_POST['cardnumber'];
        $contractoption = $_POST['contractOption'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $country = $_POST['country'];
        $birthday = date($_POST['birthday']);

        $sql = 'insert into customer 
                (customer_mail_address, lastname, firstname, payment_method, payment_card_number, contract_type, user_name, subscription_start, password, country_name, birth_date)
                values (:email, :lastname, :firstname, :paymentoption, :cardnumber, :contractoption, :username, GETDATE(), :password, :country, :birthday) ';

        $query = $db->prepare($sql);
        $query->execute([
            ':email' => $email, ':lastname' => $lastname, ':firstname' => $firstname, ':paymentoption' => $paymentoption, ':cardnumber' => $cardnumber,
            ':contractoption' => $contractoption, ':username' => $username, ':password' => $password, ':country' => $country, ':birthday' => $birthday
        ]);

        return "registratie voltooid";
    }
}


function checkOfEmailBestaat()
{
    $db = maakVerbinding();
    $email = $_POST['email'];
    $results = [];

    $sql = 'select * from customer
            where customer_mail_address =  (:email)';
    $query = $db->prepare($sql);
    $query->execute(['email' => $email]);

    if (count($results) == 1) {
        return true;
    } else {
        return false;
    }
}