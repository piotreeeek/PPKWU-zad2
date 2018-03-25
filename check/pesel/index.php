<?php
$result = [$_POST['name'] => 1];
if (strlen($_POST['value']) < 1 || !validatepesel($_POST['value'])) {
    $result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
}

echo json_encode($result);


function validatepesel($pesel) {
    $reg = '/^[0-9]{11}$/';
    if(preg_match($reg, $pesel)==false)
        return false;
    else
    {
        $digits = str_split($pesel);
        if ((intval(substr($pesel, 4, 2)) > 31)||(intval(substr($pesel, 2, 2)) > 12))
            return false;
        $checksum = (1*intval($digits[0]) + 3*intval($digits[1]) + 7*intval($digits[2]) + 9*intval($digits[3]) + 1*intval($digits[4]) + 3*intval($digits[5]) + 7*intval($digits[6]) + 9*intval($digits[7]) + 1*intval($digits[8]) + 3*intval($digits[9]))%10;
        if($checksum == 0) 
            $checksum = 10;
        $checksum = 10 - $checksum;
             
        return (intval($digits[10]) == $checksum);
    }
}