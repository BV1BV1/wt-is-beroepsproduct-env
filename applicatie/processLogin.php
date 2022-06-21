<?php
require_once 'db_connectie.php';
include_once "session.php";

checkLogindetails();

function checkLogindetails()
{
    $db = maakVerbinding();

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = 'select password
            from customer
            where customer_mail_address = (:email)
            ';
    $query = $db->prepare($sql);
    $query->execute([':email' => $email]);

    $encryptedPassword = "";

    $result = $query->fetch();
    $encryptedPassword = $result['password'];

    // $_SESSION['testPW'] = password_hash("1234password", PASSWORD_DEFAULT);
    // $_SESSION['passwordHash'] = $encryptedPassword;

    if (password_verify($password, $encryptedPassword)) {
        if (isset($_SESSION['loginError'])) {
            unset($_SESSION['loginError']);
        }
        loginToSession();
    } else {
        $_SESSION['loginError'] = "Het was niet mogelijk om je me de ingevoerde gegevens in te loggen.";
    }

    header("Location: login.php");
    exit();
}

function loginToSession()
{
    $_SESSION['loggedIn'] = true;
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['username'] = getUsername();
}

function getUsername()
{
    $db = maakVerbinding();
    $email = $_POST['email'];
    $sql = 'select user_name
            from customer
            where customer_mail_address = (:email)
            ';
    $query = $db->prepare($sql);
    $query->execute([':email' => $email]);

    $result = $query->fetch();
    return $result['user_name'];
}