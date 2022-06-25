<?php
require_once 'db_connectie.php';
include_once "session.php";

checkLogindetails($_POST['email'], $_POST['password']);

function checkLogindetails($mail, $pass)
{
    $db = maakVerbinding();

    $email = $mail;
    $password = $pass;

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

    if (str_contains($_SESSION['prevpage'], 'movie_id')) {
        $page = $_SESSION['prevpage'];
        header("Location:$page");
        exit();
    }

    header("Location: login.php");
    exit();
}

function loginToSession()
{
    $_SESSION['loggedIn'] = true;
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['username'] = getUsername($_POST['email']);
}

function getUsername($mail)
{
    $db = maakVerbinding();
    $email = $mail;
    $sql = 'select user_name
            from customer
            where customer_mail_address = (:email)
            ';
    $query = $db->prepare($sql);
    $query->execute([':email' => $email]);

    $result = $query->fetch();
    return $result['user_name'];
}