<?php
$result = [$_POST['name'] => 1];
if (strlen($_POST['value']) < 1 || filter_var($_POST['value'], FILTER_VALIDATE_EMAIL) == false) {
    $result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
}

echo json_encode($result);