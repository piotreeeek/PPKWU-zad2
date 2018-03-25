<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$result = [$_POST['name'] => 1];

	switch ($_POST['name']) {
		case 'mail':
			if (strlen($_POST['value']) < 1 || filter_var("some@address.com", FILTER_VALIDATE_EMAIL) == false) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		
		case 'nip':
			if (strlen($_POST['value']) < 1 || !validatenip($_POST['value'])) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		
		case 'regon':
			if (strlen($_POST['value']) < 1 || !validateregon9($_POST['value'])) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		
		case 'pesel':
			if (strlen($_POST['value']) < 1 || !validatepesel($_POST['value'])) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		
		case 'code':
			if (strlen($_POST['value']) < 1 || !preg_match('/^[0-9]{2}[-][0-9]{3}$/', $_POST['value'])) {
				$result = [$_POST['name'] => "Pole " . $_POST['name'] . " niepoprawnie wypełnione."];
			}
			break;
		

		default:
			$result = [$_POST['name'] => 1];
			break;
	}
	
	echo json_encode($result);
}

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

function validatenip($nip) {
    $nipWithoutDashes = preg_replace("/-/","",$nip);
    $reg = '/^[0-9]{10}$/';
    if(preg_match($reg, $nipWithoutDashes)==false)
        return false;
    else
    {
        $digits = str_split($nipWithoutDashes);
        $checksum = (6*intval($digits[0]) + 5*intval($digits[1]) + 7*intval($digits[2]) + 2*intval($digits[3]) + 3*intval($digits[4]) + 4*intval($digits[5]) + 5*intval($digits[6]) + 6*intval($digits[7]) + 7*intval($digits[8]))%11;
 
        return (intval($digits[9]) == $checksum);
    }
}

function validateregon9($regon) {
    $reg = '/^[0-9]{9}$/';
    if(preg_match($reg, $regon)==false)
        return false;
    else
    {
        $digits = str_split($regon);
        $checksum = (8*intval($digits[0]) + 9*intval($digits[1]) + 2*intval($digits[2]) + 3*intval($digits[3]) + 4*intval($digits[4]) + 5*intval($digits[5]) + 6*intval($digits[6]) + 7*intval($digits[7]))%11;
        if($checksum == 10) 
            $checksum = 0;
 
        return (intval($digits[8]) == $checksum);
    }
}