<?php
function displayWelcome()
{
    return "<div class='wit'>welcome</div>";
    $html = '
    <h1 class="wit">Welcome' . getFirstName($_SESSION['customer_id']) . ' !</h1>
    ';
    return $html;
}

function createLoginScreen()
{
    return "<div class='wit'>login</div>";
}