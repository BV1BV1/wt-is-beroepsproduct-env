<?php
require_once 'db_connectie.php';
require_once 'helperfunctions.php';
require_once './model/registrationForm.php';

function contractsToHtml($contractOptions)
{
    $html = '
    <div class="contract blauw">
        <fieldset class="blauw">
        <div class="blauw">contract options<br><br>
    ';
    foreach ($contractOptions as $option) {
        $type = $option['contract_type'];
        $price = $option['price_per_month'];
        $discount = $option['discount_percentage'];
        $html .= '
        <label class="blauw" for="' . $type . '"></label>
        <input class="blauw radiobutton" id="' . $type . '" type="radio"
        name="contractOption" value="' . $type . '" required> ' .  $type .  '<br>
        <p class="blauw"><small class="blauw">Price: ' . $price . ' euro ' . $discount . '% discount</small></p>   
    ';
    }
    $html .= '
    </div>   
    </fieldset>
</div>
    ';

    return $html;
}

function paymentOptionsToHtml($paymentOptions)
{
    $html = '
    <div class="payment blauw">
        <fieldset class="blauw">
        <div class="blauw">payment options<br><br>
    ';
    foreach ($paymentOptions as $option) {
        $method = $option['payment_method'];
        $html .= '
        <label class="blauw" for="' . $method . '"></label>
        <input class="blauw radiobutton" id="' . $method . '" type="radio"
        name="paymentOption" value="' . $method . '" required> ' .  $method .  '<br><br>
    ';
    }
    $html .= '
    </div>
    </fieldset>
    <div class="blauw">
    <label class="blauw" for="cardnumber">cardnumber<br><small class="blauw">9 digits</small></label>
    <input class="blauw" pattern="[0-9]{9}" type="text" id="cardnumber" name="cardnumber" required>   
    </div>
</div>
    ';

    return $html;
}

function countryOptionsToHtml($countries)
{
    $html = '
    <div class="country geel">
        <label class="geel" for="country">select country</label>
        <select class="geel" id="country" name="country" required>
        <option class="geel" value="" disabled selected> selecteer land</option>
           
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

function getStaticRegistrationformHtml()
{
    $html = '
            <div class="namedetails wit">
                <label class="wit" for="firstname">First name</label>
                <input class="wit" type="text" id="firstname" name="firstname" required>
                <label class="wit" for="lastname">Last name</label>
                <input class="wit" type="text" id="lastname" name="lastname" required>
                <label class="wit" for="email">e-mail adress</label>
                <input class="wit" type="email" id="email" name="email" required>
                <label class="wit" for="username">Username</label>
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
                <input class="wit" minlength="8" type="password" id="password" name="password" required>
                <small class="wit">min 8 chars</small>
            </div>
    ';
    return $html;
}