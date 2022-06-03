<?php
$inloggegevens = [
    ["username" => "bob", "password" => "vogel"],
    ["username" => "rowan", "password" => "kooi"],
    ["username" => "john", "password" => "gorter"],
    ["username" => "floor", "password" => "driessen"],
];

function login()
{
    global $inloggegevens;

    foreach ($inloggegevens as $inloggegeven) {
        $resultaat = "jammer!";
        echo "test nu " . $inloggegeven["username"];
        if (($inloggegeven["username"] == $_POST["username"]) && ($inloggegeven["password"] == $_POST["password"])) {
            $resultaat = "succes!";
            return $resultaat;
        }
    };
    return $resultaat;
};

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        <label for="username">Username:</label><br>
        <input type="text" name="username"><br>
        <label for="password">Password:</label><br>
        <input type="password" name="password">
        <input type="submit" value="Submit">
    </form>

    <?php var_dump($_POST) ?><br>
    <?php echo login() ?>
</body>

</html>