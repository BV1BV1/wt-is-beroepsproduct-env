<?php
require_once 'db_connectie.php';
require_once 'helperfunctions.php';

function getContractOptions()
{
    $db = maakVerbinding();
    $sql = "select contract_type, price_per_month, discount_percentage
            from contract";
    $data = $db->query($sql);

    return $data->fetchAll();
}

function getPaymentData()
{
    $db = maakVerbinding();
    $sql = "select payment_method
            from payment";
    $data = $db->query($sql);

    return $data->fetchAll();
}

function getCountryOptions()
{
    $db = maakVerbinding();
    $sql = "select country_name
            from country";
    $data = $db->query($sql);

    return $data->fetchAll();
}