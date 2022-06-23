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
// session_start();
// $_SESSION['customer_id'] = '1234';
function getCustomerData()
{
    $customer_id = $_SESSION(['user_id']);
}

function contractsToHtml($contractOptions)
{
    $html = '
    <div class="contract blauw">
        <label class="blauw" for="checkbox">contract options<br><br>
        <fieldset class="blauw">
    ';
    foreach ($contractOptions as $option) {
        $type = $option['contract_type'];
        $price = $option['price_per_month'];
        $discount = $option['discount_percentage'];
        $html .= '
        <div class="blauw">
        <label class="blauw" for="' . $type . '"></label>
        <input class="blauw radiobutton" id="' . $type . '" type="radio"
        name="contractOption" value="' . $type . '" required> ' .  $type .  '
        <p class="blauw"><small class="blauw">Price: ' . $price . ' euro ' . $discount . '% discount</small></p>
        </div>   
    ';
    }
    $html .= '
    </fieldset>
    </label>   
</div>
    ';

    return $html;
}

function getPaymentData()
{
    $db = maakVerbinding();
    $sql = "select payment_method
            from payment";
    $data = $db->query($sql);

    return $data->fetchAll();
}

function paymentOptionsToHtml($paymentOptions)
{
    $html = '
    <div class="payment blauw">
        <label class="blauw" for="checkbox">payment options<br><br>
        <fieldset class="blauw">
    ';
    foreach ($paymentOptions as $option) {
        $method = $option['payment_method'];
        $html .= '
        <div class="blauw">
        <label class="blauw" for="' . $method . '"></label>
        <input class="blauw radiobutton" id="' . $method . '" type="radio"
        name="paymentOption" value="' . $method . '" required> ' .  $method .  '
        </div>   
    ';
    }
    $html .= '
    </fieldset>
    </label>
    <div class="blauw">
    <label class="blauw" for="text">cardnumber<br><small class="blauw">9 digits</small></label>
    <input class="blauw" pattern="[0-9]{9}" type="text" id="cardnumber" name="cardnumber" required>   
    </div>
</div>
    ';

    return $html;
}

function getCountryOptions()
{
    $db = maakVerbinding();
    $sql = "select country_name
            from country";
    $data = $db->query($sql);

    return $data->fetchAll();
}

function countryOptionsToHtml($countries)
{
    $html = '
    <div class="country geel">
        <label class="geel" for="country">select country</label>
        <select class="geel" id="country" name="country" required>
           
    ';

    foreach ($countries as $countryOption) {
        $country = $countryOption['country_name'];
        $html .= '
        <option class="geel" value="' . $country . '">' . $country . '</option>
        ';
    }
    $html .= '
    </select>
    </div>
    ';

    return $html;
}