<?php require_once 'db_connectie.php'; ?>

<div> <?= var_dump($_POST) ?>
</div>


<?php

var_dump(checkOfEmailBestaat())
// registerUser();

?>

<?php

function registerUser()
{
    if (!checkOfEmailBestaat()) {
    } else {
        $email = $_POST['email'];
        $lastname = $_POST['lastname'];
        $firstname = $_POST['firstname'];
        $paymentoption = $_POST['paymentoption'];
        $cardnumber = $_POST['cardnumber'];
        $contractoption = $_POST['contractoption'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $country = $_POST['country'];
        $birthday = $_POST['birthday'];

        $sql = 'insert into customer 
                (customer_mail_address, lastname, firstname, payment_method, payment_card_number, contract_type, subscription_start, user_name, password, country_name, birth_date)
                values (:email, :lastname, :firstname, :paymentoption, :cardnumber, :contractoption, :username, GETDATE(),' . $password . ' , :country, :birthday) ';
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